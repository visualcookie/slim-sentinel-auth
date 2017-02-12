<?php

namespace App\Auth;

class AuthWrapper
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getRoles()
    {
        $roles = Roles::all();
        return $roles;
    }

    public function getUserRole()
    {
    }
}
