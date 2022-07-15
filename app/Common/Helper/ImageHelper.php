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
namespace App\Common\Helper;

use App\Common\Constants\Enums\UploadType;
use App\Common\Module\Upload\AbstractUpload;
use App\Common\Module\Upload\UploadFactory;
use App\Common\Module\Upload\UploadInterface;

class ImageHelper implements UploadInterface
{
    protected AbstractUpload $uploader;

    public function __construct()
    {
        $this->uploader = make(UploadFactory::class)->make(UploadType::ALI());
    }

    public function makeImageUrl(string $path): string
    {
        return $path ? $this->uploader->makeImagePath($path) : $path;
    }

    public function getToken(string $key)
    {
        return $this->uploader->getToken($key);
    }

    public function uploadFile(string $path, string $file)
    {
        return $this->uploader->uploadFile($path, $file);
    }

    public function remove(string $path): bool
    {
        return $this->uploader->remove($path);
    }

    public function has(string $path): bool
    {
        return $this->uploader->has($path);
    }
}
