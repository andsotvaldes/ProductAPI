<?php

namespace App\Application\Security;

use Nelmio\ApiDocBundle\Controller\SwaggerUiController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ErrorController;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class HeaderSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController'
        ];
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $header = $event->getRequest()->headers->get('Content-Type','');

        $controller = $event->getController();

        if (is_array($controller)) {
            $controller = $controller[0];
        }

        $controllersExclude =
            [
                SwaggerUiController::class,
                ErrorController::class
            ];

        if (!in_array(get_class($controller),$controllersExclude)) {
            if ($header != 'application/json') {
                throw new \Exception('You must define on the header , the Content-Type : application/json');
            }
        }



    }
}
