<?php declare(strict_types=1);

namespace BabDev\PagerfantaBundle\DependencyInjection\CompilerPass;

use BabDev\PagerfantaBundle\View\ContainerBackedImmutableViewFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @internal
 */
final class RegisterPagerfantaViewsPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('pagerfanta.view_factory')) {
            return;
        }

        $definition = $container->getDefinition('pagerfanta.view_factory');

        if (ContainerBackedImmutableViewFactory::class === $definition->getClass()) {
            /** @var array<string, Reference> $locator */
            $locator = [];

            /** @var array<string, string> $serviceMap */
            $serviceMap = [];

            foreach ($container->findTaggedServiceIds('pagerfanta.view') as $serviceId => $arguments) {
                $alias = $arguments[0]['alias'] ?? $serviceId;

                $locator[$alias] = new Reference($serviceId);
                $serviceMap[$alias] = $serviceId;
            }

            $definition->replaceArgument(0, ServiceLocatorTagPass::register($container, $locator));
            $definition->replaceArgument(1, $serviceMap);

            return;
        }

        foreach ($container->findTaggedServiceIds('pagerfanta.view') as $serviceId => $arguments) {
            $alias = $arguments[0]['alias'] ?? $serviceId;

            $definition->addMethodCall('set', [$alias, new Reference($serviceId)]);
        }
    }
}
