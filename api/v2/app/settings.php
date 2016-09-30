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

        // doctrine settings
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    __DIR__ . '/src/models'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  __DIR__.'/../cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => '127.0.0.1',
                'port'     => 8889,
                'dbname'   => 'blog',
                'user'     => 'root',
                'password' => 'root',
            ]
        ],

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],
    ],
];
