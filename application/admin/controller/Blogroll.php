<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/27
 * Time: 下午9:47
 */

namespace app\admin\controller;


use app\admin\model\FBlogroll;
use app\common\LayerPaginate;
use think\facade\Config;
use think\Request;

class Blogroll extends AdminMainController
{
    //列表
    public function list()
    {
        return $this->fetch();
    }

    //修改页
    public function edit($id)
    {
        $blogroll = FBlogroll::get($id);
        $blogroll = empty($blogroll) ? [
            "id" => null,
            "name" => null,
            "link_url" => null,
            "icon" => null,
        ] : $blogroll;
        $this->assign("rootPath", $this->request->root(true));
        $this->assign("blogroll", $blogroll);
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

        //获取分页
        $res = FBlogroll::where($where)
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
        if (isset($post["id"]) && !empty($post["id"])) {
            $res = FBlogroll::update($post);
        } else {
            $res = FBlogroll::create($post);
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
        $res = FBlogroll::destroy($id);
        if ($res > 0) {
            $this->success("操作成功", "list", "", 2);
        } else {
            $this->error("操作失败", null, "", 1);
        }
    }
}