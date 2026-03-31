<?php

namespace App\Controller;

use App\Entity\EmailVerificationCode;
use App\Entity\PasswordResetCode;
use App\Entity\User;
use App\Entity\UserSettings;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Service\EmailSender;

class WebAuthController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $passwordHasher,
    ) {}

    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->redirectToRoute('app_login');
    }

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('pages/login.html.twig', [
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): never
    {
        // Handled by Symfony security
        throw new \LogicException('This should never be reached.');
    }

    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, EmailSender $emailSender): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_dashboard');
        }

        if ($request->isMethod('POST')) {
            $email = trim($request->request->get('email', ''));
            $password = $request->request->get('password', '');
            $confirmPassword = $request->request->get('confirm_password', '');
            $firstName = trim($request->request->get('first_name', ''));
            $lastName = trim($request->request->get('last_name', ''));
            $role = $request->request->get('role', 'ROLE_USER');

            // Validate
            $errors = [];
            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Adresse email invalide.';
            }
            if (strlen($password) < 6) {
                $errors[] = 'Le mot de passe doit contenir au moins 6 caractères.';
            }
            if ($password !== $confirmPassword) {
                $errors[] = 'Les mots de passe ne correspondent pas.';
            }
            if (!$firstName || !$lastName) {
                $errors[] = 'Le prénom et le nom sont obligatoires.';
            }
            if (!in_array($role, ['ROLE_USER', 'ROLE_PSYCHOLOGUE'])) {
                $role = 'ROLE_USER';
            }

            // Check if email exists
            $existingUser = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
            if ($existingUser) {
                $errors[] = 'Un compte existe déjà avec cette adresse email.';
            }

            if (!empty($errors)) {
                return $this->render('pages/signup.html.twig', [
                    'errors' => $errors,
                    'email' => $email,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'role' => $role,
                ]);
            }

            // Create user
            $user = new User();
            $user->setEmail($email);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setRoles([$role]);
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setStatus('PENDING');
            $user->setIsVerified(false);

            $this->em->persist($user);

            // Create verification code
            $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $verificationCode = new EmailVerificationCode();
            $verificationCode->setUser($user);
            $verificationCode->setCode($code);
            $verificationCode->setExpiresAt(new \DateTimeImmutable('+15 minutes'));
            $verificationCode->setLastSentAt(new \DateTimeImmutable());
            $verificationCode->setVerifyAttempts(0);
            $verificationCode->setResendAttempts(1);

            $this->em->persist($verificationCode);

            // Create default settings
            $settings = new UserSettings();
            $settings->setUser($user);
            $this->em->persist($settings);

            $this->em->flush();

            $emailSender->sendVerificationEmail($user->getEmail(), $code);

            $this->addFlash('success', 'Compte créé ! Un code de vérification a été envoyé à votre adresse email.');
            return $this->redirectToRoute('app_verify_email', ['email' => $email]);
        }

        return $this->render('pages/signup.html.twig', [
            'errors' => [],
            'email' => '',
            'first_name' => '',
            'last_name' => '',
            'role' => 'ROLE_USER',
        ]);
    }

    #[Route('/verify-email', name: 'app_verify_email', methods: ['GET', 'POST'])]
    public function verifyEmail(Request $request): Response
    {
        $email = $request->query->get('email', $request->request->get('email', ''));

        if ($request->isMethod('POST')) {
            $code = trim($request->request->get('code', ''));
            $email = trim($request->request->get('email', ''));

            $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
            if (!$user) {
                $this->addFlash('error', 'Utilisateur introuvable.');
                return $this->render('pages/verifyEmail.html.twig', ['email' => $email]);
            }

            $verification = $this->em->getRepository(EmailVerificationCode::class)
                ->findOneBy(['user' => $user, 'code' => $code], ['id' => 'DESC']);

            if (!$verification) {
                $this->addFlash('error', 'Code de vérification invalide.');
                return $this->render('pages/verifyEmail.html.twig', ['email' => $email]);
            }

            if ($verification->getExpiresAt() < new \DateTimeImmutable()) {
                $this->addFlash('error', 'Le code a expiré. Demandez-en un nouveau.');
                return $this->render('pages/verifyEmail.html.twig', ['email' => $email]);
            }

            $user->setIsVerified(true);
            $user->setStatus('ACTIVE');
            $this->em->flush();

            $this->addFlash('success', 'Email vérifié avec succès ! Connectez-vous.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('pages/verifyEmail.html.twig', ['email' => $email]);
    }

    #[Route('/verify-resend', name: 'app_verify_resend', methods: ['POST'])]
    public function verifyResend(Request $request, EmailSender $emailSender): Response
    {
        $email = trim($request->request->get('email', ''));
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        
        if ($user) {
            $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $verificationCode = new EmailVerificationCode();
            $verificationCode->setUser($user);
            $verificationCode->setCode($code);
            $verificationCode->setExpiresAt(new \DateTimeImmutable('+15 minutes'));
            $verificationCode->setLastSentAt(new \DateTimeImmutable());
            $verificationCode->setVerifyAttempts(0);
            $verificationCode->setResendAttempts(1);

            $this->em->persist($verificationCode);
            $this->em->flush();

            $emailSender->sendVerificationEmail($user->getEmail(), $code);
            $this->addFlash('success', 'Nouveau code envoyé !');
        } else {
            $this->addFlash('error', 'Utilisateur introuvable.');
        }

        return $this->redirectToRoute('app_verify_email', ['email' => $email]);
    }

    #[Route('/forgot-password', name: 'app_forgot_password', methods: ['GET', 'POST'])]
    public function forgotPassword(Request $request, EmailSender $emailSender): Response
    {
        if ($request->isMethod('POST')) {
            $email = trim($request->request->get('email', ''));
            $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user) {
                $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $resetCode = new PasswordResetCode();
                $resetCode->setUser($user);
                $resetCode->setCode($code);
                $resetCode->setExpiresAt(new \DateTime('+30 minutes'));
                $this->em->persist($resetCode);
                $this->em->flush();

                $emailSender->sendPasswordResetEmail($user->getEmail(), $code);

                $this->addFlash('success', 'Un code de réinitialisation a été envoyé à votre adresse email.');
            } else {
                $this->addFlash('success', 'Si un compte existe à cette adresse, un code a été envoyé.');
            }

            return $this->redirectToRoute('app_reset_password', ['email' => $email]);
        }

        return $this->render('pages/forgotPassword.html.twig');
    }

    #[Route('/reset-password', name: 'app_reset_password', methods: ['GET', 'POST'])]
    public function resetPassword(Request $request): Response
    {
        $email = $request->query->get('email', $request->request->get('email', ''));

        if ($request->isMethod('POST')) {
            $code = trim($request->request->get('code', ''));
            $email = trim($request->request->get('email', ''));
            $newPassword = $request->request->get('password', '');
            $confirmPassword = $request->request->get('confirm_password', '');

            if ($newPassword !== $confirmPassword) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                return $this->render('pages/resetPassword.html.twig', ['email' => $email]);
            }

            if (strlen($newPassword) < 6) {
                $this->addFlash('error', 'Le mot de passe doit contenir au moins 6 caractères.');
                return $this->render('pages/resetPassword.html.twig', ['email' => $email]);
            }

            $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
            if (!$user) {
                $this->addFlash('error', 'Utilisateur introuvable.');
                return $this->render('pages/resetPassword.html.twig', ['email' => $email]);
            }

            $resetCode = $this->em->getRepository(PasswordResetCode::class)
                ->findOneBy(['user' => $user, 'code' => $code], ['id' => 'DESC']);

            if (!$resetCode || $resetCode->isExpired() || $resetCode->isUsed()) {
                $this->addFlash('error', 'Code invalide ou expiré.');
                return $this->render('pages/resetPassword.html.twig', ['email' => $email]);
            }

            $user->setPassword($this->passwordHasher->hashPassword($user, $newPassword));
            $resetCode->setUsedAt(new \DateTime());
            $this->em->flush();

            $this->addFlash('success', 'Mot de passe réinitialisé ! Connectez-vous.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('pages/resetPassword.html.twig', ['email' => $email]);
    }
}
