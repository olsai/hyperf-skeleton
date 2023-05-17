<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Lengbin\Hyperf\Common\BaseModel;

return [
    'default' => [
        'driver' => \Hyperf\Support\env('DB_DRIVER', 'mysql'),
        'read' => [
            'host' => \Hyperf\Support\env('DB_READ_HOST', '127.0.0.1'),
        ],
        'write' => [
            'host' => \Hyperf\Support\env('DB_WRITE_HOST', '127.0.0.1'),
        ],
        'sticky' => true,
        'database' => \Hyperf\Support\env('DB_DATABASE', 'hyperf'),
        'port' => \Hyperf\Support\env('DB_PORT', 3306),
        'username' => \Hyperf\Support\env('DB_USERNAME', 'root'),
        'password' => \Hyperf\Support\env('DB_PASSWORD', ''),
        'charset' => \Hyperf\Support\env('DB_CHARSET', 'utf8mb4'),
        'collation' => \Hyperf\Support\env('DB_COLLATION', 'utf8mb4_unicode_ci'),
        'prefix' => \Hyperf\Support\env('DB_PREFIX', 't_'),
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 32,
            'connect_timeout' => 10.0,
            'wait_timeout' => 3.0,
            'heartbeat' => -1,
            'max_idle_time' => (float) \Hyperf\Support\env('DB_MAX_IDLE_TIME', 60),
        ],
        'commands' => [
            'gen:model' => [
                'path' => 'app/Repository/Model',
                'for_table_ddd' => true,
                'force_casts' => true,
                'inheritance' => 'BaseModel',
                'uses' => BaseModel::class,
                'refresh_fillable' => true,
                'with_comments' => true,
            ],
        ],
    ],
];
