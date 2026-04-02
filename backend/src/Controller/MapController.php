<?php

namespace App\Controller;

use App\Entity\TherapistProfile;
use App\Entity\ContactRequest;
use App\Entity\Notification;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MapController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[Route('/map', name: 'app_map', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/map/map.html.twig');
    }

    #[Route('/map/api/therapists', name: 'api_web_therapists', methods: ['GET'])]
    public function getTherapists(): JsonResponse
    {
        /** @var TherapistProfile[] $profiles */
        $profiles = $this->em->createQuery(
            'SELECT t FROM App\Entity\TherapistProfile t
             JOIN t.user u
             WHERE u.status = :status AND t.latitude IS NOT NULL AND t.longitude IS NOT NULL'
        )->setParameter('status', 'ACTIVE')->getResult();

        $data = [];
        foreach ($profiles as $p) {
            $data[] = [
                'id' => $p->getUser()->getId(),
                'name' => $p->getUser()->getFullName(),
                'specialization' => $p->getSpecialization(),
                'bio' => $p->getBio(),
                'address' => $p->getAddress(),
                'lat' => $p->getLatitude(),
                'lng' => $p->getLongitude(),
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/map/api/setup', name: 'api_web_map_setup', methods: ['POST'])]
    public function setupLocation(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!str_contains($user->getPrimaryRole(), 'PSYCHOLOGUE')) {
            return new JsonResponse(['error' => 'Non autorisé'], 403);
        }

        $data = json_decode($request->getContent(), true);
        $lat = $data['lat'] ?? null;
        $lng = $data['lng'] ?? null;
        $address = $data['address'] ?? null;

        if ($lat && $lng) {
            $profile = $user->getTherapistProfile();
            if ($profile) {
                $profile->setLatitude($lat);
                $profile->setLongitude($lng);
                if ($address) $profile->setAddress($address);
                $this->em->flush();
                return new JsonResponse(['success' => true]);
            }
        }

        return new JsonResponse(['error' => 'Données invalides'], 400);
    }

    #[Route('/map/contact/{id}', name: 'app_map_contact', methods: ['POST'])]
    public function contactRequest(int $id, Request $request): JsonResponse
    {
        /** @var User $client */
        $client = $this->getUser();
        
        $therapist = $this->em->getRepository(User::class)->find($id);
        if (!$therapist || !str_contains($therapist->getPrimaryRole(), 'PSYCHOLOGUE')) {
            return new JsonResponse(['success' => false, 'message' => 'Thérapeute invalide.'], 404);
        }

        // Check for existing pending request
        $existing = $this->em->getRepository(ContactRequest::class)->findOneBy([
            'client' => $client,
            'therapist' => $therapist,
            'status' => 'PENDING'
        ]);

        if ($existing) {
            return new JsonResponse(['success' => false, 'message' => 'Une demande est déjà en attente.']);
        }

        $data = json_decode($request->getContent(), true);
        $message = $data['message'] ?? 'Bonjour, je souhaite prendre contact avec vous.';

        $contactRequest = new ContactRequest();
        $contactRequest->setClient($client);
        $contactRequest->setTherapist($therapist);
        $contactRequest->setMessage($message);
        
        $this->em->persist($contactRequest);

        // Create notification
        $notif = new Notification();
        $notif->setUser($therapist);
        $notif->setType('CONTACT_REQUEST');
        $notif->setTitle('Nouvelle demande de contact');
        $notif->setBody($client->getFullName() . ' souhaite vous contacter.');
        
        $this->em->persist($notif);
        $this->em->flush();

        return new JsonResponse(['success' => true, 'message' => 'Demande envoyée avec succès.']);
    }
}
