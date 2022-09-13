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
use Hyperf\Di\ReflectionManager;

$daoInterface = value(function () {
    $paths = [
        BASE_PATH . '/app/Service',
        BASE_PATH . '/app/Repository/Dao/MySQL',
    ];
    $result = ReflectionManager::getAllClasses($paths);
    $output = [];
    foreach ($result as $class) {
        /** @var ReflectionClass $class */
        $interfaces = $class->getInterfaceNames();
        if (empty($interfaces)) {
            continue;
        }
        $output[$interfaces[0]] = $class->getName();
    }
    return $output;
});

return array_merge($daoInterface, [
    Hyperf\Database\Commands\ModelCommand::class => Lengbin\Hyperf\Common\Commands\Model\ModelCommand::class,
    Hyperf\Crontab\Strategy\StrategyInterface::class => Hyperf\Crontab\Strategy\CoroutineStrategy::class,
]);
