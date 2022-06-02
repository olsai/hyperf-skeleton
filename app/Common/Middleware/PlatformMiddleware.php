<?php
/**
 * Created by PhpStorm.
 * Date:  2022/4/13
 * Time:  6:35 PM.
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
namespace App\Common\Middleware;

use Hyperf\Di\Annotation\Inject;
use Lengbin\Hyperf\Auth\Exception\InvalidTokenException;
use Lengbin\Hyperf\Auth\JwtSubject;
use Lengbin\Hyperf\Auth\Middleware\BaseAuthMiddleware;
use Lengbin\Hyperf\Common\Constants\BaseStatus;
use Lengbin\Hyperf\Common\Constants\SoftDeleted;
use Psr\Http\Message\ServerRequestInterface;

class PlatformMiddleware extends BaseAuthMiddleware
{
    #[Inject]
    protected  $platform;

    public static function getIss(): ?string
    {
        return 'platform';
    }

    protected function getTestPayload(ServerRequestInterface $request): array
    {
        $platformId = $request->getHeaderLine('x-test-platform_id');
        if (empty($platform)) {
             throw new InvalidTokenException();
        }
        return [
            'platform_id' => $platformId,
        ];
    }

    protected function handlePayload(ServerRequestInterface $request, JwtSubject $payload): array
    {
        $platform = $this->platform->detail([
            '_notThrow' => true,
        ], [
            'platform_id' => $payload->data['sub'] ?? -1,
            'enable' => SoftDeleted::ENABLE,
            'status' => BaseStatus::NORMAL,
        ], ['platform_id']);

        if (empty($platform)) {
            throw new InvalidTokenException();
        }

        return $platform;
    }
}
