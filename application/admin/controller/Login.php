<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 上午11:54
 */

namespace app\admin\controller;


use app\admin\model\AUser;
use think\Controller;
use think\facade\Config;
use think\Request;

/**
 * 登录控制器
 * Class Login
 * @package app\admin\controller
 */
class Login extends Controller
{
    function login()
    {
        return $this->fetch();
    }

    /**
     * 登出
     */
    public function logout()
    {
        if ("?" . session(Config::get("session_key.admin_id"))) {
            session(Config::get("session_key.admin_id"), null);
        }
        if ("?" . session(Config::get("session_key.admin_name"))) {
            session(Config::get("session_key.admin_name"), null);
        }
        $this->success("注销成功", "/admin/login/login");
    }

    public function toLogin(Request $request)
    {
        $post = $request->post();
        if (!isset($post["username"])) {
            $this->error("请填写用户名");
        }
        if (!isset($post["password"])) {
            $this->error("请填写密码");
        }
        $user = AUser::where("username", "=", $post["username"])
            ->where("password", "=", md5($post["password"]))
            ->find();
        if ($user == null) {
            return $this->error("用户名或密码错误");
        } else {
            //模拟登录
            session(Config::get("session_key.admin_id"), $user->id);
            session(Config::get("session_key.admin_name"), $user->username);
            return $this->success("登录成功", "/admin");
        }
    }
}