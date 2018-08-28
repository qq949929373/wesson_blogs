<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午10:34
 */

namespace app\admin\controller;

use app\admin\model\FEverydaySay;
use app\common\LayerPaginate;
use think\facade\Config;
use think\Request;

class EverydaySay extends AdminMainController
{
    //列表
    public function list()
    {
        return $this->fetch();
    }

    //修改页
    public function edit($id)
    {
        $everydaySay = FEverydaySay::get($id);
        $everydaySay = empty($everydaySay) ? [
            "id" => null,
            "content" => null,
            "recommend_time" => null
        ] : $everydaySay;
        $this->assign("everydaySay", $everydaySay);
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
        if (isset($param["content"]) && !empty($param["content"])) {
            $where[] = ["content", "like", "%" . $param["content"] . "%"];
        }

        //获取分页
        $res = FEverydaySay::where($where)
            ->order([
                "create_time" => "desc",
            ])
            ->page($page, $limit)
            ->paginate($limit);
        return LayerPaginate::success($res);
    }

    //新增或修改
    public function saveOrUpdate(Request $request)
    {
        $post = $request->post();
        if (isset($post["recommend_time"]) && !empty($post["recommend_time"])) {
            $post["recommend_time"] = strtotime($post["recommend_time"]);
        }

        if (isset($post["id"]) && !empty($post["id"])) {
            $res = FEverydaySay::update($post);
        } else {
            $res = FEverydaySay::create($post);
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
        $res = FEverydaySay::destroy($id);
        if ($res > 0) {
            $this->success("操作成功", "list", "", 2);
        } else {
            $this->error("操作失败", null, "", 1);
        }
    }
}