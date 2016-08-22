<?php

namespace App\Middleware;

class AdminMiddleware extends Middleware
{
  public function __invoke($request, $response, $next)
  {
    if ($this->container->sentinel->getUser()) {
      $isAdmin = $this->container->sentinel->getUser()->inRole('admin');
    }

    if (!$isAdmin) {
      $this->container->flash->addMessage('error', 'You have no access to view this page.');
      return $response->withRedirect($this->container->router->pathFor('home'));
    }

    $response = $next($request, $response);
    return $response;
  }
}
