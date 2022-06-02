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
    // 错误码文件 目录
    'path' => [
        BASE_PATH . '/vendor/lengbin/hyperf-common/src/Constants/Errors',
    ],
    // 合并生成 类 文件名称
    'classname' => 'Error',
    // 合并生成 类 命名空间
    'classNamespace' => 'App\\Common\\Constants',
    // 合并生成 类 文件输出目录
    'output' => BASE_PATH . '/app/Common/Constants',
];
