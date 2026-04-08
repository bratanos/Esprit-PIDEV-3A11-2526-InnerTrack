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
    public function index(EventRepository $repo): Response
    {
        return $this->render('admin/event/index.html.twig', [
            'events' => $repo->findAll(),
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

    // --------------------------------------------------------- HELPER
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
        }

        return $errors;
    }
}

