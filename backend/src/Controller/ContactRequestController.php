<?php

namespace App\Controller;

use App\Entity\ContactRequest;
use App\Entity\Conversation;
use App\Entity\Notification;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ContactRequestController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[Route('/api/requests/{id}/accept', name: 'api_request_accept', methods: ['POST'])]
    public function accept(ContactRequest $request): JsonResponse
    {
        /** @var User $therapist */
        $therapist = $this->getUser();

        if ($request->getTherapist() !== $therapist || !$request->isPending()) {
            return new JsonResponse(['error' => 'Action non autorisée'], 403);
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

        return new JsonResponse(['success' => true]);
    }

    #[Route('/api/requests/{id}/reject', name: 'api_request_reject', methods: ['POST'])]
    public function reject(ContactRequest $request): JsonResponse
    {
        /** @var User $therapist */
        $therapist = $this->getUser();

        if ($request->getTherapist() !== $therapist || !$request->isPending()) {
            return new JsonResponse(['error' => 'Action non autorisée'], 403);
        }

        $request->setStatus('REJECTED');
        $request->setRespondedAt(new \DateTime());

        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }
}
