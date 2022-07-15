<?php
/**
 * Created by PhpStorm.
 * Date:  2022/4/8
 * Time:  6:31 PM.
 */

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Common\Module\Upload\Type;

use App\Common\Module\Upload\AbstractUpload;

class UploadLocal extends AbstractUpload
{
    public function getToken(string $key)
    {
        // TODO: Implement getToken() method.
    }

    public function uploadFile(string $path, string $file)
    {
        // TODO: Implement uploadFile() method.
    }

    public function remove(string $path): bool
    {
        // TODO: Implement remove() method.
    }

    public function has(string $path): bool
    {
        // TODO: Implement has() method.
    }
}
