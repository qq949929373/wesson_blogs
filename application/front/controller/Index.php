<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/24
 * Time: 下午6:54
 */

namespace app\front\controller;


use app\admin\model\FBlogroll;
use app\admin\model\FBlogsArticle;
use app\admin\model\FBlogsComment;
use app\admin\model\FCategory;
use app\admin\model\FLanguageTag;
use app\admin\model\FSlides;
use app\admin\model\FTodayRecommend;
use app\admin\model\FUser;
use think\facade\Config;
use think\Request;

class Index extends IndexBaseController
{
    //首页
    public function index(Request $request, $page = 1)
    {
        //轮播图
        $slides = FSlides::order("sort", "desc")
            ->order("create_time", "desc")
            ->all();
        $this->assign("slides", $slides);
        $this->assign("slidesI", 0);
        $this->assign("slidesJ", 0);
        //今日推荐
        $today = FTodayRecommend::where("recommend_time", "elt", time())
            ->order("recommend_time", "desc")
            ->order("create_time", "desc")
            ->find();
        $this->assign("today", $today);
        //最新发布
        $newBlogsList = FBlogsArticle::order("create_time", "desc")
            ->page($page, 5)
            ->paginate(5);
        foreach ($newBlogsList as &$new) {
            $count = FBlogsComment::where("blogs_id", $new["id"])
                ->count();
            $new["comment_num"] = $count;
        }
        $this->assign("newBlogsList", $newBlogsList->items());
        $this->assign("page", $newBlogsList->toArray());

        return $this->fetch();
    }

    /**
     * 登录成功
     * @param Request $request
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login(Request $request)
    {
        $post = $request->post();
        if (!(isset($post["username"]) && isset($post["password"]))) {
            $this->error("请输入必填参数");
        }
        $user = FUser::where("username", "=", $post["username"])
            ->find();
        if ($user == null) {
            $this->error("用户不存在");
        } elseif ($user->password != md5($post["password"])) {
            $this->error("密码错误");
        } else {
            session("USER_ID", $user->id);
            session("USER_NAME", $user->username);
            $this->success("登录成功", "/");
        }
    }

    /**
     * 注册
     * @param Request $request
     */
    public function register(Request $request)
    {
        $post = $request->post();
        if (!(isset($post["username"]) && isset($post["password"]) && isset($post["email"]))) {
            $this->error("请输入必填参数");
        }
        $post["password"] = md5($post["password"]);
        $count = FUser::where("username", "=", $post["username"])
            ->count();
        if ($count > 0) {
            $this->error("注册失败,已存在该用户");
        }
        $user = FUser::create($post);
        if (!empty($user->id)) {
            session("USER_ID", $user->id);
            session("USER_NAME", $user->username);
            $this->success("注册成功", "/");
        } else {
            $this->error("注册失败");
        }
    }

    /**
     * 登出
     */
    public function logout()
    {
        if (session("?USER_ID")) {
            session("USER_ID", null);
        }
        if (session("?USER_NAME")) {
            session("USER_NAME", null);
        }
        $this->success("已登出", "/");
    }

    //博客
    public function blogs(Request $request, $categoryId, $tags = "")
    {

        $this->assign("categoryId", $categoryId);
        $this->assign("tags", $tags);
        //栏目
        $category = FCategory::get($categoryId);
        $this->assign("categoryName", $category->name);
        //语言标签
        $languageList = FLanguageTag::where("category_id", "=", $categoryId)->select();
        $this->assign("languageList", $languageList);
        //最新发布
        $where = [
            ["category_id", "=", $categoryId]
        ];
        if (!empty($tags)) {
            $where[] = ["concat(',',tags,',')", "like", "%," . $tags . ",%"];
        }
        $page = $request->get("page", 1);
        $newBlogsList = FBlogsArticle::where($where)
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

        return $this->fetch();
    }

    /**
     * 博客详情
     * @param $id
     * @param int $page
     * @return mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function blogsDetail($id, $page = 1)
    {
        $this->assign("id", $id);
        FBlogsArticle::get($id)->setInc("view_num");
        $blogs = FBlogsArticle::get($id);
        $count = FBlogsComment::where("blogs_id", $blogs->id)
            ->count();
        $blogs["comment_num"] = $count;
        $this->assign("blogs", $blogs);
        //标签
        $languageList = FLanguageTag::where("id", "in", $blogs->getOrigin("tags"))->select();
        $this->assign("languageList", $languageList);
        //推荐
        $fblogsArticle = new FBlogsArticle();
        $tags = explode(",", $blogs->getOrigin("tags"));
        foreach ($tags as $tag) {
            $fblogsArticle->whereOr("concat(',',tags,',')", "like", "%," . $tag . ",%");
        }
        $recommendList = $fblogsArticle
            ->order("view_num", "desc")
            ->order("create_time", "desc")
            ->page(1, 7)
            ->select();
        $this->assign("recommendList", $recommendList);
        //评论
        $commentList = FBlogsComment::where("blogs_id", "=", $id)
            ->order("sort", "asc")
            ->page($page, 5)
            ->paginate(5);
        $this->assign("commentList", $commentList->items());
        $this->assign("commentPage", $commentList->toArray());
        return $this->fetch();
    }

    /**
     * 保存评论
     * @param Request $request
     */
    public function saveBlogsComment(Request $request)
    {
        Config::set("default_return_type", "json");
        $post = $request->post();
        $blogsId = $post["blogs_id"];
        $sort = FBlogsComment::where("blogs_id", "=", $blogsId)
            ->order("sort", "desc")
            ->value("sort");
        if (!is_numeric($sort)) {
            $post["sort"] = 1;
        } else {
            $post["sort"] = $sort + 1;
        }
        $comment = FBlogsComment::create($post);
        if (isset($comment->id)) {
            $this->success("评论成功");
        } else {
            $this->error("评论失败");
        }
    }

    /**
     * 标签云
     */
    public function tags()
    {
        $languageTag = FLanguageTag::query("select lt.*,(select count(1) from f_blogs_article ba where concat(',',ba.tags,',') like concat('%,',lt.id,',%')) as use_num from f_language_tag lt");
        $this->assign("languageTag", $languageTag);
        return $this->fetch();
    }

    /**
     * 读者墙
     * @return mixed
     * @throws \think\db\exception\BindParamException
     * @throws \think\exception\PDOException
     */
    public function readers()
    {
        $userList = FUser::query("SELECT count(1) AS count,u.* FROM f_blogs_comment bc LEFT JOIN f_user u ON u.id = bc.user_id WHERE bc.user_id != 0 AND user_id IS NOT NULL GROUP BY bc.user_id ORDER BY count DESC limit 0,6");
        for ($i = 0; $i < count($userList); $i++) {
            $user = &$userList[$i];
            switch ($i) {
                case 0:
                    $user["type"] = "【金牌读者】";
                    $user["class"] = "item-readers-1";
                    break;
                case 1:
                    $user["type"] = "【银牌读者】";
                    $user["class"] = "item-readers-2";
                    break;
                case 2:
                    $user["type"] = "【铜牌读者】";
                    $user["class"] = "item-readers-3";
                    break;
                default:
                    $user["type"] = "【普通读者】";
                    $user["class"] = "item-readers-4";
                    break;
            }
        }
        $this->assign("userList", $userList);
        return $this->fetch();
    }

    /**
     * 友情链接
     * @return mixed
     * @throws \think\Exception\DbException
     */
    public function links()
    {
        $rollList = FBlogroll::order("create_time")->all();
        $this->assign("rollList", $rollList);
        return $this->fetch();
    }

    public function search(Request $request, $keyword = "", $page = 1)
    {
        $post = $request->post();
        if (isset($post["keyword"])) {
            $keyword = $post["keyword"];
            cookie("SEARCH_KEYWORD", $keyword);
        } elseif (cookie("?SEARCH_KEYWORD")) {
            $keyword = cookie("SEARCH_KEYWORD");
        }
        $newBlogsList = FBlogsArticle::where("title", "like", "%" . $keyword . "%")
            ->whereOr("content_text", "like", "%" . $keyword . "%")
            ->order("create_time", "desc")
            ->page($page, 5)
            ->paginate(5);
        foreach ($newBlogsList as &$new) {
            $count = FBlogsComment::where("blogs_id", $new["id"])
                ->count();
            $new["comment_num"] = $count;
        }
        $this->assign("keyword", $keyword);
        $this->assign("newBlogsList", $newBlogsList->items());
        $this->assign("page", $newBlogsList->toArray());
        return $this->fetch();
    }
}