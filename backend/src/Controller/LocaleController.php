<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserSettings;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class LocaleController extends AbstractController
{
    #[Route('/change-locale/{locale}', name: 'app_change_locale')]
    public function changeLocale(string $locale, Request $request, EntityManagerInterface $em): Response
    {
        if (in_array($locale, ['en', 'fr'], true)) {
            $request->getSession()->set('_locale', $locale);
            
            /** @var \App\Entity\User|null $user */
            $user = $this->getUser();
            if ($user instanceof User) {
                $settings = $user->getSettings();
                if (!$settings) {
                    $settings = new UserSettings();
                    $settings->setUser($user);
                    $em->persist($settings);
                }
                $settings->setLanguage(strtoupper($locale));
                $em->flush();
            }
        }

        $referer = $request->headers->get('referer');
        return $this->redirect($referer ?: $this->generateUrl('app_dashboard'));
    }
}