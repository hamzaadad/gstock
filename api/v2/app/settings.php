<?php
return [
    'settings' => [
        // comment this line when deploy to production environment
        'displayErrorDetails' => true,
        // View settings
        'determineRouteBeforeAppMiddleware' => false,
        'db' => [
           'driver' => 'mysql',
           'host' => '127.0.0.1',
           'database' => 'gstock',
           'username' => 'root',
           'password' => 'root',
           'charset'   => 'utf8',
           'collation' => 'utf8_unicode_ci',
           'prefix'    => '',
       ],
        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],
    ],
];
