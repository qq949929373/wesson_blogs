<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/28
 * Time: 下午5:08
 */

namespace app\front\controller;


use app\admin\model\FBlogsArticle;
use app\admin\model\FBlogsComment;
use app\admin\model\FCategory;
use app\admin\model\FLanguageTag;
use think\Request;

class Blog extends IndexBaseController
{
    /**
     * 我的博客
     */
    public function myBlog($userId, $page = 1)
    {
        $newBlogsList = FBlogsArticle::where("author_id", "=", $userId)
            ->order("create_time", "desc")
            ->page($page, 5)
            ->paginate(5);
        foreach ($newBlogsList as &$new) {
            $count = FBlogsComment::where("blogs_id", $new["id"])
                ->count();
            $new["comment_num"] = $count;
        }
        $this->assign("newBlogsList", $newBlogsList->items());
        $this->assign("page", $newBlogsList->toArray());
        $this->assign("userId", $userId);
        return $this->fetch();
    }

    /**
     * 新增博客页
     * @return mixed
     */
    public function makeBlog()
    {
        $categoryList = FCategory::whereNull("link_url")
            ->whereOr("link_url", "=", "")
            ->select();
        $languageTagList = FLanguageTag::all();
        $this->assign("categoryList", $categoryList);
        $this->assign("languageTagList", $languageTagList);
        $this->assign("rootPath", $this->request->root(true));
        return $this->fetch();
    }

    /**
     * 新增博客
     * @param Request $request
     */
    public function newBlog(Request $request)
    {
        $post = $request->post();
        $res = FBlogsArticle::create($post);
        if ($res["id"] > 0) {
            $this->success("操作成功", "/myBlog", "", 2);
        } else {
            $this->error("操作失败", null, "", 1);
        }
    }
}