<?php

$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);
$app->add(new \App\Middleware\EloquentMiddleware($container));
