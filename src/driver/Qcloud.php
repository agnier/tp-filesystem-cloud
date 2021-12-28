<?php
// +----------------------------------------------------------------------
// | ThinkPHP5.* [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: agnier <agnier@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace agnier\filesystem\driver;

use League\Flysystem\AdapterInterface;
use Overtrue\Flysystem\Cos\CosAdapter;
use agnier\filesystem\Driver;

class Qcloud extends Driver
{

    protected function createAdapter(): AdapterInterface
    {
        $config = [
            'region'          => $this->config['region'],
            'credentials'     => [
                'appId'     => $this->config['appId'], // 域名中数字部分
                'secretId'  => $this->config['secretId'],
                'secretKey' => $this->config['secretKey'],
            ],
            'bucket'          => $this->config['bucket'],
            'timeout'         => $this->config['timeout'] ?? 60,
            'connect_timeout' => $this->config['connect_timeout'] ?? 60,
            'cdn'             => $this->config['cdn'],
            'scheme'          => $this->config['scheme'] ?? 'https',
            'read_from_cdn'   => $this->config['read_from_cdn'] ?? false,
        ];

        return new CosAdapter($config);
    }

    public function url(string $path): string
    {
        if (isset($this->config['url'])) {
            return $this->concatPathToUrl($this->config['url'], $path);
        }
        return parent::url($path);
    }
}
