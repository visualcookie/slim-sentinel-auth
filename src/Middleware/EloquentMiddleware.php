<?php

namespace App\Middleware;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Middleware: Eloquent
 */
class EloquentMiddleware extends MiddlewareWrapper
{
    private function makeCapsule($databases)
    {
        $capsule = new Capsule;

        foreach ($databases as $name => $database) {
            $capsule->addConnection($database, $name);
        }

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    }

    public function __invoke($request, $response, $next)
    {
        $databases = $this->settings['databases'];
        $capsule = $this->makeCapsule($databases);

        $response = $next($request, $response);
        return $response;
    }
}
