<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserSettings;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SettingsController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[Route('/settings', name: 'app_settings', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        /** @var User $user */
        $user     = $this->getUser();
        $settings = $user->getSettings();

        if (!$settings) {
            $settings = new UserSettings();
            $settings->setUser($user);
            $this->em->persist($settings);
            $this->em->flush();
        }

        if ($request->isMethod('POST')) {
            $theme    = (string) $request->request->get('theme', 'LIGHT');
            $fontSize = (string) $request->request->get('fontSize', 'NORMAL');
            $language = (string) $request->request->get('language', 'FR');

            if (in_array($theme, ['LIGHT', 'DARK'], true)) {
                $settings->setTheme($theme);
            }
            if (in_array($fontSize, ['SMALL', 'NORMAL', 'LARGE'], true)) {
                $settings->setFontSize($fontSize);
            }
            if (in_array($language, ['FR', 'EN'], true)) {
                $settings->setLanguage($language);
                $request->getSession()->set('_locale', strtolower($language));
            }

            $this->em->flush();
            $this->addFlash('success', 'Paramètres mis à jour.');
            return $this->redirectToRoute('app_settings');
        }

        return $this->render('pages/settings/settings.html.twig', [
            'settings' => $settings,
        ]);
    }

    #[Route('/_internal/settings/theme', name: 'api_settings_theme', methods: ['POST'])]
    public function updateTheme(Request $request): JsonResponse
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            return new JsonResponse(['error' => 'Not logged in'], 401);
        }

        /** @var User $user */
        $data  = json_decode($request->getContent(), true);
        $theme = strtoupper((string) ($data['theme'] ?? 'LIGHT'));

        if (!in_array($theme, ['LIGHT', 'DARK'], true)) {
            return new JsonResponse(['error' => 'Invalid theme'], 400);
        }

        $settings = $user->getSettings();
        if (!$settings) {
            $settings = new UserSettings();
            $settings->setUser($user);
            $this->em->persist($settings);
        }

        $settings->setTheme($theme);
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }
}