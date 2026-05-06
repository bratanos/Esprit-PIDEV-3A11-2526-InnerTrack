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
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class DashboardController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private CacheInterface $cache,
    ) {}

    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $role = $user->getPrimaryRole();

        return match(true) {
            str_contains($role, 'ADMIN')      => $this->adminDashboard($user),
            str_contains($role, 'PSYCHOLOGUE') => $this->therapistDashboard($user),
            default                            => $this->userDashboard($user),
        };
    }

    // ─────────────────────────────────────────────────────────────
    //  USER DASHBOARD
    // ─────────────────────────────────────────────────────────────
    private function userDashboard(User $user): Response
    {
        $userId = $user->getId();

        // Cache all dashboard stats for 5 minutes to prevent expensive queries on every navigation
        $stats = $this->cache->get('user_dashboard_stats_' . $userId, function (ItemInterface $item) use ($userId) {
            $item->expiresAfter(300); // 5 minutes

            $conversationCount = $this->em->createQuery(
                'SELECT COUNT(c) FROM App\Entity\Conversation c
                 WHERE (c.client = :uid OR c.therapist = :uid) AND c.status = :status'
            )->setParameter('uid', $userId)->setParameter('status', 'ACTIVE')->getSingleScalarResult();

            $unreadNotifs = $this->em->createQuery(
                'SELECT COUNT(n) FROM App\Entity\Notification n WHERE n.user = :uid AND n.isRead = false'
            )->setParameter('uid', $userId)->getSingleScalarResult();

            $unreadMessages = $this->em->getConnection()->executeQuery(
                'SELECT COUNT(*) FROM message m
                 JOIN conversation c ON m.conversation_id = c.id
                 WHERE (c.client_id = ? OR c.therapist_id = ?) AND m.sender_id != ? AND m.is_read = 0',
                [$userId, $userId, $userId]
            )->fetchOne();

            $therapists = $this->em->createQuery(
                'SELECT DISTINCT u FROM App\Entity\User u
                 JOIN App\Entity\Conversation c WITH (c.therapist = u)
                 WHERE c.client = :uid AND c.status = :status'
            )->setParameter('uid', $userId)->setParameter('status', 'ACTIVE')->getResult();

            return [
                'conversationCount' => $conversationCount,
                'unreadNotifs'      => $unreadNotifs,
                'unreadMessages'    => $unreadMessages,
                'therapists'        => $therapists,
            ];
        });

        return $this->render('pages/dashboard/user.html.twig', [
            'conversationCount' => $stats['conversationCount'],
            'unreadNotifs'      => $stats['unreadNotifs'],
            'unreadMessages'    => $stats['unreadMessages'],
            'therapists'        => $stats['therapists'],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    //  THERAPIST DASHBOARD
    // ─────────────────────────────────────────────────────────────
    private function therapistDashboard(User $user): Response
    {
        $userId = $user->getId();

        $pendingRequests = $this->em->getRepository(ContactRequest::class)
            ->findBy(['therapist' => $user, 'status' => 'PENDING'], ['createdAt' => 'DESC']);

        $activePatients = $this->em->createQuery(
            'SELECT c FROM App\Entity\Conversation c
             WHERE c.therapist = :uid AND c.status = :status
             ORDER BY c.createdAt DESC'
        )->setParameter('uid', $userId)->setParameter('status', 'ACTIVE')->getResult();

        $unreadNotifs = $this->em->createQuery(
            'SELECT COUNT(n) FROM App\Entity\Notification n WHERE n.user = :uid AND n.isRead = false'
        )->setParameter('uid', $userId)->getSingleScalarResult();

        $profile        = $user->getTherapistProfile();
        $profileComplete = $profile && $profile->getSpecialization() && $profile->hasLocation();

        return $this->render('pages/dashboard/therapist.html.twig', [
            'pendingRequests' => $pendingRequests,
            'activePatients'  => $activePatients,
            'unreadNotifs'    => $unreadNotifs,
            'profileComplete' => $profileComplete,
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    //  ADMIN DASHBOARD
    // ─────────────────────────────────────────────────────────────
    private function adminDashboard(User $user): Response
    {
        $conn = $this->em->getConnection();

        // ── User counts (single consolidated query) ───────────────
        $stats = $conn->executeQuery("
            SELECT
                (SELECT COUNT(*) FROM user)                                                                                             AS totalUsers,
                (SELECT COUNT(*) FROM user WHERE roles LIKE '%ROLE_USER%'
                    AND roles NOT LIKE '%ROLE_ADMIN%' AND roles NOT LIKE '%ROLE_PSYCHOLOGUE%')                                          AS totalClients,
                (SELECT COUNT(*) FROM user WHERE roles LIKE '%ROLE_PSYCHOLOGUE%')                                                       AS totalTherapists,
                (SELECT COUNT(*) FROM user WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW()))                   AS newThisMonth,
                (SELECT COUNT(*) FROM user WHERE status = 'BLOCKED')                                                                    AS blockedCount,
                (SELECT COUNT(*) FROM user WHERE status = 'ACTIVE')                                                                     AS activeCount,
                (SELECT COUNT(*) FROM user WHERE status = 'PENDING')                                                                    AS pendingCount,
                (SELECT COUNT(*) FROM report WHERE status = 'PENDING')                                                                  AS pendingReports
        ")->fetchAssociative() ?: [];

        // ── Monthly registrations (last 6 months) for bar chart ───
        $monthly = $conn->executeQuery(
            "SELECT DATE_FORMAT(created_at, '%b %Y') AS month, COUNT(*) AS cnt
             FROM user
             WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
             GROUP BY YEAR(created_at), MONTH(created_at)
             ORDER BY YEAR(created_at), MONTH(created_at)"
        )->fetchAllAssociative();

        // Dynamic max so the tallest bar always reaches 100 % height
        $monthlyMax = 1;
        foreach ($monthly as $m) {
            if ((int) $m['cnt'] > $monthlyMax) {
                $monthlyMax = (int) $m['cnt'];
            }
        }

        // ── Real system metrics ────────────────────────────────────

        // Security Score: ratio of ACTIVE users to total (0–100 %)
        $total         = max(1, (int) ($stats['totalUsers'] ?? 1));
        $securityScore = (int) round(((int) ($stats['activeCount'] ?? 0) / $total) * 100);

        // Health Score: DB round-trip latency → mapped to 0–100 %
        //   <1 ms ≈ 100 %, 100 ms → 0 % (clamped)
        $t0           = microtime(true);
        $conn->executeQuery('SELECT 1');
        $dbLatencyMs  = round((microtime(true) - $t0) * 1000, 1);
        $healthScore  = (int) max(0, min(100, round(100 - ($dbLatencyMs / 100) * 100)));
        $healthLabel  = match(true) {
            $healthScore >= 95 => 'Excellent',
            $healthScore >= 80 => 'Good',
            $healthScore >= 60 => 'Fair',
            default            => 'Degraded',
        };

        // API Load: messages sent in the last hour (platform activity proxy)
        //   300 msg/hr = 100 % capacity
        $recentMessages = (int) $conn->executeQuery(
            "SELECT COUNT(*) FROM message WHERE sent_at >= DATE_SUB(NOW(), INTERVAL 1 HOUR)"
        )->fetchOne();
        $apiLoadScore = min(100, (int) round($recentMessages / 3));
        $apiLoadLabel = match(true) {
            $recentMessages > 200 => 'High',
            $recentMessages > 50  => 'Moderate',
            $recentMessages > 10  => 'Normal',
            default               => 'Low',
        };

        // ── User list (CRUD tab) ───────────────────────────────────
        $users = $conn->executeQuery("
            SELECT id, first_name, last_name, email, roles, status, created_at, profile_picture, phone_number
            FROM user
            ORDER BY created_at DESC
        ")->fetchAllAssociative();

        // ── Pending messaging reports ────────────────────────────
        $messagingReports = $conn->executeQuery("
            SELECT r.id, r.status, r.created_at, r.reason, r.context, r.details,
                   u1.first_name AS reporter_first, u1.last_name AS reporter_last, u1.profile_picture AS reporter_pfp,
                   u2.id AS reported_user_id,
                   u2.first_name AS reported_first, u2.last_name AS reported_last, u2.profile_picture AS reported_pfp
            FROM report r
            JOIN user u1 ON r.reporter_id = u1.id
            JOIN user u2 ON r.reported_id = u2.id
            WHERE r.status NOT IN ('RESOLVED') AND r.context = 'MESSAGING'
            ORDER BY r.created_at DESC
            LIMIT 20
        ")->fetchAllAssociative();

        // ── Pending community reports (with post snippet from details) ───
        $communityReports = $conn->executeQuery("
            SELECT r.id, r.status, r.created_at, r.reason, r.context, r.details,
                   u1.first_name AS reporter_first, u1.last_name AS reporter_last, u1.profile_picture AS reporter_pfp,
                   u2.id AS reported_user_id,
                   u2.first_name AS reported_first, u2.last_name AS reported_last, u2.profile_picture AS reported_pfp,
                   cc.id AS post_id, cc.content AS post_content, cc.title AS post_title
            FROM report r
            JOIN user u1 ON r.reporter_id = u1.id
            JOIN user u2 ON r.reported_id = u2.id
            LEFT JOIN community_comment cc ON cc.user_id = u2.id AND cc.content LIKE CONCAT('%', SUBSTRING(r.details, 1, 50), '%')
            WHERE r.status NOT IN ('RESOLVED') AND r.context = 'COMMUNITY'
            ORDER BY r.created_at DESC
            LIMIT 20
        ")->fetchAllAssociative();

        // ── Sanctions (Blocked users + Chat Locks) ───────────────────────
        $sanctions = $conn->executeQuery("
            SELECT u.id as user_id, u.id as sanction_id, u.first_name, u.last_name, u.email, u.profile_picture, u.status,
                   'ACCOUNT_BAN' as type, 'Permanent Ban' as reason, u.created_at as punished_at, NULL as punished_until
            FROM user u
            WHERE u.status = 'BLOCKED'
            UNION ALL
            SELECT u.id as user_id, cl.id as sanction_id, u.first_name, u.last_name, u.email, u.profile_picture, u.status,
                   'CHAT_LOCK' as type, cl.reason, cl.locked_at as punished_at, cl.locked_until as punished_until
            FROM chat_lock cl
            JOIN user u ON cl.user_id = u.id
            WHERE cl.is_active = 1
            ORDER BY punished_at DESC
        ")->fetchAllAssociative();

        return $this->render('pages/dashboard/admin.html.twig', [
            'sanctions'        => $sanctions,
            // User analytics
            'totalUsers'      => $stats['totalUsers']      ?? 0,
            'totalClients'    => $stats['totalClients']    ?? 0,
            'totalTherapists' => $stats['totalTherapists'] ?? 0,
            'newThisMonth'    => $stats['newThisMonth']    ?? 0,
            'blockedCount'    => $stats['blockedCount']    ?? 0,
            'activeCount'     => $stats['activeCount']     ?? 0,
            'pendingCount'    => $stats['pendingCount']    ?? 0,
            // Chart
            'monthly'         => $monthly,
            'monthlyMax'      => $monthlyMax,
            // Reports
            'pendingReports'   => $stats['pendingReports']   ?? 0,
            'users'            => $users,
            'messagingReports' => $messagingReports,
            'communityReports' => $communityReports,
            // Real system metrics
            'securityScore'   => $securityScore,
            'healthScore'     => $healthScore,
            'healthLabel'     => $healthLabel,
            'dbLatencyMs'     => $dbLatencyMs,
            'apiLoadLabel'    => $apiLoadLabel,
            'apiLoadScore'    => $apiLoadScore,
            'recentMessages'  => $recentMessages,
        ]);
    }
}