<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Inscription;
use App\Repository\EventRepository;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/events', name: 'app_event_')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
class UserEventController extends AbstractController
{
    // ------------------------------------------------------------------ LIST
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(EventRepository $eventRepo, InscriptionRepository $inscRepo): Response
    {
        $user   = $this->getUser();
        $events = $eventRepo->findBy(['statut' => true], ['date' => 'ASC']);

        // Find which events this user is already registered for
        $myInscriptions = $inscRepo->findBy(['emailParticipant' => $user->getEmail()]);
        $registeredEventIds = [];
        foreach ($myInscriptions as $insc) {
            $registeredEventIds[] = $insc->getEvenement()->getId();
        }

        return $this->render('pages/events/index.html.twig', [
            'events'             => $events,
            'registeredEventIds' => $registeredEventIds,
        ]);
    }

    // ---------------------------------------------------------------- PARTICIPATE
    #[Route('/{id}/participate', name: 'participate', methods: ['POST'])]
    public function participate(Event $event, EntityManagerInterface $em, InscriptionRepository $inscRepo): Response
    {
        $user = $this->getUser();

        // Check if already registered
        $existing = $inscRepo->findOneBy([
            'evenement'        => $event,
            'emailParticipant' => $user->getEmail(),
        ]);

        if ($existing) {
            $this->addFlash('warning', 'Vous êtes déjà inscrit à cet événement.');
            return $this->redirectToRoute('app_event_index');
        }

        // Check capacity
        if ($event->getInscriptions()->count() >= $event->getCapacite()) {
            $this->addFlash('error', 'Cet événement est complet.');
            return $this->redirectToRoute('app_event_index');
        }

        // Check event is active
        if (!$event->isStatut()) {
            $this->addFlash('error', 'Cet événement n\'est plus disponible.');
            return $this->redirectToRoute('app_event_index');
        }

        // Create inscription automatically from user info
        $inscription = new Inscription();
        $inscription->setEvenement($event);
        $inscription->setNomParticipant($user->getFullName());
        $inscription->setEmailParticipant($user->getEmail());
        $inscription->setDateInscription(new \DateTime());

        $em->persist($inscription);
        $em->flush();

        $this->addFlash('success', 'Vous êtes inscrit à "' . $event->getTitre() . '" avec succès !');
        return $this->redirectToRoute('app_event_index');
    }

    // ------------------------------------------------------------ CANCEL
    #[Route('/{id}/cancel', name: 'cancel', methods: ['POST'])]
    public function cancel(Event $event, EntityManagerInterface $em, InscriptionRepository $inscRepo): Response
    {
        $user = $this->getUser();

        $inscription = $inscRepo->findOneBy([
            'evenement'        => $event,
            'emailParticipant' => $user->getEmail(),
        ]);

        if (!$inscription) {
            $this->addFlash('error', 'Vous n\'êtes pas inscrit à cet événement.');
            return $this->redirectToRoute('app_event_index');
        }

        $em->remove($inscription);
        $em->flush();

        $this->addFlash('success', 'Votre inscription à "' . $event->getTitre() . '" a été annulée.');
        return $this->redirectToRoute('app_event_index');
    }
}
