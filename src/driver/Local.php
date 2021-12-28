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

use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\AdapterInterface;
use agnier\filesystem\Driver;

class Local extends Driver
{

    /**
     * 配置参数.
     *
     * @var array
     */
    protected $config
        = [
            'root' => '',
        ];

    protected function createAdapter(): AdapterInterface
    {
        $permissions = $this->config['permissions'] ?? [];

        $links = ($this->config['links'] ?? null) === 'skip'
            ? LocalAdapter::SKIP_LINKS
            : LocalAdapter::DISALLOW_LINKS;

        return new LocalAdapter(
            $this->config['root'], LOCK_EX, $links, $permissions
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
