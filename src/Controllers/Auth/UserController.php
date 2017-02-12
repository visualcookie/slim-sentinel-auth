<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\ControllerWrapper;
use Slim\Views\Twig as View;

class UserController extends ControllerWrapper
{
    public function renderProfile($request, $response)
    {
        return $this->view->render($response, 'user/profile.twig');
    }

    public function renderSettings($request, $response)
    {
    }
}
