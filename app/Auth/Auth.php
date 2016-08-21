<?php

namespace App\Auth;

use \App\Models\User;

class Auth
{
  protected $container;

  public function __construct($container)
  {
    $this->container = $container;
  }

  public function isAdmin()
  {
    if ($this->container->sentinel->getUser()) {
      return $this->container->sentinel->getUser()->inRole('admin');
    }
  }
}
