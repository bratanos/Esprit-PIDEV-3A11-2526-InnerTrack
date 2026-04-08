<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Inscription;
use App\Repository\EventRepository;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/inscriptions', name: 'admin_inscription_')]
class InscriptionController extends AbstractController
{
    // ------------------------------------------------------------------ LIST
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(InscriptionRepository $repo): Response
    {
        return $this->render('admin/inscription/index.html.twig', [
            'inscriptions' => $repo->findAll(),
        ]);
    }

    // ------------------------------------------------------------------ NEW
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em, EventRepository $eventRepo): Response
    {
        $errors      = [];
        $inscription = new Inscription();

        if ($request->isMethod('POST')) {
            $errors = $this->processForm($request, $inscription, $eventRepo);

            if (empty($errors)) {
                $em->persist($inscription);
                $em->flush();
                $this->addFlash('success', 'Inscription ajoutée avec succès.');
                return $this->redirectToRoute('admin_inscription_index');
            }
        }

        return $this->render('admin/inscription/new.html.twig', [
            'inscription' => $inscription,
            'errors'      => $errors,
            'events'      => $eventRepo->findAll(),
        ]);
    }

    // ------------------------------------------------------------------ SHOW
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Inscription $inscription): Response
    {
        return $this->render('admin/inscription/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    // ------------------------------------------------------------------ EDIT
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inscription $inscription, EntityManagerInterface $em, EventRepository $eventRepo): Response
    {
        $errors = [];

        if ($request->isMethod('POST')) {
            $errors = $this->processForm($request, $inscription, $eventRepo);

            if (empty($errors)) {
                $em->flush();
                $this->addFlash('success', 'Inscription mise à jour.');
                return $this->redirectToRoute('admin_inscription_index');
            }
        }

        return $this->render('admin/inscription/edit.html.twig', [
            'inscription' => $inscription,
            'errors'      => $errors,
            'events'      => $eventRepo->findAll(),
        ]);
    }

    // ---------------------------------------------------------------- DELETE
    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Inscription $inscription, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete_inscription_' . $inscription->getId(), $request->request->get('_token'))) {
            $em->remove($inscription);
            $em->flush();
            $this->addFlash('success', 'Inscription supprimée.');
        }

        return $this->redirectToRoute('admin_inscription_index');
    }

    // --------------------------------------------------------- HELPER
    private function processForm(Request $request, Inscription $inscription, EventRepository $eventRepo): array
    {
        $errors = [];

        $nom      = trim($request->request->get('nom_participant', ''));
        $email    = trim($request->request->get('email_participant', ''));
        $date     = $request->request->get('date_inscription', '');
        $eventId  = $request->request->get('evenement_id', '');

        if (strlen($nom) < 2) {
            $errors['nom_participant'] = 'Le nom doit contenir au moins 2 caractères.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email_participant'] = 'Email invalide.';
        }
        if (empty($date)) {
            $errors['date_inscription'] = 'La date d\'inscription est obligatoire.';
        }

        $event = $eventRepo->find((int)$eventId);
        if (!$event) {
            $errors['evenement_id'] = 'Veuillez sélectionner un événement valide.';
        }

        if (empty($errors)) {
            $inscription->setNomParticipant($nom);
            $inscription->setEmailParticipant($email);
            $inscription->setDateInscription(new \DateTime($date));
            $inscription->setEvenement($event);
        }

        return $errors;
    }
}
