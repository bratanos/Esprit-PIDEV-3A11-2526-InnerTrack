<?php

namespace App\Twig;

use App\Entity\Message;
use App\Entity\Notification;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(
        private Security $security,
        private EntityManagerInterface $em
    ) {}

    public function getGlobals(): array
    {
        try {
            /** @var User|null $user */
            $user = $this->security->getUser();

            if (!$user) {
                return [
                    'unread_notifications_count' => 0,
                    'unread_messages_count' => 0,
                ];
            }

            $userId = $user->getId();

            // Unread Notifications
            $unreadNotifs = $this->em->createQuery(
                'SELECT COUNT(n) FROM App\Entity\Notification n 
                 WHERE n.user = :uid AND n.isRead = false'
            )->setParameter('uid', $userId)->getSingleScalarResult();

            // Unread Messages (using DQL for consistency and safety)
            $unreadMessages = $this->em->createQuery(
                'SELECT COUNT(m) FROM App\Entity\Message m
                 JOIN m.conversation c
                 WHERE (c.client = :uid OR c.therapist = :uid) 
                 AND m.sender != :uid 
                 AND m.isRead = false'
            )->setParameter('uid', $userId)->getSingleScalarResult();

            return [
                'unread_notifications_count' => (int) $unreadNotifs,
                'unread_messages_count' => (int) $unreadMessages,
            ];
        } catch (\Exception $e) {
            // Fallback to 0 if database is not ready or query fails
            return [
                'unread_notifications_count' => 0,
                'unread_messages_count' => 0,
            ];
        }
    }
}
