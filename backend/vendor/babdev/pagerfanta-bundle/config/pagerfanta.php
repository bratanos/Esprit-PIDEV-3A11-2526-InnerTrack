<?php declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BabDev\PagerfantaBundle\RouteGenerator\RequestAwareRouteGeneratorFactory;
use BabDev\PagerfantaBundle\View\ContainerBackedImmutableViewFactory;
use Pagerfanta\RouteGenerator\RouteGeneratorFactoryInterface;
use Pagerfanta\View\DefaultView;
use Pagerfanta\View\Foundation6View;
use Pagerfanta\View\SemanticUiView;
use Pagerfanta\View\TwitterBootstrap3View;
use Pagerfanta\View\TwitterBootstrap4View;
use Pagerfanta\View\TwitterBootstrap5View;
use Pagerfanta\View\TwitterBootstrapView;
use Pagerfanta\View\ViewFactoryInterface;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set('pagerfanta.route_generator_factory', RequestAwareRouteGeneratorFactory::class)
        ->args([
            service('router'),
            service('request_stack'),
            service('property_accessor'),
        ])
    ;
    $services->alias(RouteGeneratorFactoryInterface::class, 'pagerfanta.route_generator_factory');

    $services->set('pagerfanta.view.default', DefaultView::class)
        ->tag('pagerfanta.view', ['alias' => 'default'])
    ;

    $services->set('pagerfanta.view.foundation6', Foundation6View::class)
        ->tag('pagerfanta.view', ['alias' => 'foundation6'])
    ;

    $services->set('pagerfanta.view.semantic_ui', SemanticUiView::class)
        ->tag('pagerfanta.view', ['alias' => 'semantic_ui'])
    ;

    $services->set('pagerfanta.view.twitter_bootstrap', TwitterBootstrapView::class)
        ->tag('pagerfanta.view', ['alias' => 'twitter_bootstrap'])
    ;

    $services->set('pagerfanta.view.twitter_bootstrap3', TwitterBootstrap3View::class)
        ->tag('pagerfanta.view', ['alias' => 'twitter_bootstrap3'])
    ;

    $services->set('pagerfanta.view.twitter_bootstrap4', TwitterBootstrap4View::class)
        ->tag('pagerfanta.view', ['alias' => 'twitter_bootstrap4'])
    ;

    $services->set('pagerfanta.view.twitter_bootstrap5', TwitterBootstrap5View::class)
        ->tag('pagerfanta.view', ['alias' => 'twitter_bootstrap5'])
    ;

    $services->set('pagerfanta.view_factory', ContainerBackedImmutableViewFactory::class)
        ->args([
            abstract_arg('service locator'),
            abstract_arg('service map'),
        ])
    ;
    $services->alias(ViewFactoryInterface::class, 'pagerfanta.view_factory');
};
