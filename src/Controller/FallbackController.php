<?php

namespace Feierstoff\SimpleReactWebpageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class FallbackController {

    public function __construct(
        private readonly Environment $twig
    ) {}

    public function index() {
        return new Response($this->twig->render("@SimpleReactWebpage/index.html.twig"));
    }

}