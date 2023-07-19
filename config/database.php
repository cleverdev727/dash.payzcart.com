<?php

if (strcmp(env('APP_ENV'), 'production') === 0) {

    return [

        'default' => 'mysql',

        'connections' => [

            'mysql' => [
                'driver' => 'mysql',
                'host' => '52.56.255.18',
                'port' => 3306,
                'database' => 'merchant_management',
                'username' => 'myuser',
                'password' => 'dq0RUU1381Svuy3K',
                'unix_socket' => '',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'engine' => null,
                'options' => array(
                    PDO::ATTR_EMULATE_PREPARES => TRUE,
                    PDO::ATTR_PERSISTENT => TRUE
                )
            ],
            'mysqlread' => [
                'driver' => 'mysql',
                'host' => '52.56.255.18',
                'port' => 3306,
                'database' => 'merchant_management',
                'username' => 'myuser',
                'password' => 'dq0RUU1381Svuy3K',
                'unix_socket' => '',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'engine' => null,
                'options' => array(
                    PDO::ATTR_EMULATE_PREPARES => TRUE,
                    PDO::ATTR_PERSISTENT => TRUE
                )
            ],
          /*  'bouncer' => [
                'driver' => 'mysql',
                'url' => env('DATABASE_URL'),
                'host' => '65.1.74.119',
                'port' => env('DB_PORT', '3306'),
                'database' => 'digi_bouncer',
                'username' => 'root',
                'password' => 'kSnTUdVguGYGaeE4njVJ',
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
                'options' => array(
                    PDO::ATTR_EMULATE_PREPARES => TRUE,
                    PDO::ATTR_PERSISTENT => TRUE
                )
            ],*/
        ],
        //'migrations' => 'migrations',
        'redis' => [
            'client' => 'predis',
            'default' => [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'password' => env('REDIS_PASSWORD', null),
                'port' => env('REDIS_PORT', 6379),
                'database' => env('REDIS_DB', 0),
            ],
            'cache' => [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'password' => env('REDIS_PASSWORD', null),
                'port' => env('REDIS_PORT', 6379),
                'database' => env('REDIS_CACHE_DB', 1),
            ],
        ]

    ];

} else {

    return [

        'default' => 'mysql',

        'connections' => [
            'mysql' => [
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'port' => 3306,
                'database' => 'merchant_management',
                'username' => 'root',
                'password' => '',
                'unix_socket' => '',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'engine' => null,
                'options' => array(
                    PDO::ATTR_EMULATE_PREPARES => TRUE,
                    PDO::ATTR_PERSISTENT => TRUE
                )
            ],
            'mysqlread' => [
                'driver' => 'mysql',
                'host' => '52.56.255.18',
                'port' => 3306,
                'database' => 'merchant_management',
                'username' => 'root',
                'password' => 'dq0RUU1381Svuy3K',
                'unix_socket' => '',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'engine' => null,
                'options' => array(
                    PDO::ATTR_EMULATE_PREPARES => TRUE,
                    PDO::ATTR_PERSISTENT => TRUE
                )
            ]
        ],
        //'migrations' => 'migrations',
        'redis' => [
            'client' => 'predis',
            'default' => [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'password' => env('REDIS_PASSWORD', null),
                'port' => env('REDIS_PORT', 6379),
                'database' => env('REDIS_DB', 0),
            ],
            'cache' => [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'password' => env('REDIS_PASSWORD', null),
                'port' => env('REDIS_PORT', 6379),
                'database' => env('REDIS_CACHE_DB', 1),
            ],
        ]
    ];
}
