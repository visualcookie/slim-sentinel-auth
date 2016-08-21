<?php

return [
  'settings' => [
    'determineRouteBeforeAppMiddleware' => true,
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,

    'db' => [
      'driver' => 'mysql',
      'host' => 'localhost',
      'database' => 'usermanager',
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
      'collation' => 'utf8_bin',
      'prefix' => ''
    ]
  ]
];
