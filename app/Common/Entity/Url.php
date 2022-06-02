<?php
/**
 * Created by PhpStorm.
 * Date:  2022/3/20
 * Time:  9:27 AM.
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
namespace App\Common\Entity;

class Url
{
    public string $path;

    public string $url;

    public function __construct(string $path = '')
    {
        $this->path = $path;
        $this->url = $path;
    }
}
