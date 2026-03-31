<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $user = $this->getUser();
        $settings = $user->getSettings();

        // Ensure settings exist
        if (!$settings) {
            $settings = new \App\Entity\UserSettings();
            $settings->setUser($user);
            $this->em->persist($settings);
            $this->em->flush();
        }

        if ($request->isMethod('POST')) {
            $theme = $request->request->get('theme', 'LIGHT');
            $fontSize = $request->request->get('fontSize', 'NORMAL');
            $language = $request->request->get('language', 'FR');

            if (in_array($theme, ['LIGHT', 'DARK'])) {
                $settings->setTheme($theme);
            }
            if (in_array($fontSize, ['SMALL', 'NORMAL', 'LARGE'])) {
                $settings->setFontSize($fontSize);
            }
            if (in_array($language, ['FR', 'EN'])) {
                $settings->setLanguage($language);
            }

            $this->em->flush();
            $this->addFlash('success', 'Paramètres mis à jour.');
            
            // Note: For immediately applying theme changes to Tailwind without page reload, 
            // we will also use localStorage/Alpine in the twig template to toggle dark mode
            return $this->redirectToRoute('app_settings');
        }

        return $this->render('pages/settings/settings.html.twig', [
            'settings' => $settings
        ]);
    }
}
