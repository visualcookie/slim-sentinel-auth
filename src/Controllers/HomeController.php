<?php

namespace App\Controllers;

use App\Models\User;
use Slim\Views\Twig as View;

class HomeController extends ControllerWrapper
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'welcome.twig');
    }
}
