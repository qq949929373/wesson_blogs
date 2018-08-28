<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午2:35
 */

namespace app\admin\controller;


use app\admin\model\FCategory;
use app\common\LayerPaginate;
use think\facade\Config;
use think\Request;

/**
 * 栏目管理控制器
 * Class Category
 * @package app\admin\controller
 */
class Category extends AdminMainController
{
    //列表
    public function list()
    {
        return $this->fetch();
    }

    //修改页
    public function edit($id)
    {
        $category = FCategory::get($id);
        $category = empty($category) ? [
            "name" => null,
            "id" => null,
            "link_url" => null,
            "sort" => 99
        ] : $category;
        $this->assign("category", $category);
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
        if (isset($param["name"]) && !empty($param["name"])) {
            $where = [["name", "like", "%" . $param["name"] . "%"]];
        } else {
            $where = [];
        }
        //获取分页
        $res = FCategory::where($where)->page($page, $limit)->paginate($limit);
        return LayerPaginate::success($res);
    }

    //新增或修改
    public function saveOrUpdate(Request $request)
    {
        $post = $request->post();
        if (isset($post["id"]) && !empty($post["id"])) {
            $res = FCategory::update($post);
        } else {
            $res = FCategory::create($post);
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
        $res = FCategory::destroy($id);
        if ($res > 0) {
            $this->success("操作成功", "list", "", 2);
        } else {
            $this->error("操作失败", null, "", 1);
        }
    }
}