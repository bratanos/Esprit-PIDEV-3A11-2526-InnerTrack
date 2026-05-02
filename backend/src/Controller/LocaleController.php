<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LocaleController extends AbstractController
{
    #[Route('/change-locale/{locale}', name: 'app_change_locale')]
    public function changeLocale(string $locale, Request $request, \Doctrine\ORM\EntityManagerInterface $em): Response
    {
        if (in_array($locale, ['en', 'fr'])) {
            $request->getSession()->set('_locale', $locale);
            
            /** @var \App\Entity\User|null $user */
            $user = $this->getUser();
            if ($user) {
                $settings = $user->getSettings();
                if (!$settings) {
                    $settings = new \App\Entity\UserSettings();
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
