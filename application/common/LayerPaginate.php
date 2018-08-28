<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午1:39
 */

namespace app\common;

/**
 * layerui 表格返回
 * Class LayerPaginate
 * @package app\common
 */
class LayerPaginate
{

    public static function success($res)
    {
        $page = [
            "code" => 0,
            "msg" => "获取成功",
            "count" => $res->total(),
            "data" => $res->items()
        ];

        return $page;
    }
}