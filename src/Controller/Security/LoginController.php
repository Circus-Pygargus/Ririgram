<?php

namespace App\Controller\Security;

use App\Application\Controller;


class LoginController extends Controller
{

    function login ()
    {
        return $this->twig->render('index.html.twig',
        [
            'message' => 'tried to log in'
        ]);
    }
}