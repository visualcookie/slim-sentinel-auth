<?php

use App\Middleware\AdminMiddleware;

$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function() {
  $this->get('/user/register', 'AuthController:getRegister')->setName('user.register');
  $this->post('/user/register', 'AuthController:postRegister');

  $this->get('/user/login', 'AuthController:getLogin')->setName('user.login');
  $this->post('/user/login', 'AuthController:postLogin');
});

$app->group('', function() {
  $this->get('/user/logout', 'AuthController:logout')->setName('user.logout');
});

$app->group('', function() {
  $this->get('/admin', 'AdminController:index')->setName('admin.index');
  $this->get('/admin/user/add', 'AdminController:index')->setName('admin.user.add');

  $this->get('/admin/user/{uid}/edit', 'UserActionController:editUser')->setName('admin.user.edit');
  $this->post('/admin/user/{uid}/edit', 'UserActionController:postEditUser');

  $this->get('/admin/user/{uid}/delete', 'UserActionController:deleteUser')->setName('admin.user.delete');
})->add(new AdminMiddleware($container));
