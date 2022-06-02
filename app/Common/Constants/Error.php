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
namespace App\Common\Constants;

use Lengbin\ErrorCode\Annotation\EnumMessage;
use Lengbin\Hyperf\ErrorCode\BaseEnum;

class Error extends BaseEnum
{
    /**
     * @Message("Success")
     */
    #[EnumMessage('Success')]
    public const ERROR_COMMONERROR_SUCCESS = 0;

    /**
     * @Message("系统错误")
     */
    #[EnumMessage('系统错误')]
    public const ERROR_COMMONERROR_SERVER_ERROR = 1;

    /**
     * @Message("无效权限")
     */
    #[EnumMessage('无效权限')]
    public const ERROR_COMMONERROR_INVALID_PERMISSION = 2;

    /**
     * @Message("错误的请求参数")
     */
    #[EnumMessage('错误的请求参数')]
    public const ERROR_COMMONERROR_INVALID_PARAMS = 3;

    /**
     * @Message("登录已超时")
     */
    #[EnumMessage('登录已超时')]
    public const ERROR_COMMONERROR_TOKEN_EXPIRED = 4;

    /**
     * @Message("请重新登录")
     */
    #[EnumMessage('请重新登录')]
    public const ERROR_COMMONERROR_INVALID_TOKEN = 5;
}
