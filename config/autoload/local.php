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
return [
    'oss' => [
        'download_temp_dir' => BASE_PATH . '/public/upload',
        'public' => [
            'bucket' => '/upload',
            'upload_time' => 5,
            'remove_file_time' => 24 * 3600,
            'domain' => \Hyperf\Support\env('HOST', 'http://127.0.0.1:9501'),
        ],
    ],
];
