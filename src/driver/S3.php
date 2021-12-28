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
use agnier\filesystem\Driver;
use Aws\Handler\GuzzleV6\GuzzleHandler;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class S3 extends Driver
{

    protected function createAdapter(): AdapterInterface
    {
        $handler = new GuzzleHandler();
        $options = array_merge($this->config, ['http_handler' => $handler]);
        $client  = new S3Client($options);
        return new AwsS3Adapter($client, $options['bucket_name'], '');
    }

    public function url(string $path): string
    {
        if (isset($this->config['url'])) {
            return $this->concatPathToUrl($this->config['url'], $path);
        }
        return parent::url($path);
    }
}
