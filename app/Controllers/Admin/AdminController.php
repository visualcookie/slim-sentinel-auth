<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\Controllers\Controller;
use Slim\Views\Twig as View;

class AdminController extends Controller
{
  public function index($request, $response)
  {
    $users = User::all();
    $this->container->view->getEnvironment()->addGlobal('listusers', $users);

    return $this->view->render($response, 'admin/home.twig');
  }
}
