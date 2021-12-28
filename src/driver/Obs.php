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
use yzh52521\Flysystem\Obs\ObsAdapter;

class Obs extends Driver
{

    protected function createAdapter(): AdapterInterface
    {
        return new ObsAdapter([
                                  'key'        => $this->config['key'],
                                  'secret'     => $this->config['secret'],
                                  'bucket'     => $this->config['bucket'],
                                  'endpoint'   => $this->config['endpoint'],
                                  'cdn_domain' => $this->config['cdn_domain'],
                                  'ssl_verify' => $this->config['ssl_verify'],
                                  'debug'      => $this->config['debug']
                              ]);
    }

    public function url(string $path): string
    {
        if (isset($this->config['url'])) {
            return $this->concatPathToUrl($this->config['url'], $path);
        }
        return parent::url($path);
    }
}
