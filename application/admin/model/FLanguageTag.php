<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午3:53
 */

namespace app\admin\model;


use think\Model;

class FLanguageTag extends Model
{
    //自动填充时间
    protected $autoWriteTimestamp = true;

    //自动转换栏目值
    public function getCategoryIdAttr($val)
    {
        return [
            "text" => FCategory::where('id', $val)->value('name'),
            "value" => $val
        ];
    }

}