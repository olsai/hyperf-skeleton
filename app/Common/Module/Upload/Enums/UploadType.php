<?php
/**
 * Created by PhpStorm.
 * Date:  2021/11/11
 * Time:  1:18 下午.
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
namespace App\Common\Module\Upload\Enums;

use Lengbin\Hyperf\ErrorCode\BaseEnum;

class UploadType extends BaseEnum
{
    /**
     * @Message("本地")
     */
    public const LOCAL = 'local';

    /**
     * @Message("阿里云Oss")
     */
    public const ALI = 'aliyun';

    /**
     * @Message("腾讯云Oss")
     */
    public const TENCENT = 'tencent';

    /**
     * @Message("七牛云OSss")
     */
    public const qiniu = 'qiniu';
}
