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

    $roles = [];
    foreach ($users as $user) {
      $roles[] = $this->container->sentinel->findById($user->id)->roles()->get()->first();
    }

    $this->container->view->getEnvironment()->addGlobal('listUsers', $users);
    $this->container->view->getEnvironment()->addGlobal('getUsersRole', $roles);

    return $this->view->render($response, 'admin/home.twig');
  }
}
