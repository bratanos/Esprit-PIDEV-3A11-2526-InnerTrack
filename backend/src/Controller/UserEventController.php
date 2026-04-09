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
use Dompdf\Dompdf;
use Dompdf\Options;

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
        $registeredStatuses = [];
        foreach ($myInscriptions as $insc) {
            $registeredStatuses[$insc->getEvenement()->getId()] = $insc->getStatut();
        }

        return $this->render('pages/events/index.html.twig', [
            'events'             => $events,
            'registeredStatuses' => $registeredStatuses,
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

        // Check capacity and determine status
        $status = Inscription::STATUS_CONFIRMED;
        $activeInscriptions = $inscRepo->count([
            'evenement' => $event,
            'statut' => Inscription::STATUS_CONFIRMED
        ]);

        if ($activeInscriptions >= $event->getCapacite()) {
            $status = Inscription::STATUS_WAITING;
            $this->addFlash('warning', 'Événement complet. Vous avez été ajouté à la liste d\'attente.');
        } else {
            $this->addFlash('success', 'Vous êtes inscrit à "' . $event->getTitre() . '" avec succès !');
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
        $inscription->setStatut($status);

        $em->persist($inscription);
        $em->flush();

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
        
        // Promote next user in waiting list if any
        $oldestWaiting = $inscRepo->findOldestWaitingList($event);
        if ($oldestWaiting) {
            $oldestWaiting->setStatut(Inscription::STATUS_CONFIRMED);
            $em->flush();
        }

        $this->addFlash('success', 'Votre inscription à "' . $event->getTitre() . '" a été annulée.');
        return $this->redirectToRoute('app_event_index');
    }

    // ------------------------------------------------------------ CERTIFICATE
    #[Route('/{id}/certificate', name: 'certificate', methods: ['GET'])]
    public function certificate(Event $event, InscriptionRepository $inscRepo): Response
    {
        $user = $this->getUser();
        $inscription = $inscRepo->findOneBy([
            'evenement' => $event,
            'emailParticipant' => $user->getEmail(),
            'statut' => Inscription::STATUS_CONFIRMED
        ]);

        if (!$inscription) {
            $this->addFlash('error', 'Vous n\'étiez pas confirmé pour cet événement.');
            return $this->redirectToRoute('app_event_index');
        }

        if ($event->getDate() > new \DateTime()) {
            $this->addFlash('error', 'L\'événement n\'est pas encore terminé.');
            return $this->redirectToRoute('app_event_index');
        }

        $html = $this->renderView('pages/events/certificate.html.twig', [
            'inscription' => $inscription,
            'event' => $event
        ]);

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream("Attestation_" . $event->getId() . ".pdf", [
            "Attachment" => true
        ]);
        
        return new Response();
    }
}
