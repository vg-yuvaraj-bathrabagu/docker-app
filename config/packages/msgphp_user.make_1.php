<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

return function (ContainerConfigurator $container) {
    $container->services()
        ->defaults()
            ->private()
            ->autoconfigure()
            ->autowire()

        // non-FQCN service for decorating
        ->set('app.console.class_context_element_factory', App\Console\ClassContextElementFactory::class)
            ->decorate(MsgPhp\Domain\Infra\Console\Context\ClassContextElementFactoryInterface::class)
            ->arg('$factory', ref('app.console.class_context_element_factory.inner'))
    ;
};
