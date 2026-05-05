<?php

namespace App\Controller;

use App\Entity\BlockedUser;
use App\Entity\Conversation;
use App\Entity\Message;
use App\Entity\Notification;
use App\Entity\Report;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MessagingController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[Route('/messages/{id}', name: 'app_messages_show', methods: ['GET'])]
    #[Route('/messages', name: 'app_messages', methods: ['GET'])]
    public function index(?int $id = null): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        
        $conversations = $this->em->createQuery(
            'SELECT c FROM App\Entity\Conversation c
             WHERE (c.client = :u OR c.therapist = :u) AND c.status = :status
             ORDER BY c.createdAt DESC'
        )->setParameter('u', $user)->setParameter('status', 'ACTIVE')->getResult();

        return $this->render('pages/messages/messages.html.twig', [
            'conversations' => $conversations,
            'openId' => $id,
        ]);
    }

    #[Route('/_messaging/api/{id}', name: 'api_messages_get', methods: ['GET'])]
    public function getMessages(Conversation $conversation, Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        
        if ($conversation->getClient()->getId() !== $user->getId() && $conversation->getTherapist()->getId() !== $user->getId()) {
            return new JsonResponse(['error' => 'Non autorisé'], 403);
        }

        $lastId = $request->query->get('lastId');
        
        $qb = $this->em->createQueryBuilder()
            ->select('m')
            ->from(Message::class, 'm')
            ->where('m.conversation = :conv')
            ->setParameter('conv', $conversation)
            ->orderBy('m.id', 'ASC');

        if ($lastId) {
            $qb->andWhere('m.id > :lastId')
               ->setParameter('lastId', $lastId);
        }

        $messages = $qb->getQuery()->getResult();

        $data = [];
        foreach ($messages as $msg) {
            $data[] = [
                'id' => $msg->getId(),
                'content' => $msg->getContent(),
                'senderId' => $msg->getSender()->getId(),
                'senderName' => $msg->getSender()->getFullName(),
                'sentAt' => $msg->getSentAt()->format('Y-m-d H:i:s'),
                'isMe' => $msg->getSender()->getId() === $user->getId(),
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/_messaging/api/{id}/send', name: 'api_messages_send', methods: ['POST'])]
    public function sendMessage(Conversation $conversation, Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        
        if ($conversation->getClient()->getId() !== $user->getId() && $conversation->getTherapist()->getId() !== $user->getId()) {
            return new JsonResponse(['error' => 'Non autorisé'], 403);
        }

        // Check if blocked
        $clientId = $conversation->getClient()->getId();
        $therapistId = $conversation->getTherapist()->getId();
        $isBlocked = $this->em->getRepository(BlockedUser::class)->findOneBy([
            'client' => $conversation->getClient(),
            'therapist' => $conversation->getTherapist()
        ]) !== null;

        if ($isBlocked) {
            return new JsonResponse(['error' => 'Impossible d\'envoyer un message : bloque.'], 403);
        }

        $data = json_decode($request->getContent(), true);
        $content = trim($data['content'] ?? '');

        if (!$content) {
            return new JsonResponse(['error' => 'Message vide'], 400);
        }

        $msg = new Message();
        $msg->setConversation($conversation);
        $msg->setSender($user);
        $msg->setContent($content);

        $this->em->persist($msg);

        // Notify other user
        $otherUser = $conversation->getOtherUser($user);
        $notif = new Notification();
        $notif->setUser($otherUser);
        $notif->setType('MESSAGE');
        $notif->setTitle('Nouveau message');
        $notif->setBody($user->getFullName() . ' vous a envoyé un message.');
        $notif->setReferenceId($conversation->getId());
        $this->em->persist($notif);

        $this->em->flush();

        return new JsonResponse([
            'id' => $msg->getId(),
            'content' => $msg->getContent(),
            'senderId' => $user->getId(),
            'sentAt' => $msg->getSentAt()->format('Y-m-d H:i:s'),
            'isMe' => true
        ]);
    }

    #[Route('/_messaging/api/{id}/read', name: 'api_messages_read', methods: ['POST'])]
    public function markAsRead(Conversation $conversation): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        
        $this->em->createQuery(
            'UPDATE App\Entity\Message m SET m.isRead = true
             WHERE m.conversation = :conv AND m.sender != :user AND m.isRead = false'
        )
        ->setParameter('conv', $conversation)
        ->setParameter('user', $user)
        ->execute();

        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/api/report', name: 'api_report_user', methods: ['POST'])]
    public function reportUser(Request $request): JsonResponse
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();

        $data = json_decode($request->getContent(), true);
        $reportedId = $data['reportedId'] ?? null;
        $reason = $data['reason'] ?? 'OTHER';
        $details = $data['details'] ?? null;

        if (!$reportedId) {
            return new JsonResponse(['error' => 'ID manquant'], 400);
        }

        $reported = $this->em->getRepository(User::class)->find($reportedId);
        if (!$reported) {
            return new JsonResponse(['error' => 'Utilisateur introuvable'], 404);
        }

        $report = new Report();
        $report->setReporter($currentUser);
        $report->setReported($reported);
        $report->setReason($reason);
        $report->setDetails($details);
        $report->setContext('MESSAGING');

        $this->em->persist($report);

        // Notify admins
        $admins = $this->em->createQuery("SELECT u FROM App\Entity\User u WHERE u.roles LIKE '%ROLE_ADMIN%'")->getResult();
        foreach ($admins as $admin) {
            $notif = new Notification();
            $notif->setUser($admin);
            $notif->setTitle('Nouveau signalement');
            $notif->setBody($currentUser->getFullName() . ' a signalé un utilisateur.');
            $this->em->persist($notif);
        }

        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/api/block', name: 'api_block_user', methods: ['POST'])]
    public function blockUser(Request $request): JsonResponse
    {
        /** @var User $me */
        $me = $this->getUser();
        
        $data = json_decode($request->getContent(), true);
        $otherUserId = $data['userId'] ?? null;

        if (!$otherUserId) {
            return new JsonResponse(['error' => 'ID manquant'], 400);
        }

        $otherUser = $this->em->getRepository(User::class)->find($otherUserId);
        if (!$otherUser) {
            return new JsonResponse(['error' => 'Utilisateur introuvable'], 404);
        }

        $isMeTherapist = str_contains($me->getPrimaryRole(), 'PSYCHOLOGUE');
        $client = $isMeTherapist ? $otherUser : $me;
        $therapist = $isMeTherapist ? $me : $otherUser;

        // Ensure not already blocked
        $existing = $this->em->getRepository(BlockedUser::class)->findOneBy([
            'client' => $client,
            'therapist' => $therapist
        ]);

        if (!$existing) {
            $block = new BlockedUser();
            $block->setClient($client);
            $block->setTherapist($therapist);
            $this->em->persist($block);
            $this->em->flush();
        }

        return new JsonResponse(['success' => true]);
    }
}
