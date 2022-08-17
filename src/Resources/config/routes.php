<?php

namespace Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

use Feierstoff\SimpleReactWebpageBundle\Controller\FallbackController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function(RoutingConfigurator $routes) {
    $routes
        ->add("feierstoff_simple_react_webpage.route.fallback.index", "/")
            ->controller([FallbackController::class, "index"])
    ;
};