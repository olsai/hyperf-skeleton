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

use Lengbin\Hyperf\Common\Logs\AppendRequestIdProcessor;

return [
    return value(function () {
        $data = [
            'default',
        ];
        $result = [];
        foreach ($data as $item) {
            $result[$item] = value(function () use ($item) {
                return [
                    'handler' => value(function () use ($item) {
                        if (env('APP_ENV') == 'local') {
                            return [
                                'class' => Monolog\Handler\StreamHandler::class, 'constructor' => [
                                    'stream' => 'php://stdout',
                                    'level' => intval(env('LOG_LEVEL', Monolog\Logger::DEBUG)),
                                ],
                            ];
                        } else {
                            return [
                                'class' => Monolog\Handler\RotatingFileHandler::class,
                                'constructor' => [
                                    'filename' => BASE_PATH . "/runtime/logs/{$item}.log",
                                    'level' => intval(env('LOG_LEVEL', Monolog\Logger::DEBUG)),
                                ],

                            ];
                        }
                    }),
                    'formatter' => [
                        'class' => Monolog\Formatter\LineFormatter::class,
                        'constructor' => [
                            'format' => null,
                            'dateFormat' => 'Y-m-d H:i:s',
                            'allowInlineLineBreaks' => true,
                        ],
                    ],
                    'processors' => [
                        [
                            'class' => AppendRequestIdProcessor::class,
                        ],
                    ],
                ];
            });
        }
        return $result;
    });
];
