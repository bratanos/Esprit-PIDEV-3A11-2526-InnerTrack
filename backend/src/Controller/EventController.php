<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\TypeEvent;
use App\Repository\EventRepository;
use App\Service\AiEventCopilotService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/admin/events', name: 'admin_event_')]
#[IsGranted('ROLE_PSYCHOLOGUE')]
class EventController extends AbstractController
{
    public function __construct(
        private readonly \Symfony\Contracts\HttpClient\HttpClientInterface $client,
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire(env: 'default::CHATBOT_AI_URL')] private string $chatbotAiUrl = 'http://127.0.0.1:8001'
    ) {}

    // ------------------------------------------------------------------ LIST
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(EventRepository $repo, \App\Repository\InscriptionRepository $inscRepo): Response
    {
        $events = $repo->findAll();

        // ── FullCalendar JSON data ──
        $calendarEvents = [];
        $typeColors = [
            1 => '#3b82f6', // Conférence → blue
            2 => '#22c55e', // Atelier → green
            3 => '#a855f7', // Forum → purple
            4 => '#f97316', // Webinaire → orange
        ];
        foreach ($events as $event) {
            $calendarEvents[] = [
                'id'    => $event->getId(),
                'title' => $event->getTitre(),
                'start' => $event->getDate()->format('Y-m-d'),
                'url'   => $this->generateUrl('admin_event_show', ['id' => $event->getId()]),
                'color' => $typeColors[$event->getType()?->value] ?? '#94a3b8',
                'extendedProps' => [
                    'type'     => $event->getType()?->label() ?? 'Non défini',
                    'capacite' => $event->getCapacite(),
                    'statut'   => $event->isStatut(),
                ],
            ];
        }

        // ── Statistics data ──
        $stats = [
            'eventsByType'         => $repo->countByType(),
            'eventsByMonth'        => $repo->countByMonth(),
            'activeVsInactive'     => $repo->countActiveVsInactive(),
            'inscriptionsByStatus' => $inscRepo->countByStatus(),
            'inscriptionsByMonth'  => $inscRepo->countByMonth(),
            'topEvents'            => $inscRepo->getTopEvents(5),
            'occupancyRates'       => $inscRepo->getOccupancyRates(),
        ];

        return $this->render('admin/event/index.html.twig', [
            'events'         => $events,
            'calendarEvents' => json_encode($calendarEvents),
            'stats'          => $stats,
        ]);
    }

    // ------------------------------------------------------------------ NEW
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $errors = [];
        $event  = new Event();

        if ($request->isMethod('POST')) {
            $errors = $this->processForm($request, $event);

            if (empty($errors)) {
                $em->persist($event);
                $em->flush();
                $this->addFlash('success', 'Événement créé avec succès.');
                return $this->redirectToRoute('admin_event_index');
            }
        }

        return $this->render('admin/event/new.html.twig', [
            'event'  => $event,
            'errors' => $errors,
            'types'  => TypeEvent::cases(),
            'chatbot_ai_url' => $this->chatbotAiUrl,
        ]);
    }

    // --------------------------------------------------------------- AI COPILOT
    #[Route('/ai/generate', name: 'ai_generate', methods: ['POST'])]
    public function aiGenerate(Request $request, AiEventCopilotService $copilot): JsonResponse
    {
        $idea = trim((string) ($request->toArray()['idea'] ?? ''));

        if (strlen($idea) < 5) {
            return $this->json(['error' => 'L\'idée est trop courte.'], 400);
        }

        try {
            $start = microtime(true);
            $data  = $copilot->generateEvent($idea);
            $data['_elapsed_ms'] = (int) ((microtime(true) - $start) * 1000);

            return $this->json($data);
        } catch (\Throwable $e) {
            return $this->json(['error' => $e->getMessage()], 500);
        }
    }

    #[Route('/ai/regenerate-field', name: 'ai_regenerate_field', methods: ['POST'])]
    public function aiRegenerateField(Request $request, AiEventCopilotService $copilot): JsonResponse
    {
        $body         = $request->toArray();
        $field        = $body['field']         ?? '';
        $idea         = $body['idea']          ?? '';
        $currentValue = $body['current_value'] ?? '';

        $allowed = ['titre', 'description'];
        if (!in_array($field, $allowed, true)) {
            return $this->json(['error' => 'Champ non régénérable.'], 400);
        }

        try {
            $value = $copilot->regenerateField($field, $idea, $currentValue);

            return $this->json(['value' => $value]);
        } catch (\Throwable $e) {
            return $this->json(['error' => $e->getMessage()], 500);
        }
    }

    // --------------------------------------------------------------- AI STREAM
    #[Route('/ai/stream', name: 'ai_stream', methods: ['POST'])]
    public function aiStream(Request $request, AiEventCopilotService $copilot): StreamedResponse
    {
        $idea = trim((string) ($request->toArray()['idea'] ?? ''));

        $headers = [
            'Content-Type'      => 'text/event-stream',
            'Cache-Control'     => 'no-cache',
            'X-Accel-Buffering' => 'no',
        ];

        if (strlen($idea) < 5) {
            return new StreamedResponse(function () {
                echo 'data: ' . json_encode(['type' => 'error', 'message' => "L'idée est trop courte."]) . "\n\n";
                ob_flush();
                flush();
            }, 200, $headers);
        }

        return new StreamedResponse(function () use ($idea, $copilot) {
            foreach ($copilot->streamEvent($idea) as $event) {
                echo 'data: ' . json_encode($event) . "\n\n";
                ob_flush();
                flush();
            }
        }, 200, $headers);
    }

    // ------------------------------------------------------------------ SHOW
    #[Route('/{id}', name: 'show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Event $event): Response
    {
        return $this->render('admin/event/show.html.twig', [
            'event' => $event,
        ]);
    }

    // ------------------------------------------------------------------ EDIT
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, Event $event, EntityManagerInterface $em): Response
    {
        $errors = [];

        if ($request->isMethod('POST')) {
            $errors = $this->processForm($request, $event);

            if (empty($errors)) {
                $em->flush();
                $this->addFlash('success', 'Événement mis à jour.');
                return $this->redirectToRoute('admin_event_index');
            }
        }

        return $this->render('admin/event/edit.html.twig', [
            'event'  => $event,
            'errors' => $errors,
            'types'  => TypeEvent::cases(),
        ]);
    }

    // ---------------------------------------------------------------- DELETE
    #[Route('/{id}/delete', name: 'delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, Event $event, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete_event_' . $event->getId(), $request->request->get('_token'))) {
            $em->remove($event);
            $em->flush();
            $this->addFlash('success', 'Événement supprimé.');
        }

        return $this->redirectToRoute('admin_event_index');
    }

    /** @return array<string, string> */
    private function processForm(Request $request, Event $event): array
    {
        $errors = [];

        $titre      = trim($request->request->get('titre', ''));
        $description = trim($request->request->get('description', ''));
        $date       = $request->request->get('date', '');
        $type       = $request->request->get('type', '');
        $capacite   = $request->request->get('capacite', '');
        $statut     = $request->request->get('statut', '0');

        if (strlen($titre) < 2) {
            $errors['titre'] = 'Le titre doit contenir au moins 2 caractères.';
        }
        if (empty($date)) {
            $errors['date'] = 'La date est obligatoire.';
        }
        if (empty($type) || !is_numeric($type) || !TypeEvent::tryFrom((int)$type)) {
            $errors['type'] = 'Veuillez choisir un type valide.';
        }
        if (!is_numeric($capacite) || (int)$capacite < 1) {
            $errors['capacite'] = 'La capacité doit être un entier positif.';
        }

        if (empty($errors)) {
            $event->setTitre($titre);
            $event->setDescription($description ?: null);
            $event->setDate(new \DateTime($date));
            $event->setType(TypeEvent::from((int)$type));
            $event->setCapacite((int)$capacite);
            $event->setStatut($statut === '1');

            $imageFile = $request->files->get('image');
            $generatedImageUrl = $request->request->get('generated_image_url');

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = preg_replace('/[^a-zA-Z0-9_-]/', '', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('kernel.project_dir').'/public/uploads/events',
                        $newFilename
                    );
                    $event->setImage($newFilename);
                } catch (\Exception $e) {
                    $errors['image'] = 'Erreur lors de l\'upload de l\'image.';
                }
            } elseif ($generatedImageUrl) {
                try {
                    $newFilename = 'ai-gen-'.uniqid().'.jpg';
                    $uploadDir = $this->getParameter('kernel.project_dir').'/public/uploads/events';

                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    if (str_starts_with($generatedImageUrl, 'data:image')) {
                        $base64 = preg_replace('/^data:image\/\w+;base64,/', '', $generatedImageUrl);
                        $content = base64_decode($base64);
                    } else {
                        // Use HttpClient instead of file_get_contents for better reliability on Render
                        try {
                            $imageResponse = $this->client->request('GET', $generatedImageUrl, ['timeout' => 5]);
                            $content = ($imageResponse->getStatusCode() === 200) ? $imageResponse->getContent() : false;
                        } catch (\Exception $e) {
                            $content = false;
                        }
                    }

                    if ($content !== false && strlen($content) > 0) {
                        file_put_contents($uploadDir.'/'.$newFilename, $content);
                        $event->setImage($newFilename);
                    }
                } catch (\Exception $e) {
                    // silently fail
                }
            }
        }

        return $errors;
    }

    #[Route('/{id}/qrcode', name: 'qrcode', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function qrcode(Event $event): Response
    {
        $targetUrl = $this->generateUrl(
            'app_event_show',
            ['id' => $event->getId()],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $apiUrl  = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($targetUrl);
        $content = @file_get_contents($apiUrl);

        if ($content === false) {
            return new Response('QR generation failed', 502);
        }

        return new Response($content, 200, [
            'Content-Type'        => 'image/png',
            'Content-Disposition' => 'inline; filename="qrcode-event-' . $event->getId() . '.png"',
        ]);
    }

    #[Route('/generate_event_description', name: 'generate_event_description', methods: ['POST'])]
    public function generateEventDescription(Request $request): JsonResponse
    {
       // Parse the incoming JSON request
        $data = json_decode($request->getContent(), true);
        $eventName = $data['event_name'] ?? '';

        // Example logic for generating description
        $description = "Generated description for the event: $eventName";

        // Return the generated description as JSON
        return new JsonResponse(['description' => $description]);
    }
}
