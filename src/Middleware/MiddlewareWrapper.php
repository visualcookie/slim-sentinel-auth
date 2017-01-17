<?php

namespace App\Middleware;

class MiddlewareWrapper
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
        $this->settings = $container['settings'];
    }
}
