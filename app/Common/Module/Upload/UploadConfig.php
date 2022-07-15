<?php
/**
 * Created by PhpStorm.
 * Date:  2021/11/11
 * Time:  12:36 下午.
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

use Lengbin\Common\BaseObject;

class UploadConfig extends BaseObject
{
    /**
     * 域名.
     */
    public string $domain;

    /**
     * bucket.
     */
    public string $bucket;
}
