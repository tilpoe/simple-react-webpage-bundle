<?php

namespace Feierstoff\SimpleReactWebpageBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class SimpleReactWebpageExtension extends Extension {

    public function load(array $configs, ContainerBuilder $container) {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__."/../Resources/config"));
        $configuration = $this->getConfiguration($configs, $container);
        // array one can access to get the values from the config file
        $config = $this->processConfiguration($configuration, $configs);

        $loader->load("commands.php");
        $loader->load("controllers.php");
    }

}
