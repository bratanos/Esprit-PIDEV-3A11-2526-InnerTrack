<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\TypeEvent;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/events', name: 'admin_event_')]
#[IsGranted('ROLE_PSYCHOLOGUE')]
class EventController extends AbstractController
{
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
                'color' => $typeColors[$event->getType()->value] ?? '#6b7280',
                'extendedProps' => [
                    'type'     => $event->getType()->label(),
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
        ]);
    }

    // ------------------------------------------------------------------ SHOW
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('admin/event/show.html.twig', [
            'event' => $event,
        ]);
    }

    // ------------------------------------------------------------------ EDIT
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
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
    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete_event_' . $event->getId(), $request->request->get('_token'))) {
            $em->remove($event);
            $em->flush();
            $this->addFlash('success', 'Événement supprimé.');
        }

        return $this->redirectToRoute('admin_event_index');
    }

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
            }
        }

        return $errors;
    }
}

