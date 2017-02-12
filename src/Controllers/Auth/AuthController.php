<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\ControllerWrapper;
use Slim\Views\Twig as View;

class AuthController extends ControllerWrapper
{
    public function renderSignin($request, $response)
    {
        return $this->view->render($response, 'auth/signin.twig');
    }

    public function renderSignup($request, $response)
    {
        return $this->view->render($response, 'auth/signup.twig');
    }
}
