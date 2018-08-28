<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 上午11:35
 */

namespace app\admin\controller;


use think\App;
use think\Controller;
use think\facade\Config;

/**
 * 控制器基类
 * Class AdminMainController
 * @package app\admin\controller
 */
class AdminMainController extends Controller
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        //判断用户是否登录
        if (!session("?" . Config::get("session_key.admin_id"))) {
            $this->redirect("admin/login/login");
        }
    }


}