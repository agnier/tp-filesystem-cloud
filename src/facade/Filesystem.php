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
declare (strict_types = 1);

namespace agnier\filesystem\facade;

use think\Facade;
/**
 * Class Filesystem
 * @package think\facade
 * @mixin \agnier\filesystem
 */
class Filesystem extends Facade
{
    protected static function getFacadeClass()
    {
        return \agnier\filesystem\Filesystem::class;
    }
}
