<?php

namespace App\Controllers;

use App\Models\User;
use Slim\Views\Twig as View;

class HomeController extends ControllerWrapper
{
    public function index($request, $response)
    {
        // var_dump(User::find(1));
        return $this->view->render($response, 'welcome.twig');
    }
}
