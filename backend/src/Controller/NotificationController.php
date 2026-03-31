<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NotificationController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[Route('/notifications', name: 'app_notifications')]
    public function index(): Response
    {
        $notifications = $this->em->getRepository(Notification::class)->findBy(
            ['user' => $this->getUser()],
            ['createdAt' => 'DESC']
        );

        return $this->render('pages/notifications/notifications.html.twig', [
            'notifications' => $notifications,
        ]);
    }

    #[Route('/api/notifications/count', name: 'api_notifications_count', methods: ['GET'])]
    public function unreadCount(): JsonResponse
    {
        $count = $this->em->createQuery(
            'SELECT COUNT(n) FROM App\Entity\Notification n WHERE n.user = :u AND n.isRead = false'
        )->setParameter('u', $this->getUser())->getSingleScalarResult();

        return new JsonResponse(['count' => $count]);
    }

    #[Route('/api/notifications/{id}/read', name: 'api_notifications_read', methods: ['POST'])]
    public function markAsRead(Notification $notification): JsonResponse
    {
        if ($notification->getUser() !== $this->getUser()) {
            return new JsonResponse(['error' => 'Non autorisé'], 403);
        }

        $notification->setIsRead(true);
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/api/notifications/read-all', name: 'api_notifications_read_all', methods: ['POST'])]
    public function markAllAsRead(): JsonResponse
    {
        $this->em->createQuery(
            'UPDATE App\Entity\Notification n SET n.isRead = true WHERE n.user = :u AND n.isRead = false'
        )->setParameter('u', $this->getUser())->execute();

        return new JsonResponse(['success' => true]);
    }
}
