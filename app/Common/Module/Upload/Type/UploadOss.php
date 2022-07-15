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
namespace App\Common\Module\Upload\Type;

use AlibabaCloud\Client\AlibabaCloud;
use App\Common\Module\Upload\AbstractUpload;
use EasySwoole\Oss\AliYun\Config;
use EasySwoole\Oss\AliYun\OssClient;
use Lengbin\Helper\Util\DateHelper;

class UploadOss extends AbstractUpload
{
    protected ?OssClient $client = null;

    protected bool $init = false;

    public function getClient(): OssClient
    {
        if ($this->client) {
            return $this->client;
        }
        $config = new Config([
            'accessKeyId' => $this->config->public['access_key'],
            'accessKeySecret' => $this->config->public['secret_key'],
            'endpoint' => $this->config->public['endpoint'],
        ]);
        $this->client = new OssClient($config);
        return $this->client;
    }

    public function getUploadToken(array $query = []): array
    {
        if (! $this->init) {
            AlibabaCloud::accessKeyClient($this->config->public['access_key'], $this->config->public['secret_key'])
                ->regionId($this->config->public['region'])
                ->asDefaultClient();
            $this->init = true;
        }

        $result = AlibabaCloud::rpc()
            ->scheme('https')
            ->product('Sts')
            ->version('2015-04-01')
            ->action('AssumeRole')
            ->method('POST')
            ->host('sts.aliyuncs.com')
            ->options([
                'query' => $query,
            ])
            ->request();
        $result = $result->toArray();
        return $result['Credentials'];
    }

    public function getSignUrl($bucket, string $key, string $dir = '', array $query = []): array
    {
        $token = $this->getUploadToken($query);

        $host = sprintf('https://%s.%s', $bucket, $this->config->public['endpoint']);

        $accessKeyId = $token['AccessKeyId'];
        $accessKeySecret = $token['AccessKeySecret'];

        $now = time();
        $expire = 30;
        $end = $now + $expire;
        $expiration = DateHelper::gmt_iso8601($end);

        // 最大文件大小.用户可以自己设置
        $condition = [
            'content-length-range',
            0,
            1048576000,
        ];
        $conditions[] = $condition;

        // 表示用户上传的数据，必须是以$dir开始，不然上传会失败，这一步不是必须项，只是为了安全起见，防止用户通过policy上传到别人的目录。
        $start = [
            'starts-with',
            '$key',
            $dir,
        ];
        $conditions[] = $start;

        $arr = [
            'expiration' => $expiration,
            'conditions' => $conditions,
        ];

        $policy = json_encode($arr);
        $base64_policy = base64_encode($policy);
        $string_to_sign = $base64_policy;
        $signature = base64_encode(hash_hmac('sha1', $string_to_sign, $accessKeySecret, true));

        $response['accessid'] = $accessKeyId;
        $response['host'] = $host;
        $response['policy'] = $base64_policy;
        $response['signature'] = $signature;
        $response['expire'] = $end;
        $response['dir'] = $dir;  // 这个参数是设置用户上传文件时指定的前缀。
        $response['x-oss-security-token'] = $token['SecurityToken'];
        $response['success_action_status'] = '200';

        return $response;
    }

    public function getToken(string $key)
    {
        return $this->getSignUrl($this->config->public['bucket'], $key, '', [
            'RegionId' => $this->config->public['region'],
            'RoleArn' => $this->config->public['role_arn'],
            'RoleSessionName' => 'client_name',
        ]);
    }

    public function uploadFile(string $path, string $file)
    {
        $ossClient = $this->getClient();
        try {
            $ossClient->uploadFile($this->config->public['bucket'], $path, $file);
            $data = [
                'file' => $path,
                'result' => true,
            ];
        } catch (\Exception $e) {
            $data = [
                'result' => false,
                'message' => $e->getMessage(),
            ];
        }
        return $data;
    }

    public function remove(string $path): bool
    {
        // TODO: Implement remove() method.
        return true;
    }

    public function has(string $path): bool
    {
        return true;
    }
}
