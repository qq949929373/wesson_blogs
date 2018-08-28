<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/26
 * Time: 上午12:39
 */

namespace app\admin\model;


use think\Model;

class FBlogsComment extends Model
{
    //自动填充时间
    protected $autoWriteTimestamp = true;


    public function getUserIdAttr($val)
    {
        return [
            "text" => FUser::where('id', $val)->value('username'),
            "value" => $val
        ];
    }

    public function getBlogsIdAttr($val)
    {
        if ($val == 0) {
            return null;
        }
        return FBlogsArticle::where('id', $val)->value('title');
    }

}