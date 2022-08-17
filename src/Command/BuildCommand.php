<?php

namespace Feierstoff\SimpleReactWebpageBundle\Command;

use Feierstoff\CommandBundle\Util\Cmd;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand("simple-react-webpage:build")]
class BuildCommand extends Cmd {

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $this->initExecution($input, $output, __DIR__);

        $this->batch([
            "rm -rf build",
            "mkdir build",
            "mkdir build/assets"
        ]);
        $this->bootstrap("build/index.html");

        $dir = new \DirectoryIterator("public/build");

        $links = [];
        $scripts = [];
        foreach ($dir as $fileinfo) {
            if ($fileinfo->getFileInfo()->getType() == "file") {
                $extension = pathinfo($fileinfo->getFilename(), PATHINFO_EXTENSION);

                switch ($extension) {
                    case "js":
                    case "css":
                    case "json":
                        $this->bash("cp {$fileinfo->getRealPath()} build/assets");
                        break;
                }

                if ($extension == "js") {
                    $scripts[] = $fileinfo->getFilename();
                }

                if ($extension == "css") {
                    $links[] = $fileinfo->getFilename();
                }
            }
        }

        $handle = fopen("build/index.html", "r+");
        $lines = [];
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $lines[] = $line;
            }
            fclose($handle);
        }

        $newLines = [];
        foreach ($lines as $line) {
            $newLines[] = $line;
            switch (trim($line)) {
                case "<!--LINKS-->":
                    foreach ($links as $link) {
                        $newLines[] = "<link rel='stylesheet' href='assets/{$link}'/>\n";
                    }
                    break;
                case "<!--SCRIPTS-->":
                    foreach ($scripts as $script) {
                        $newLines[] = "<script src='assets/{$script}'></script>\n";
                    }
                    break;
            }
        }

        file_put_contents("build/index.html", $newLines);

        return Command::SUCCESS;
    }

}