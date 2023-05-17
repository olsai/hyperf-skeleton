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
    // enable false 将不会启动 swagger 服务
    'enable' => \Hyperf\Support\env('APP_ENV') !== 'prod',
    'output_dir' => BASE_PATH . '/runtime/swagger',
    'prefix_url' => \Hyperf\Support\env('API_DOCS_PREFIX_URL', '/swagger'),
    // 认证api key
    'security_api_key' => ['Authorization'],
    // 替换验证属性
    'validation_custom_attributes' => true,
    // 全局responses
    'responses' => [
        401 => ['description' => 'Unauthorized'],
    ],
    // swagger 的基础配置
    'swagger' => [
        'swagger' => '2.0',
        'info' => [
            'description' => 'swagger api desc',
            'version' => '1.0.0',
            'title' => 'API DOC',
        ],
        'host' => \Hyperf\Support\env('API_HOST'),
        'schemes' => [],
    ],
];
