<?php
/**
 * Created by PhpStorm.
 * Date:  2021/11/11
 * Time:  11:24 上午.
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
namespace App\Common\Module\Upload;

use Lengbin\Helper\Util\RegularHelper;

abstract class AbstractUpload implements UploadInterface
{
    protected UploadConfig $config;

    public function loadConfig(UploadConfig $config)
    {
        $this->config = $config;
    }

    public function makeImagePath(string $key): string
    {
        if (RegularHelper::checkUrl($key)) {
            return $key;
        }
        return rtrim($this->config->domain, "\t\n\r\0\x0B/") . '/' . ltrim($key, '/');
    }
}
