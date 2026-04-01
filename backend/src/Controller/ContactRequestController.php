<?php

namespace App\Controller;

use App\Entity\ContactRequest;
use App\Entity\Conversation;
use App\Entity\Notification;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class ContactRequestController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    #[Route('/requests/{id}/postpone', name: 'contact_request_postpone', methods: ['POST'])]
    public function postpone(ContactRequest $request): RedirectResponse
    {
        /** @var User $therapist */
        $therapist = $this->getUser();

        if($request->getTherapist() !== $therapist || !$request->isPending()){
            throw $this->createAccessDeniedException('Action non autorisée');
        }

        $request->setStatus('PENDING');
        $request->setRespondedAt(null);

        $this->em->flush();

        return $this->redirectToRoute('app_dashboard');
    }

    #[Route('/requests/{id}/accept', name: 'contact_request_accept', methods: ['POST'])]
    public function accept(ContactRequest $request): RedirectResponse
    {
        /** @var User $therapist */
        $therapist = $this->getUser();

        if ($request->getTherapist() !== $therapist || !$request->isPending()) {
            throw $this->createAccessDeniedException('Action non autorisée');
        }

        // Accept request
        $request->setStatus('ACCEPTED');
        $request->setRespondedAt(new \DateTime());

        // Create new conversation
        $conversation = new Conversation();
        $conversation->setClient($request->getClient());
        $conversation->setTherapist($therapist);
        $conversation->setStatus('ACTIVE');

        $this->em->persist($conversation);

        // Notify client
        $notif = new Notification();
        $notif->setUser($request->getClient());
        $notif->setType('CONTACT_REQUEST');
        $notif->setTitle('Demande acceptée');
        $notif->setBody($therapist->getFullName() . ' a accepté votre demande de contact.');

        $this->em->persist($notif);
        $this->em->flush();

        return $this->redirectToRoute('app_dashboard');
    }

    #[Route('/requests/{id}/reject', name: 'contact_request_reject', methods: ['POST'])]
    public function reject(ContactRequest $request): RedirectResponse
    {
        /** @var User $therapist */
        $therapist = $this->getUser();

        if ($request->getTherapist() !== $therapist || !$request->isPending()) {
            throw $this->createAccessDeniedException('Action non autorisée');
        }

        $request->setStatus('REJECTED');
        $request->setRespondedAt(new \DateTime());

        $this->em->flush();

        return $this->redirectToRoute('app_dashboard');
    }
}
