<?php
/**
 * Created by PhpStorm.
 * Date:  2022/4/8
 * Time:  6:25 PM.
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

use App\Common\Module\Upload\Enums\UploadType;
use App\Common\Module\Upload\Type\UploadLocal;
use App\Common\Module\Upload\Type\UploadOss;

class UploadFactory
{
    public const MAP = [
        UploadType::LOCAL => UploadLocal::class,
        UploadType::ALI => UploadOss::class,
    ];

    public function make(UploadType $uploadType, ?array $config = null): UploadInterface
    {
        $class = make(self::MAP[$uploadType->getValue()]);
        $config = $config ?? config("{$uploadType->getValue()}.oss");
        $config['domain'] = $config['public']['domain'];
        $config['bucket'] = $config['public']['bucket'];

        $uploadConfig = new UploadConfig($config);
        $class->loadConfig($uploadConfig);
        return $class;
    }
}
