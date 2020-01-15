<?php

namespace App\Application;

use App\Application\Template;


class Controller {

    /**
     * @var Template
     */
    // protected pour être accessible depuis les classes filles
    // car une variable private ne peut être lue par une classe fille
    protected $twig;


    public function __construct () {

        $this->twig = new Template();
    }
}