<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/25
 * Time: 下午5:19
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\facade\Config;

/**
 * 文件上传
 * Class File
 * @package app\admin\controller
 */
class File extends Controller
{
    //上传图片
    public function uploadImage()
    {
        //设置返回类型为json
        Config::set("default_return_type", "json");
        if ($this->request->isPost()) {
            //接收参数
            $images = $this->request->file('file');

            //计算md5和sha1散列值，作用避免文件重复上传
            $md5 = $images->hash('md5');
            $sha1 = $images->hash('sha1');

            //判断图片文件是否已经上传
            $img = Db::name('picture')->where(['md5' => $md5, 'sha1' => $sha1])->find();//我这里是将图片存入数据库，防止重复上传
            if (!empty($img)) {
                return json(['code' => 0, 'msg' => '上传成功', 'data' => ['img_id' => $img['id'], 'img_url' => $this->request->root(true) . $img['path'], "file_url" => $img['path']]]);
            } else {
                // 移动到框架应用根目录/public/uploads/picture/目录下
                $imgPath = 'public/uploads/picture';
                $info = $images->move("../" . $imgPath);
                $path = '/uploads/picture/' . date('Ymd', time()) . '/' . $info->getFilename();
                $data = [
                    'path' => $path,
                    'md5' => $md5,
                    'sha1' => $sha1,
                    'status' => 1,
                    'create_time' => time(),
                ];
                if ($img_id = Db::name('picture')->insertGetId($data)) {
                    return json(['code' => 0, 'msg' => '上传成功', 'data' => ['img_id' => $img_id, 'img_url' => $this->request->root(true) . $path, "file_url" => $path]]);
                } else {
                    return json(['code' => 1, 'msg' => '写入数据库失败']);
                }
            }
        } else {
            return json(['code' => 1, 'msg' => '非法请求!']);
        }
    }
}