<?php

declare(strict_types=1);

namespace App\Common\Constants;

use Lengbin\Hyperf\ErrorCode\BaseEnum;
use Lengbin\ErrorCode\Annotation\EnumMessage;

class Error extends BaseEnum
{
    /**
     * @Message("Success")
     */
    #[EnumMessage("Success")]
    const ERROR_COMMONERROR_SUCCESS = 0;
    
    /**
     * @Message("系统错误")
     */
    #[EnumMessage("系统错误")]
    const ERROR_COMMONERROR_SERVER_ERROR = 500;
    
    /**
     * @Message("无效权限")
     */
    #[EnumMessage("无效权限")]
    const ERROR_COMMONERROR_INVALID_PERMISSION = 403;
    
    /**
     * @Message("错误的请求参数")
     */
    #[EnumMessage("错误的请求参数")]
    const ERROR_COMMONERROR_INVALID_PARAMS = 400;
    
    /**
     * @Message("登录已超时")
     */
    #[EnumMessage("登录已超时")]
    const ERROR_COMMONERROR_TOKEN_EXPIRED = 408;
    
    /**
     * @Message("请重新登录")
     */
    #[EnumMessage("请重新登录")]
    const ERROR_COMMONERROR_INVALID_TOKEN = 401;
    
}
