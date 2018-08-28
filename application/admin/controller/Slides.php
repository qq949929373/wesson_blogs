<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午9:37
 */

namespace app\admin\controller;


use app\admin\model\FSlides;
use app\common\LayerPaginate;
use think\facade\Config;
use think\Request;

/**
 * 登录控制器
 * Class Slides
 * @package app\admin\controller
 */
class Slides extends AdminMainController
{
//列表
    public function list()
    {
        return $this->fetch();
    }

    //修改页
    public function edit($id)
    {

        $slides = FSlides::get($id);
        $slides = empty($slides) ? [
            "id" => null,
            "image_url" => null,
            "link_url" => null,
            "sort" => 99
        ] : $slides;
        $this->assign("rootPath", $this->request->root(true));
        $this->assign("slides", $slides);
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

        //获取分页
        $res = FSlides::order([
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
            $res = FSlides::update($post);
        } else {
            $res = FSlides::create($post);
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
        $res = FSlides::destroy($id);
        if ($res > 0) {
            $this->success("操作成功", "list", "", 2);
        } else {
            $this->error("操作失败", null, "", 1);
        }
    }
}