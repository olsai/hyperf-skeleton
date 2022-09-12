<?php
/**
 * Created by PhpStorm.
 * Date:  2022/4/15
 * Time:  10:39 PM.
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
namespace App\Common\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Lengbin\Hyperf\Auth\Exception\InvalidTokenException;
use Lengbin\Hyperf\Auth\Exception\TokenExpireException;
use Lengbin\Hyperf\Common\Constants\Errors\CommonError;
use Lengbin\Hyperf\Common\Exceptions\BusinessException;
use Lengbin\Hyperf\Common\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class TokenExceptionHandler extends ExceptionHandler
{
    protected Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        $errorCode = $throwable instanceof TokenExpireException ? CommonError::TOKEN_EXPIRED() : CommonError::INVALID_TOKEN();
        $error = new BusinessException($errorCode);
        return $this->response->fail($error->getCode(), $error->getMessage());
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof InvalidTokenException || $throwable instanceof TokenExpireException;
    }
}
