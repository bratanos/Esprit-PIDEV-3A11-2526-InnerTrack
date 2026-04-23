<?php

namespace App\Controller;

use App\Entity\ChatLock;
use App\Entity\Report;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher,
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

        if ($report->getStatus() === 'RESOLVED') {
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

    // ─────────────────────────────────────────────
    //  USER CRUD (temporary validation tab)
    // ─────────────────────────────────────────────

    #[Route('/users/{id}', name: 'user_get', methods: ['GET'])]
    public function fetchUser(User $user): JsonResponse
    {
        return new JsonResponse([
            'id'        => $user->getId(),
            'firstName' => $user->getFirstName(),
            'lastName'  => $user->getLastName(),
            'email'     => $user->getEmail(),
            'phone'     => $user->getPhoneNumber(),
            'role'      => $user->getPrimaryRole(),
            'status'    => $user->getStatus(),
        ]);
    }

    #[Route('/users', name: 'user_create', methods: ['POST'])]
    public function createUser(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // ── Validation ──
        $errors = [];
        $firstName = trim($data['firstName'] ?? '');
        $lastName  = trim($data['lastName']  ?? '');
        $email     = trim($data['email']     ?? '');
        $password  = $data['password'] ?? '';
        $role      = $data['role']     ?? 'ROLE_USER';
        $phone     = trim($data['phone']     ?? '');

        if (strlen($firstName) < 2)   $errors['firstName'] = 'At least 2 characters required.';
        if (strlen($lastName)  < 2)   $errors['lastName']  = 'At least 2 characters required.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Invalid email address.';
        if (strlen($password)  < 8)   $errors['password']  = 'Password must be at least 8 characters.';
        if (!in_array($role, ['ROLE_USER', 'ROLE_PSYCHOLOGUE', 'ROLE_ADMIN'])) $errors['role'] = 'Invalid role.';
        if ($phone && !preg_match('/^[+]?[0-9 \-().]{6,20}$/', $phone)) $errors['phone'] = 'Invalid phone number.';

        // Duplicate email check
        if (!isset($errors['email'])) {
            $existing = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
            if ($existing) $errors['email'] = 'Email already in use.';
        }

        if ($errors) return new JsonResponse(['errors' => $errors], 422);

        $user = new User();
        $user->setFirstName($firstName)
             ->setLastName($lastName)
             ->setEmail($email)
             ->setPassword($this->hasher->hashPassword($user, $password))
             ->setRoles([$role])
             ->setStatus('ACTIVE')
             ->setIsVerified(true);

        if ($phone) $user->setPhoneNumber($phone);

        $this->em->persist($user);
        $this->em->flush();

        return new JsonResponse(['success' => true, 'id' => $user->getId()], 201);
    }

    #[Route('/users/{id}/edit', name: 'user_update', methods: ['POST'])]
    public function updateUser(User $user, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // ── Validation ──
        $errors = [];
        $firstName = trim($data['firstName'] ?? '');
        $lastName  = trim($data['lastName']  ?? '');
        $email     = trim($data['email']     ?? '');
        $password  = $data['password'] ?? '';
        $role      = $data['role']     ?? $user->getPrimaryRole();
        $phone     = trim($data['phone']     ?? '');
        $status    = $data['status']   ?? $user->getStatus();

        if (strlen($firstName) < 2)   $errors['firstName'] = 'At least 2 characters required.';
        if (strlen($lastName)  < 2)   $errors['lastName']  = 'At least 2 characters required.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Invalid email address.';
        if ($password && strlen($password) < 8) $errors['password'] = 'Password must be at least 8 characters.';
        if (!in_array($role, ['ROLE_USER', 'ROLE_PSYCHOLOGUE', 'ROLE_ADMIN'])) $errors['role'] = 'Invalid role.';
        if (!in_array($status, ['ACTIVE', 'BLOCKED', 'PENDING'])) $errors['status'] = 'Invalid status.';
        if ($phone && !preg_match('/^[+]?[0-9 \-().]{6,20}$/', $phone)) $errors['phone'] = 'Invalid phone number.';

        // Duplicate email check (excluding current user)
        if (!isset($errors['email'])) {
            $existing = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
            if ($existing && $existing->getId() !== $user->getId()) {
                $errors['email'] = 'Email already in use.';
            }
        }

        if ($errors) return new JsonResponse(['errors' => $errors], 422);

        $user->setFirstName($firstName)
             ->setLastName($lastName)
             ->setEmail($email)
             ->setRoles([$role])
             ->setStatus($status)
             ->setPhoneNumber($phone ?: null);

        if ($password) {
            $user->setPassword($this->hasher->hashPassword($user, $password));
        }

        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/users/{id}/delete', name: 'user_delete', methods: ['POST'])]
    public function deleteUser(User $user): JsonResponse
    {
        if (str_contains($user->getPrimaryRole(), 'ADMIN')) {
            return new JsonResponse(['error' => 'Cannot delete an admin account.'], 403);
        }

        $this->em->remove($user);
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    // ─────────────────────────────────────────────
    //  AI REPORT REVIEW (Gemini 2.0 Flash)
    // ─────────────────────────────────────────────

    #[Route('/reports/{id}/ai-review', name: 'report_ai_review', methods: ['POST'])]
    public function aiReviewReport(Report $report): JsonResponse
    {
        $reporter = $report->getReporter();
        $reported = $report->getReported();

        // ── Load conversation messages between the two users ──────────────
        $conn = $this->em->getConnection();
        $messages = $conn->executeQuery(
            'SELECT m.content, m.sent_at, u.first_name, u.last_name
             FROM message m
             JOIN conversation c ON m.conversation_id = c.id
             JOIN user u ON m.sender_id = u.id
             WHERE (c.client_id = ? AND c.therapist_id = ?)
                OR (c.client_id = ? AND c.therapist_id = ?)
             ORDER BY m.sent_at ASC
             LIMIT 80',
            [
                $reporter->getId(), $reported->getId(),
                $reported->getId(), $reporter->getId(),
            ]
        )->fetchAllAssociative();

        // ── Build chat log string ─────────────────────────────────────────
        $chatLog = '';
        foreach ($messages as $msg) {
            $chatLog .= "[{$msg['sent_at']}] {$msg['first_name']} {$msg['last_name']}: {$msg['content']}\n";
        }

        // ── Build Gemini prompt ───────────────────────────────────────────
        $prompt  = "You are a professional content moderation AI for InnerTrack, ";
        $prompt .= "a mental health support platform connecting patients with licensed therapists.\n\n";
        $prompt .= "A user has submitted a report. Analyze the conversation history between the two ";
        $prompt .= "users and determine whether the report is justified.\n\n";
        $prompt .= "REPORT DETAILS:\n";
        $prompt .= "- Reporter: {$reporter->getFirstName()} {$reporter->getLastName()}\n";
        $prompt .= "- Reported user: {$reported->getFirstName()} {$reported->getLastName()}\n";
        $prompt .= "- Reason: {$report->getReason()}\n";
        $prompt .= "- Details: " . ($report->getDetails() ?? 'None provided') . "\n\n";

        if ($chatLog) {
            $prompt .= "CONVERSATION HISTORY (" . count($messages) . " messages, oldest first):\n---\n";
            $prompt .= $chatLog;
            $prompt .= "---\n\n";
        } else {
            $prompt .= "CONVERSATION HISTORY: No messages found between these two users.\n\n";
        }

        $prompt .= "Respond ONLY with a valid JSON object — no markdown, no extra text:\n";
        $prompt .= "{\n";
        $prompt .= '  "verdict": "VALID" | "INVALID" | "UNCERTAIN",' . "\n";
        $prompt .= '  "confidence": "HIGH" | "MEDIUM" | "LOW",' . "\n";
        $prompt .= '  "summary": "2-3 sentence analysis explaining your verdict",' . "\n";
        $prompt .= '  "flagged_messages": ["exact quote from chat"] or [],' . "\n";
        $prompt .= '  "recommendation": "Short advisory note for the admin (no automatic action will be taken)"' . "\n";
        $prompt .= "}";

        // ── Call Gemini API ───────────────────────────────────────────────
        $apiKey = $_ENV['GEMINI_API_KEY'] ?? '';
        $url    = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}";

        $payload = json_encode([
            'contents'         => [['parts' => [['text' => $prompt]]]],
            'generationConfig' => ['temperature' => 0.1, 'maxOutputTokens' => 1024],
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_TIMEOUT        => 30,
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (!$response || $httpCode !== 200) {
            return new JsonResponse(['error' => 'AI service unavailable (HTTP ' . $httpCode . ')'], 503);
        }

        // ── Parse Gemini response ─────────────────────────────────────────
        $geminiData = json_decode($response, true);
        $text       = $geminiData['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$text) {
            return new JsonResponse(['error' => 'Empty response from AI model'], 500);
        }

        // Strip possible markdown code fences
        $text = trim(preg_replace('/^```(?:json)?\s*/m', '', preg_replace('/```$/m', '', $text)));

        $aiResult = json_decode($text, true);
        if (!$aiResult || !isset($aiResult['verdict'])) {
            return new JsonResponse(['error' => 'Could not parse AI response', 'raw' => substr($text, 0, 300)], 500);
        }

        $aiResult['messagesAnalyzed'] = count($messages);

        return new JsonResponse($aiResult);
    }

    // ─── Admin: delete a community post as moderation action ─────────────
    #[Route('/community/post/{id}/delete', name: 'community_post_delete', methods: ['POST'])]
    public function deleteCommunityPost(int $id): JsonResponse
    {
        $post = $this->em->getRepository(\App\Entity\CommunityComment::class)->find($id);
        if (!$post) {
            return new JsonResponse(['error' => 'Post not found'], 404);
        }

        $this->em->remove($post);
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }
}
