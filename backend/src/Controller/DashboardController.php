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

        // Fetch therapists this user is interacting with
        $therapists = $this->em->createQuery(
            'SELECT DISTINCT u FROM App\Entity\User u
             JOIN App\Entity\Conversation c WITH (c.therapist = u)
             WHERE c.client = :uid AND c.status = :status'
        )->setParameter('uid', $userId)->setParameter('status', 'ACTIVE')->getResult();

        return $this->render('pages/dashboard/user.html.twig', [
            'conversationCount' => $conversationCount,
            'unreadNotifs' => $unreadNotifs,
            'unreadMessages' => $unreadMessages,
            'therapists' => $therapists,
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
        // Analytics - Consolidated single query for high performance
        $stats = $conn->executeQuery("
            SELECT 
                (SELECT COUNT(*) FROM user) as totalUsers,
                (SELECT COUNT(*) FROM user WHERE roles LIKE '%ROLE_USER%' AND roles NOT LIKE '%ROLE_ADMIN%' AND roles NOT LIKE '%ROLE_PSYCHOLOGUE%') as totalClients,
                (SELECT COUNT(*) FROM user WHERE roles LIKE '%ROLE_PSYCHOLOGUE%') as totalTherapists,
                (SELECT COUNT(*) FROM user WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW())) as newThisMonth,
                (SELECT COUNT(*) FROM user WHERE status = 'BLOCKED') as blockedCount,
                (SELECT COUNT(*) FROM user WHERE status = 'ACTIVE') as activeCount,
                (SELECT COUNT(*) FROM user WHERE status = 'PENDING') as pendingCount,
                (SELECT COUNT(*) FROM report WHERE status = 'PENDING') as pendingReports
        ")->fetchAssociative();

        // Monthly registrations for chart
        $monthly = $conn->executeQuery(
            "SELECT DATE_FORMAT(created_at, '%b %Y') AS month, COUNT(*) AS cnt
             FROM user WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
             GROUP BY YEAR(created_at), MONTH(created_at)
             ORDER BY YEAR(created_at), MONTH(created_at)"
        )->fetchAllAssociative();

        // Users list for management (all, for CRUD tab)
        $users = $conn->executeQuery("
            SELECT id, first_name, last_name, email, roles, status, created_at, profile_picture, phone_number
            FROM user 
            ORDER BY created_at DESC
        ")->fetchAllAssociative();

        // Recent reports with context
        $reports = $conn->executeQuery("
            SELECT r.id, r.status, r.created_at, r.reason, r.context, r.details,
                   u1.first_name as reporter_first, u1.last_name as reporter_last, u1.profile_picture as reporter_pfp,
                   u2.first_name as reported_first, u2.last_name as reported_last, u2.profile_picture as reported_pfp
            FROM report r
            JOIN user u1 ON r.reporter_id = u1.id
            JOIN user u2 ON r.reported_id = u2.id
            WHERE r.status = 'PENDING'
            ORDER BY r.created_at DESC
            LIMIT 20
        ")->fetchAllAssociative();

        return $this->render('pages/dashboard/admin.html.twig', [
            'totalUsers' => $stats['totalUsers'],
            'totalClients' => $stats['totalClients'],
            'totalTherapists' => $stats['totalTherapists'],
            'newThisMonth' => $stats['newThisMonth'],
            'blockedCount' => $stats['blockedCount'],
            'activeCount' => $stats['activeCount'],
            'pendingCount' => $stats['pendingCount'],
            'monthly' => $monthly,
            'pendingReports' => $stats['pendingReports'],
            'users' => $users,
            'reports' => $reports,
        ]);
    }
}
