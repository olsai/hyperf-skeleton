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
use Symfony\Component\Finder\Finder;

$daoInterface = value(function () {
    $dirs = [
        '/Service',
        '/Repository/Dao/MySQL',
    ];
    $paths = [];
    $directories = Finder::create()->directories()->in([BASE_PATH . '/app'])->depth(0);
    foreach ($directories as $directory) {
        foreach ($dirs as $dir) {
            if (is_dir($path = $directory->getRealPath() . $dir)) {
                $paths[] = $path;
            }
        }
    }
    if (empty($paths)) {
        return [];
    }
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
]);
