<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/24
 * Time: 下午6:59
 */

namespace app\admin\controller;


use think\facade\Config;

/**
 * 主页
 * Class Index
 * @package app\admin\controller
 */
class Index extends AdminMainController
{
    public function index()
    {
        return $this->fetch();
    }
}