<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Feierstoff\SimpleReactWebpageBundle\Command\BootstrapCommand;
use Feierstoff\SimpleReactWebpageBundle\Command\BuildCommand;

return function(ContainerConfigurator $container) {
    $tag = "console.command";

    $container->services()
        ->set(BootstrapCommand::class)
            ->tag($tag)

        ->set(BuildCommand::class)
            ->tag($tag)
    ;
};