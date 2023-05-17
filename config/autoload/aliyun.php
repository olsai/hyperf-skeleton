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
        'download_temp_dir' => BASE_PATH . '/storage',
        'public' => [
            'bucket' => \Hyperf\Support\env('ALIYUN_OSS_BUCKET'),
            'access_key' => \Hyperf\Support\env('ALIYUN_OSS_ACCESS_KEY'),
            'secret_key' => \Hyperf\Support\env('ALIYUN_OSS_SECRET_KEY'),
            'domain' => \Hyperf\Support\env('ALIYUN_OSS_DOMAIN'),
            'region' => \Hyperf\Support\env('ALIYUN_OSS_REGION'),
            'endpoint' => \Hyperf\Support\env('ALIYUN_OSS_ENDPOINT'),
            'role_arn' => \Hyperf\Support\env('ALIYUN_OSS_ROLE_ARN'),
        ],
    ],
];
