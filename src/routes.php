<?php

// Routes

$app->get('/', function($request, $response) {
    return $this->view->render($response, 'welcome.twig');
});
