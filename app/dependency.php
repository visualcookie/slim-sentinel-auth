<?php
$container = $app->getContainer();

use \Symfony\Component\HttpFoundation\Request;

// Setup Eloquent
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Define Twig View
$container['view'] = function($container) {
  $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
    'cache' => false
  ]);

  $view->addExtension(new \Slim\Views\TwigExtension(
    $container->router,
    $container->request->getUri()
  ));

  $view->getEnvironment()->addGlobal('auth', [
    'check' => $container->sentinel->check(),
    'user' => $container->sentinel->getUser(),
    'isAdmin' => $container->auth->isAdmin(),
    'getRoles' => $container->auth->roles()
  ]);

  $view->getEnvironment()->addGlobal('flash', $container->flash);

  return $view;
};

// Shortcut Eloquent
$container['db'] = function($container) use ($capsule) {
  return $capsule;
};

// Flash Messages
$container['flash'] = function($container) {
  return new \Slim\Flash\Messages;
};

// CSRF Protection
$container['csrf'] = function($container) {
  return new \Slim\Csrf\Guard;
};

$container['hasher'] = function ($container) {
    return new Cartalyst\Sentinel\Hashing\BcryptHasher;
};

$container['dispatcher'] = function ($container) {
    return new Illuminate\Events\Dispatcher;
};

// Add Sentinel
$container['sentinel'] = function ($container) {
  $sentinel = (new \Cartalyst\Sentinel\Native\Facades\Sentinel())->getSentinel();
  $sentinel->setUserRepository(
    new \Cartalyst\Sentinel\Users\IlluminateUserRepository(
      $container['hasher'],
      $container['dispatcher'],
      App\Models\User::class // This is the proper model name for this case
    )
  );

  return $sentinel;
};
// Validator
$container['validator'] = function($container) {
  return new App\Validation\Validator;
};

$container['auth'] = function($container) {
  return new App\Auth\Auth($container);
};

// Controller
$container['HomeController'] = function($container) {
  return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function($container) {
  return new \App\Controllers\Auth\AuthController($container);
};

$container['AdminController'] = function($container) {
  return new \App\Controllers\Admin\AdminController($container);
};

$container['UserActionController'] = function($container) {
  return new \App\Controllers\Admin\UserActionController($container);
};
