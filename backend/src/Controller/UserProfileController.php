<?php

namespace App\Controller;

use App\Entity\ClientProfile;
use App\Entity\TherapistProfile;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserProfileController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $isTherapist = str_contains($user->getPrimaryRole(), 'PSYCHOLOGUE');

        // Ensure profiles exist
        if ($isTherapist && !$user->getTherapistProfile()) {
            $profile = new TherapistProfile();
            $profile->setUser($user);
            $this->em->persist($profile);
            $this->em->flush();
        } elseif (!$isTherapist && str_contains($user->getPrimaryRole(), 'USER') && !$user->getClientProfile()) {
            $profile = new ClientProfile();
            $profile->setUser($user);
            $this->em->persist($profile);
            $this->em->flush();
        }

        if ($request->isMethod('POST')) {
            $user->setFirstName($request->request->get('firstName'));
            $user->setLastName($request->request->get('lastName'));
            $user->setPhoneNumber($request->request->get('phoneNumber'));

            $bio = $request->request->get('bio');

            if ($isTherapist) {
                $profile = $user->getTherapistProfile();
                $profile->setBio($bio);
                $profile->setSpecialization($request->request->get('specialization'));
                $profile->setLicenseNumber($request->request->get('licenseNumber'));
            } elseif ($user->getClientProfile()) {
                $user->getClientProfile()->setBio($bio);
            }

            $this->em->flush();
            $this->addFlash('success', 'Profil mis à jour avec succès.');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('pages/profile/view.html.twig', [
            'user' => $user,
            'isTherapist' => $isTherapist,
        ]);
    }

    #[Route('/profile/picture', name: 'app_profile_picture', methods: ['POST'])]
    public function uploadPicture(Request $request, SluggerInterface $slugger): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $file = $request->files->get('profilePicture');

        if ($file) {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $user->getId() . '_' . time() . '_' . $safeFilename . '.' . $file->guessExtension();

            try {
                // Ensure directory exists
                $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/profiles';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $file->move($uploadDir, $newFilename);

                // Save relative path for web, JavaFX will see it and handle accordingly
                $user->setProfilePicture('/uploads/profiles/' . $newFilename);
                $this->em->flush();
                
                $this->addFlash('success', 'Photo de profil mise à jour.');
            } catch (FileException $e) {
                $this->addFlash('error', 'Erreur lors de l\'upload de la photo.');
            }
        }

        return $this->redirectToRoute('app_profile');
    }

    #[Route('/profile/change-password', name: 'app_profile_change_password', methods: ['GET', 'POST'])]
    public function changePassword(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($request->isMethod('POST')) {
            /** @var User $user */
            $user = $this->getUser();
            $currentPassword = $request->request->get('currentPassword');
            $newPassword = $request->request->get('newPassword');
            $confirmPassword = $request->request->get('confirmPassword');

            if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                $this->addFlash('error', 'Mot de passe actuel incorrect.');
                return $this->redirectToRoute('app_profile_change_password');
            }

            if ($newPassword !== $confirmPassword) {
                $this->addFlash('error', 'Les nouveaux mots de passe ne correspondent pas.');
                return $this->redirectToRoute('app_profile_change_password');
            }

            if (strlen($newPassword) < 6) {
                $this->addFlash('error', 'Le nouveau mot de passe doit contenir au moins 6 caractères.');
                return $this->redirectToRoute('app_profile_change_password');
            }

            $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
            $this->em->flush();

            $this->addFlash('success', 'Mot de passe modifié avec succès.');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('pages/profile/changePassword.html.twig');
    }
}
