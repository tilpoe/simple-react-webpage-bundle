<?php

namespace Symfony\Component\Routing\Loader\Configurator;

use Feierstoff\SimpleReactWebpageBundle\Controller\FallbackController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return function(ContainerConfigurator $container) {
    $container->services()
        ->set(FallbackController::class)
            ->tag("controller.service_arguments")
            ->arg("\$twig", service("twig"))
            ->alias("feierstoff_simple_react_webpage.controller.fallback", FallbackController::class)
            ->public()
    ;
};