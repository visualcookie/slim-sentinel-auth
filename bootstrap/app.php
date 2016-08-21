<?php

// LOAD PACKAGES IN
require __DIR__ . '/../vendor/autoload.php';

// USE 3RD PARTY
use Respect\Validation\Validator as v;

// START A NEW SESSION
session_start();

// SETUP APPLICATION
$settings = require __DIR__ . '/../config/appConfig.php';
$app = new\Slim\App($settings);

// SETUP DEPENDENCIES
require __DIR__ . '/../app/dependency.php';

// REGISTER MIDDLEWARE
require __DIR__ . '/../app/middleware.php';

// ADD CSRF
$app->add($container->csrf);

// ADD 3RD PARTY
v::with('App\\Validation\\Rules\\');

// REGISTER ROUTES
require __DIR__ . '/../app/routes.php';
