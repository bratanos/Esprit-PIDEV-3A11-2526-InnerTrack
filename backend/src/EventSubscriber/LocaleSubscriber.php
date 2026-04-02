<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage,
        private string $defaultLocale = 'fr'
    ) {}

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        // 1. Try session first
        if ($locale = $request->getSession()->get('_locale')) {
            $request->setLocale($locale);
            return;
        }

        // 2. Try User Settings from DB (Security safe way)
        $token = $this->tokenStorage->getToken();
        $user = $token ? $token->getUser() : null;

        if ($user instanceof \App\Entity\User && $user->getSettings()) {
            $dbLocale = strtolower($user->getSettings()->getLanguage());
            $request->setLocale($dbLocale);
            $request->getSession()->set('_locale', $dbLocale);
        } else {
            $request->setLocale($this->defaultLocale);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            // MUST be registered before the default Locale listener
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}
