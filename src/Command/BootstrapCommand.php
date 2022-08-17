<?php

namespace Feierstoff\SimpleReactWebpageBundle\Command;

use Feierstoff\CommandBundle\Util\Cmd;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand("simple-react-webpage:bootstrap")]
class BootstrapCommand extends Cmd {

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->initExecution($input, $output, __DIR__);

        $this->info("Installing webpack");
        $this->bash("composer req symfony/webpack-encore-bundle");
        $this->bash("npm i");
        $this->success();

        $this->bash("rm -rf assets");
        $this->bash("mkdir frontend");
        $this->bootstrap("frontend/index.jsx");
        $this->bootstrap("webpack.config.js");
        $this->bootstrap("config/routes.yaml");
        $this->bootstrap("config/packages/web_profiler.yaml");

        $this->bash("npm i -D " . implode(" ", [
            "@babel/preset-react",
            "react",
            "react-dom",
            "react-router-dom",
            "sass",
            "sass-loader"
        ]));

        $this->askYesNo("Do you want to remove the bootstrap folder?", function() {
            $this->bash("rm -rf {$this->getBundleRoot()}/bootstrap");
        });

        return Command::SUCCESS;
    }

}