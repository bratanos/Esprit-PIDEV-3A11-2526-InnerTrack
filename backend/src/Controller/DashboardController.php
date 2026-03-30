<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\ContactRequest;
use App\Entity\Message;
use App\Entity\Notification;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $role = $user->getPrimaryRole();

        return match(true) {
            str_contains($role, 'ADMIN') => $this->adminDashboard($user),
            str_contains($role, 'PSYCHOLOGUE') => $this->therapistDashboard($user),
            default => $this->userDashboard($user),
        };
    }

    private function userDashboard(User $user): Response
    {
        $userId = $user->getId();

        // Count active conversations
        $conversationCount = $this->em->createQuery(
            'SELECT COUNT(c) FROM App\Entity\Conversation c
             WHERE (c.client = :uid OR c.therapist = :uid) AND c.status = :status'
        )->setParameter('uid', $userId)->setParameter('status', 'ACTIVE')->getSingleScalarResult();

        // Count unread notifications
        $unreadNotifs = $this->em->createQuery(
            'SELECT COUNT(n) FROM App\Entity\Notification n WHERE n.user = :uid AND n.isRead = false'
        )->setParameter('uid', $userId)->getSingleScalarResult();

        // Count unread messages
        $unreadMessages = $this->em->getConnection()->executeQuery(
            'SELECT COUNT(*) FROM message m
             JOIN conversation c ON m.conversation_id = c.id
             WHERE (c.client_id = ? OR c.therapist_id = ?) AND m.sender_id != ? AND m.is_read = 0',
            [$userId, $userId, $userId]
        )->fetchOne();

        return $this->render('pages/dashboard/user.html.twig', [
            'conversationCount' => $conversationCount,
            'unreadNotifs' => $unreadNotifs,
            'unreadMessages' => $unreadMessages,
        ]);
    }

    private function therapistDashboard(User $user): Response
    {
        $userId = $user->getId();

        // Pending contact requests
        $pendingRequests = $this->em->getRepository(ContactRequest::class)
            ->findBy(['therapist' => $user, 'status' => 'PENDING'], ['createdAt' => 'DESC']);

        // Active patients (from conversations)
        $activePatients = $this->em->createQuery(
            'SELECT c FROM App\Entity\Conversation c
             WHERE c.therapist = :uid AND c.status = :status
             ORDER BY c.createdAt DESC'
        )->setParameter('uid', $userId)->setParameter('status', 'ACTIVE')->getResult();

        // Unread notifications
        $unreadNotifs = $this->em->createQuery(
            'SELECT COUNT(n) FROM App\Entity\Notification n WHERE n.user = :uid AND n.isRead = false'
        )->setParameter('uid', $userId)->getSingleScalarResult();

        // Profile completeness check
        $profile = $user->getTherapistProfile();
        $profileComplete = $profile && $profile->getSpecialization() && $profile->hasLocation();

        return $this->render('pages/dashboard/therapist.html.twig', [
            'pendingRequests' => $pendingRequests,
            'activePatients' => $activePatients,
            'unreadNotifs' => $unreadNotifs,
            'profileComplete' => $profileComplete,
        ]);
    }

    private function adminDashboard(User $user): Response
    {
        $conn = $this->em->getConnection();

        // Analytics
        $totalUsers = $conn->executeQuery('SELECT COUNT(*) FROM user')->fetchOne();
        $totalClients = $conn->executeQuery("SELECT COUNT(*) FROM user WHERE roles LIKE '%ROLE_USER%' AND roles NOT LIKE '%ROLE_ADMIN%' AND roles NOT LIKE '%ROLE_PSYCHOLOGUE%'")->fetchOne();
        $totalTherapists = $conn->executeQuery("SELECT COUNT(*) FROM user WHERE roles LIKE '%ROLE_PSYCHOLOGUE%'")->fetchOne();
        $newThisMonth = $conn->executeQuery('SELECT COUNT(*) FROM user WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW())')->fetchOne();
        $blockedCount = $conn->executeQuery("SELECT COUNT(*) FROM user WHERE status = 'BLOCKED'")->fetchOne();
        $activeCount = $conn->executeQuery("SELECT COUNT(*) FROM user WHERE status = 'ACTIVE'")->fetchOne();
        $pendingCount = $conn->executeQuery("SELECT COUNT(*) FROM user WHERE status = 'PENDING'")->fetchOne();

        // Monthly registrations for chart
        $monthly = $conn->executeQuery(
            "SELECT DATE_FORMAT(created_at, '%b %Y') AS month, COUNT(*) AS cnt
             FROM user WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
             GROUP BY YEAR(created_at), MONTH(created_at)
             ORDER BY YEAR(created_at), MONTH(created_at)"
        )->fetchAllAssociative();

        // Pending reports
        $pendingReports = $conn->executeQuery("SELECT COUNT(*) FROM report WHERE status = 'PENDING'")->fetchOne();

        return $this->render('pages/dashboard/admin.html.twig', [
            'totalUsers' => $totalUsers,
            'totalClients' => $totalClients,
            'totalTherapists' => $totalTherapists,
            'newThisMonth' => $newThisMonth,
            'blockedCount' => $blockedCount,
            'activeCount' => $activeCount,
            'pendingCount' => $pendingCount,
            'monthly' => $monthly,
            'pendingReports' => $pendingReports,
        ]);
    }
}
