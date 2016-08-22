<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\Models\Roles;
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
    $getCurrentUserRole = $this->container->sentinel->findById($getCurrentUserData->id)->roles()->get()->first();

    $this->container->view->getEnvironment()->addGlobal('current', [
      'data' => $getCurrentUserData,
      'role' => $getCurrentUserRole->slug
    ]);

    return $this->view->render($response, 'admin/user/edit.twig');
  }

  public function postEditUser($request, $response, $arguments)
  {
    $getCurrentUserData = User::where('username', $arguments['uid'])->first();
    $getCurrentUserRole = $this->container->sentinel->findById($getCurrentUserData->id)->roles()->get()->first();

    var_dump($getCurrentUserRole);

    $credentials = [
      'displayname' => $request->getParam('displayname'),
      'email' => $request->getParam('email')
    ];

    // change users password
    if ($request->getParam('password')) {
      $credentials['password'] = $request->getParam('password');
    }

    // change users role
    if ($getCurrentUserRole) {
      $role = $this->container->sentinel->findRoleBySlug($getCurrentUserRole->slug);
      $role->users()->detach($getCurrentUserData);
    }

    $role = $this->container->sentinel->findRoleBySlug($request->getParam('role'));
    $role->users()->attach($getCurrentUserData);

    // update user data
    $this->container->sentinel->update($getCurrentUserData, $credentials);

    $this->flash->addMessage('success', "User details have been changed.");
    return $response->withRedirect($this->router->pathFor('admin.user.edit', [ 'uid' => $arguments['uid'] ]));
  }
}
