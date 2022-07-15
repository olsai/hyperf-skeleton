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
namespace App\Common\Module\Upload;

interface UploadInterface
{
    public function getToken(string $key);

    public function uploadFile(string $path, string $file);

    public function remove(string $path): bool;

    public function has(string $path): bool;
}
