<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午10:08
 */

namespace app\admin\controller;

use app\admin\model\FBlogsArticle;
use app\admin\model\FBlogsComment;
use app\admin\model\FUser;
use app\common\LayerPaginate;
use think\facade\Config;
use think\Request;

class BlogsComment extends AdminMainController
{
    //列表
    public function list()
    {
        $blogsArticle = FBlogsArticle::query("select b.id,b.title from f_blogs_comment c left join f_blogs_article b on b.id = c.blogs_id group by c.blogs_id order by b.create_time desc");
        $this->assign("blogsList", $blogsArticle);
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
        if (isset($param["blogs_id"]) && !empty($param["blogs_id"])) {
            $where[] = ["blogs_id", "=", $param["blogs_id"]];
        }
        //获取分页
        $res = FBlogsComment::where($where)
            ->order([
                "create_time" => "desc",
                "sort" => "asc",
                "blogs_id" => "desc",
            ])
            ->page($page, $limit)
            ->paginate($limit);
        foreach ($res->items() as &$item) {
            if (isset($item["user_id"]["value"]) && $item["user_id"]["value"] != 0) {
                $user = FUser::get($item["user_id"]["value"]);
                $item["user_email"] = $user->email;
                $item["user_qq"] = $user->qq;
                $item["user_wechat"] = $user->we_chat;
            }
        }
        return LayerPaginate::success($res);
    }

    //删除
    public function delete($id)
    {
        $res = FBlogsComment::destroy($id);
        if ($res > 0) {
            $this->success("操作成功", "list", "", 2);
        } else {
            $this->error("操作失败", null, "", 1);
        }
    }
}