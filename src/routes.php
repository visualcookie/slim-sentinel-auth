<?php

// Routes

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/signin', 'AuthController:renderSignin')->setName('auth.signin');
$app->get('/signup', 'AuthController:renderSignup')->setName('auth.signup');

$app->get('/user/profile', 'UserController:renderProfile')->setName('auth.user.profile');
