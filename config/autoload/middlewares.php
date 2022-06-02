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
use Lengbin\Hyperf\Common\Middlewares\CorsMiddleware;
use Lengbin\Hyperf\Common\Middlewares\DebugLogMiddleware;

return [
    'http' => [
        CorsMiddleware::class,
        DebugLogMiddleware::class,
    ],
];
