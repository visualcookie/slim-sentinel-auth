<?php

// Dependency Injection Configuration
$container = $app->getContainer();

// View Renderer
$container['view'] = function($container)
{
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views');

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};
