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
            'SELECT COUNT(n) FROM App\Entity\Notification n WHERE n.user = :uid AND n.isRead = false'
        )->setParameter('uid', $userId)->getSingleScalarResult();

        // Unread Messages
        $unreadMessages = (int) $this->em->getConnection()->executeQuery(
            'SELECT COUNT(*) FROM message m
             JOIN conversation c ON m.conversation_id = c.id
             WHERE (c.client_id = ? OR c.therapist_id = ?) AND m.sender_id != ? AND m.is_read = 0',
            [$userId, $userId, $userId]
        )->fetchOne();

        return [
            'unread_notifications_count' => (int) $unreadNotifs,
            'unread_messages_count' => $unreadMessages,
        ];
    }
}
