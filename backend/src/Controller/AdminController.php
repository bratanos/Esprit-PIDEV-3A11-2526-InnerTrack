<?php

namespace App\Controller;

use App\Entity\ChatLock;
use App\Entity\Report;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[Route('/users/block/{id}', name: 'user_block', methods: ['POST'])]
    public function blockUser(User $user): JsonResponse
    {
        if (str_contains($user->getPrimaryRole(), 'ADMIN')) {
            return new JsonResponse(['error' => 'Impossible de bloquer un admin'], 403);
        }

        $user->setStatus($user->getStatus() === 'BLOCKED' ? 'ACTIVE' : 'BLOCKED');
        $this->em->flush();

        return new JsonResponse(['success' => true, 'newStatus' => $user->getStatus()]);
    }

    #[Route('/reports/{id}/resolve', name: 'report_resolve', methods: ['POST'])]
    public function resolveReport(Report $report, Request $request): JsonResponse
    {
        /** @var User $admin */
        $admin = $this->getUser();

        $data = json_decode($request->getContent(), true);
        $action = $data['action'] ?? null;

        if (!$report->isPending()) {
            return new JsonResponse(['error' => 'Déjà résolu'], 400);
        }

        $report->setStatus('RESOLVED');
        $report->setReviewedAt(new \DateTime());
        $report->setReviewedBy($admin->getId());

        if ($action === 'BLOCK_USER') {
            $reportedUser = $report->getReported();
            if (!str_contains($reportedUser->getPrimaryRole(), 'ADMIN')) {
                $reportedUser->setStatus('BLOCKED');
            }
        }

        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    

    #[Route('/chat-lock', name: 'chat_lock_add', methods: ['POST'])]
    public function addChatLock(Request $request): JsonResponse
    {
        /** @var User $admin */
        $admin = $this->getUser();
        $data = json_decode($request->getContent(), true);
        
        $userId = $data['userId'] ?? null;
        $reason = $data['reason'] ?? 'Violation des règles';
        $durationHours = $data['durationHours'] ?? null;

        $user = $this->em->getRepository(User::class)->find($userId);
        if (!$user) {
            return new JsonResponse(['error' => 'Utilisateur introuvable'], 404);
        }

        $lock = new ChatLock();
        $lock->setUser($user);
        $lock->setReason($reason);
        $lock->setLockedBy($admin->getId());

        if ($durationHours) {
            $until = new \DateTime();
            $until->modify("+{$durationHours} hours");
            $lock->setLockedUntil($until);
        }

        $this->em->persist($lock);
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/chat-lock/{id}/remove', name: 'chat_lock_remove', methods: ['POST'])]
    public function removeChatLock(ChatLock $lock): JsonResponse
    {
        $lock->setIsActive(false);
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }
}
