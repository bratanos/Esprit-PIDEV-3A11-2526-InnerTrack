<?php declare(strict_types=1);

namespace BabDev\PagerfantaBundle\EventListener;

use Pagerfanta\Exception\NotValidMaxPerPageException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ConvertNotValidMaxPerPageToNotFoundListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();

        if ($throwable instanceof NotValidMaxPerPageException) {
            $event->setThrowable(new NotFoundHttpException('Page Not Found', $throwable));
        }
    }
}
