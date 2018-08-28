<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午1:04
 */

namespace app\admin\model;


use think\Model;

class FBlogsArticle extends Model
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

    //自动转换技术语言
    public function getTagsAttr($val)
    {
        return FLanguageTag::where("id", "in", $val)->value("group_concat(name)");
    }

    public function comments()
    {
        return $this->hasMany('FBlogsComment', "blogs_id");
    }
}