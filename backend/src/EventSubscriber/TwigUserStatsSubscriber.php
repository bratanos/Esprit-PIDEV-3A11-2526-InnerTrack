<?php

namespace App\EventSubscriber;

use App\Entity\Message;
use App\Entity\Notification;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class TwigUserStatsSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private Environment $twig,
        private EntityManagerInterface $em
    ) {}

    public function onKernelController(ControllerEvent $event): void
    {
        // Only for real controllers, not sub-requests
        if (!$event->isMainRequest()) {
            return;
        }

        /** @var User|null $user */
        $user = $event->getRequest()->getSession()->get('_security_web') ? (property_exists($event->getRequest()->getSession()->get('_security_web'), 'user') ? $event->getRequest()->getSession()->get('_security_web')->getUser() : null) : null;
        
        // Simpler way to get user in subscriber
        $token = $event->getRequest()->getSession()->get('_security_web');
        // Actually, it's better to just use the security helper if possible, 
        // but we'll try to reach it from the session for now or just check if user is logged in.
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
