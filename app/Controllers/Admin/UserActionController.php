<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\Controllers\Controller;
use Slim\Views\Twig as View;

class UserActionController extends Controller
{
  public function deleteUser($request, $response, $arguments)
  {
    if ($arguments['uid'] === $this->container->sentinel->getUser()->username) {
      $this->flash->addMessage('error', "You can't delete yourself.");
      return $response->withRedirect($this->router->pathFor('admin.index'));
    }

    $user = User::where('username', $arguments['uid']);
    $user->delete();

    $this->flash->addMessage('success', "User has been deleted.");
    return $response->withRedirect($this->router->pathFor('admin.index'));
  }

  public function editUser($request, $response, $arguments)
  {
    $getCurrentUserData = User::where('username', $arguments['uid'])->first();
    $this->container->view->getEnvironment()->addGlobal('current', $getCurrentUserData);

    return $this->view->render($response, 'admin/user/edit.twig');
  }

  public function postEditUser($request, $response, $arguments)
  {
    $getCurrentUserData = User::where('username', $arguments['uid'])->first();

    $credentials = [
      'displayname' => $request->getParam('displayname'),
      'email' => $request->getParam('email')
    ];

    if ($request->getParam('password')) {
      $credentials['password'] = $request->getParam('password');
    }

    $this->container->sentinel->update($getCurrentUserData, $credentials);

    return $response->withRedirect($this->router->pathFor('admin.user.edit', [ 'uid' => $arguments['uid'] ]));
  }
}
