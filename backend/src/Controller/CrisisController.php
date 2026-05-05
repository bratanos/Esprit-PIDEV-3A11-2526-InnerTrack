<?php

namespace App\Controller;

use App\Entity\CrisisLog;
use App\Entity\ContactRequest;
use App\Repository\CrisisLogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crisis', name: 'app_crisis_')]
class CrisisController extends AbstractController
{
    #[Route('/grounding', name: 'grounding')]
    public function groundingMode(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('pages/crisis/grounding.html.twig');
    }

    #[Route('/api/log', name: 'api_log', methods: ['POST'])]
    public function logCrisis(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['error' => 'Unauthorized'], 401);
        }

        $data = json_decode($request->getContent(), true);

        $log = new CrisisLog();
        $log->setUser($user);
        $log->setIntensity($data['intensity'] ?? null);
        $log->setCopingMechanismUsed($data['mechanism'] ?? 'Unspecified');
        $log->setNotes($data['notes'] ?? null);

        // If they resolve it immediately or we just log the event
        if (isset($data['resolved']) && $data['resolved']) {
            $log->setResolvedAt(new \DateTimeImmutable());
        }

        $em->persist($log);
        $em->flush();

        return new JsonResponse(['success' => true, 'id' => $log->getId()]);
    }

    #[Route('/api/resolve/{id}', name: 'api_resolve', methods: ['POST'])]
    public function resolveCrisis(CrisisLog $log, EntityManagerInterface $em): JsonResponse
    {
        if ($log->getUser() !== $this->getUser()) {
            return new JsonResponse(['error' => 'Unauthorized'], 403);
        }

        $log->setResolvedAt(new \DateTimeImmutable());
        $em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/therapist/logs', name: 'therapist_logs')]
    public function therapistLogs(EntityManagerInterface $em): Response
    {
        $therapist = $this->getUser();
        if (!$therapist || !in_array('ROLE_PSYCHOLOGUE', $therapist->getRoles())) {
            throw $this->createAccessDeniedException('Only therapists can access this page.');
        }

        // Get all clients that have an ACCEPTED contact request with this therapist
        $contactRequests = $em->getRepository(ContactRequest::class)->findBy([
            'therapist' => $therapist,
            'status' => 'ACCEPTED'
        ]);

        $clientIds = array_map(fn($cr) => $cr->getClient()->getId(), $contactRequests);

        if (empty($clientIds)) {
            $crisisLogs = [];
        } else {
            // Get all crisis logs for these clients, ordered by newest first
            $qb = $em->getRepository(CrisisLog::class)->createQueryBuilder('c')
                ->where('c.user IN (:clients)')
                ->setParameter('clients', $clientIds)
                ->orderBy('c.triggeredAt', 'DESC');
            $crisisLogs = $qb->getQuery()->getResult();
        }

        return $this->render('pages/crisis/therapist_logs.html.twig', [
            'logs' => $crisisLogs,
            'clientCount' => count($clientIds)
        ]);
    }
}
