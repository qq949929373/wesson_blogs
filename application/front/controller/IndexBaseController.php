<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/27
 * Time: 上午11:43
 */

namespace app\front\controller;


use app\admin\model\FBlogsArticle;
use app\admin\model\FCategory;
use app\admin\model\FEverydaySay;
use app\admin\model\FLanguageTag;
use app\admin\model\FNotice;
use app\common\Client;
use think\App;
use think\Controller;

class IndexBaseController extends Controller
{

    public function __construct(App $app = null)
    {
        parent::__construct($app);
        //栏目
        $categoryList = FCategory::order("sort", "desc")
            ->all();
        $this->assign("categoryList", $categoryList);
        //语言标签
        $languageList = FLanguageTag::where("category_id", "=", 1)->select();
        $this->assign("languageList", $languageList);
        //公告
        $noticeList = FNotice::order("create_time", "desc")
            ->all();
        $this->assign("noticeList", $noticeList);
        //每日一句
        $say = FEverydaySay::where("recommend_time", "elt", time())
            ->order("recommend_time", "desc")
            ->order("create_time", "desc")
            ->find();
        $weeks = array("日", "一", "二", "三", "四", "五", "六");
        $this->assign("say", $say);
        $this->assign("week", date("w", strtotime($say["recommend_time"])));
        $this->assign("weeks", $weeks);
        //最热
        $holdBlogsList = FBlogsArticle::query("select a.*,(select count(1) from f_blogs_comment c where c.blogs_id=a.id) as count from f_blogs_article a order by a.view_num desc,count desc limit 0,7");
        $this->assign("holdBlogsList", $holdBlogsList);
        $this->getBrowserInfo();
    }


    /**
     * 获取浏览器信息
     * @return array
     */
    protected function getBrowserInfo()
    {
        if (!session("?USER_IP")) {
            session("USER_IP", Client::getIpAddr());
        }
        if (!session("?USER_IP_FROM")) {
            session("USER_IP_FROM", Client::getIpFrom());
        }
        if (!session("?USER_BROWSER")) {
            session("USER_BROWSER", Client::getBrowser());
        }
        if (!session("?USER_OS")) {
            session("USER_OS", Client::getOs());
        }
    }
}