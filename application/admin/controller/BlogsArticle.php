<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午12:42
 */

namespace app\admin\controller;


use app\admin\model\FBlogsArticle;
use app\admin\model\FCategory;
use app\admin\model\FLanguageTag;
use app\common\LayerPaginate;
use think\facade\Config;
use think\Request;

/**
 * 博客管理控制器
 * Class BlogsArticle
 * @package app\admin\controller
 */
class BlogsArticle extends AdminMainController
{
    //列表页
    public function list()
    {
        $categoryList = FCategory::all();
        $languageTagList = FLanguageTag::all();
        $this->assign("categoryList", $categoryList);
        $this->assign("languageTagList", $languageTagList);
        return $this->fetch();
    }

    //新增修改页
    public function edit($id)
    {
        $categoryList = FCategory::all();
        $languageTagList = FLanguageTag::all();
        $blogs = FBlogsArticle::get($id);
        $this->assign("tags", empty($blogs) ? "" : $blogs->getData("tags"));
        $blogs = empty($blogs) ? [
            "id" => null,
            "list_image" => null,
            "title" => null,
            "content_text" => null,
            "content" => null,
            "category_id" => null,
            "tags" => null,
            "source" => null,
            "source_name" => null,
            "author" => "wesson",
            "tags" => null
        ] : $blogs;
        $this->assign("blogs", $blogs);
        $this->assign("categoryList", $categoryList);
        $this->assign("languageTagList", $languageTagList);
        $this->assign("rootPath", $this->request->root(true));
        $this->assign("id", $id);
        return $this->fetch();
    }

    /**
     * 列表数据
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
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
        if (isset($param["title"]) && !empty($param["title"])) {
            $where[] = ["title", "like", "%" . $param["title"] . "%"];
        }

        if (isset($param["category_id"]) && !empty($param["category_id"])) {
            $where[] = ["category_id", "eq", $param["category_id"]];
        }

        if (isset($param["tags"]) && !empty($param["tags"])) {
            $where[] = ["concat(',',tags,',')", "like", "%," . $param["tags"] . ",%"];
        }
        //获取分页
        $res = FBlogsArticle::where($where)
            ->page($page, $limit)
            ->paginate($limit);
        return LayerPaginate::success($res);
    }

    //新增或修改
    public function saveOrUpdate(Request $request)
    {
        $post = $request->post();
        if (isset($post["id"]) && !empty($post["id"])) {
            $res = FBlogsArticle::update($post);
        } else {
            $res = FBlogsArticle::create($post);
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
        $res = FBlogsArticle::destroy($id);
        if ($res > 0) {
            $this->success("操作成功", "list", "", 2);
        } else {
            $this->error("操作失败", null, "", 1);
        }
    }

}