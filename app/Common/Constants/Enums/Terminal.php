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
namespace App\Common\Constants\Enums;

use Lengbin\ErrorCode\Annotation\EnumMessage;
use Lengbin\Hyperf\ErrorCode\BaseEnum;

/**
 * 终端.
 */
class Terminal extends BaseEnum
{
    #[EnumMessage(message: '苹果')]
    public const IOS = 1;

    #[EnumMessage(message: '安卓')]
    public const ANDROID = 2;

    #[EnumMessage(message: 'pc')]
    public const PC = 3;

    #[EnumMessage(message: 'h5')]
    public const H5 = 4;
}
