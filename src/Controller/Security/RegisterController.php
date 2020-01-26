<?php

namespace App\Controller\Security;

use App\Application\Controller;


class RegisterController extends Controller
{

    // someone wants to see the register page
    public function index ()
    {
        return $this->twig->render('register.html.twig');
    }


    // someone sent the register form
    public function json ()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "Application/json") {

            $content = trim(file_get_contents("php://input"));
            $decoded = '';
            $decoded = json_decode($content, true);
            
            // will contain $errors if invalid form
            $checkedForm = $this->checkSentForm($decoded);

            // form content is fine, we can try to store it
            if ($checkedForm === 'form content is ok') {
                // var_dump($checkedForm);
                $response['reponse'] = 'ok';
                return json_encode($response);
            }
            // there were errors in the sent form
            else {
                // $decoded['username'] = 'prout';
                $response['reponse'] = 'not ok';
                $myTemplate = $this->twig->load('register.html.twig');
                $response['render'] = $myTemplate->renderBlock('registerForm', [
                    // $checkedForm contains all form errors =)
                    'values' => $decoded,
                    'errors' => $checkedForm
                ]);
                return json_encode($response);
            }
        }
    }


    // check the register form content sent
    private function checkSentform (array $post)
    {
        $username = $post['username'];
        $email = $post['email'];
        $password = $post['password'];
        $passwordBis = $post['passwordBis'];
        $errors = [];
        $errorflag = false;

        // test username
        if ($username === '') {
            $errors['username'] = 'Il faut entrer un pseudonyme.';
            $errorflag = true;
        }
        else if (!preg_match(" /^[a-zA-Z0-9àâçéèêëîïôùûÿ]+(['_\s\-]?[a-zA-Z0-9àâçéèêëîïôùûÿ])*$/ ", $username)) {
            $errors['username'] = 'Le pseudo n\'est pas valide';
            $errorflag = true;
        }

        // test email
        if ($email === '') {
            $errors['email'] = 'Il faut entrer une adresse mail.';
            $errorflag = true;
        }
        else if (!preg_match(' /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ ', $email)) {
            $errors['email'] = 'L\adresse mail n\'est pas valide';
            $errorflag = true;
        }

        // test password
        if ($password === '') {
            $errors['password'] = 'Il faut entrer un mot de passe.';
            $errorflag = true;
        }
        else if (!preg_match(" /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,20}$/ ", $password)) {
            $errors['password'] = 'Le mot de passe n\'est pas valide';
            $errorflag = true;
        }

        // test passwordBis (the second one should be the same as the first one)
        if ($passwordBis === '') {
            $errors['passwordBis'] = 'Il faut entrer un mot de passe.';
            $errorflag = true;
        }
        else if (!preg_match(" /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,20}$/ ", $passwordBis)) {
            $errors['passwordBis'] = 'Le mot de passe n\'est pas valide';
            $errorflag = true;
        }
        else if ($passwordBis !== $password) {
            $errors['passwordBis'] = 'Les deux mots de passe doivent être identiques.';
            $errorflag = true;
        }

        // everything is fine
        if (!$errorflag) {
            return 'form content is ok';
        }
        // there are errors in sent form
        else {
            return $errors;
        }
    }
}