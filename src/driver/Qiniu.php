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

namespace agnier\filesystem\driver;

use League\Flysystem\AdapterInterface;
use Overtrue\Flysystem\QiNiu\QiniuAdapter;
use agnier\filesystem\Driver;

class Qiniu extends Driver
{

    protected function createAdapter(): AdapterInterface
    {
        return new QiniuAdapter(
            $this->config['accessKey'], $this->config['secretKey'],
            $this->config['bucket'], $this->config['domain']
        );
    }

    public function url(string $path): string
    {
        if (isset($this->config['url'])) {
            return $this->concatPathToUrl($this->config['url'], $path);
        }
        return parent::url($path);
    }
}
