<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午3:49
 */

namespace app\admin\controller;


use app\admin\model\FCategory;
use app\admin\model\FLanguageTag;
use app\common\LayerPaginate;
use think\facade\Config;
use think\Request;

/**
 * 语言标签控制器
 * Class LanguageTag
 * @package app\admin\controller
 */
class LanguageTag extends AdminMainController
{
    //列表
    public function list()
    {
        $categoryList = FCategory::all();
        $this->assign("categoryList", $categoryList);
        return $this->fetch();
    }

    //修改页
    public function edit($id)
    {

        $categoryList = FCategory::all();
        $languageTag = FLanguageTag::get($id);
        $languageTag = empty($languageTag) ? [
            "id" => null,
            "name" => null,
            "category_id" => null,
            "use_num" => 0,
            "sort" => 99
        ] : $languageTag;
        $this->assign("languageTag", $languageTag);
        $this->assign("categoryList", $categoryList);
        $this->assign("id", $id);
        return $this->fetch();
    }

    //获取列表数据
    public function selectList(Request $request)
    {
        //设置返回类型为json
        Config::set("default_return_type", "json");
        //获取参数
        $param = $request->param();
        $page = $param["page"];
        $limit = $param["limit"];
        //添加查询条件
        $where = [];
        if (isset($param["name"]) && !empty($param["name"])) {
            $where[] = ["name", "like", "%" . $param["name"] . "%"];
        }

        if (isset($param["category_id"]) && !empty($param["category_id"])) {
            $where[] = ["category_id", "eq", $param["category_id"]];
        }

        //获取分页
        $res = FLanguageTag::where($where)
            ->order([
                "category_id" => "asc",
                "sort" => "desc",
                "create_time" => "asc",
            ])
            ->page($page, $limit)
            ->paginate($limit);
        return LayerPaginate::success($res);
    }

    //新增或修改
    public function saveOrUpdate(Request $request)
    {
        $post = $request->post();
        if (isset($post["id"]) && !empty($post["id"])) {
            $res = FLanguageTag::update($post);
        } else {
            $res = FLanguageTag::create($post);
        }
        if ($res["id"] > 0) {
            $this->success("操作成功", "list", "", 2);
        } else {
            $this->error("操作失败", null, "", 1);
        }
    }

    //删除
    public function delete($id)
    {
        $res = FLanguageTag::destroy($id);
        if ($res > 0) {
            $this->success("操作成功", "list", "", 2);
        } else {
            $this->error("操作失败", null, "", 1);
        }
    }
}