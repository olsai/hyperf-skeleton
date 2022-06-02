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
 * 排序方式.
 * @method static SortType UNKNOWN()
 * @method static SortType ASC()
 * @method static SortType DESC()
 */
class SortType extends BaseEnum
{
    #[EnumMessage(message: '')]
    public const UNKNOWN = '';

    #[EnumMessage(message: '正序')]
    public const ASC = 'asc';

    #[EnumMessage(message: '倒序')]
    public const DESC = 'desc';
}
