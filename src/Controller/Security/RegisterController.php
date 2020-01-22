<?php

namespace App\Controller\Security;

use App\Application\Controller;


class RegisterController extends Controller
{

    public function index ()
    {
        return $this->twig->render('register.html.twig');
    }
}