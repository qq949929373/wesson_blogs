<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午10:34
 */

namespace app\admin\model;


use think\Model;

class FEverydaySay extends Model
{
    //自动填充时间
    protected $autoWriteTimestamp = true;

    public function getRecommendTimeAttr($val){
        return date("Y-m-d",$val);
    }

}