<?php

return [
    'settings' => [
        'debug' => true,
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => false,

        'databases' => [
            'default' => [
                'driver'    => 'mysql',
                'host'      => 'pluto.uniquepotion.com',
                'database'  => 'slim-sentinel-auth',
                'username'  => 'root',
                'password'  => '_LeL7J6V7_t}',
                'charset'   => 'utf8',
                'collation' => 'utf8_general_ci',
                'prefix'    => ''
            ]
        ]
    ]
];
