<?php
/**
 * Created by PhpStorm.
 * User: chenweixiang
 * Date: 2018/8/27
 * Time: 上午11:35
 */

namespace app\common;


class Client
{
    //获得访客浏览器类型
    public static function getBrowser()
    {
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            $br = $_SERVER['HTTP_USER_AGENT'];
            if (preg_match('/MSIE/i', $br)) {
                $br = 'MSIE';
            } elseif (preg_match('/Firefox/i', $br)) {
                $br = 'Firefox';
            } elseif (preg_match('/Chrome/i', $br)) {
                $br = 'Chrome';
            } elseif (preg_match('/Safari/i', $br)) {
                $br = 'Safari';
            } elseif (preg_match('/Opera/i', $br)) {
                $br = 'Opera';
            } else {
                $br = 'Other';
            }
            return $br;
        } else {
            return "unknow";
        }
    }

    //获得访客浏览器语言
    public static function getLang()
    {
        if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
            $lang = substr($lang, 0, 5);
            if (preg_match("/zh-cn/i", $lang)) {
                $lang = "简体中文";
            } elseif (preg_match("/zh/i", $lang)) {
                $lang = "繁体中文";
            } else {
                $lang = "English";
            }
            return $lang;
        } else {
            return "unknow";
        }
    }

    //获取访客操作系统
    public static function getOs()
    {
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            $OS = $_SERVER['HTTP_USER_AGENT'];
            if (preg_match('/win/i', $OS)) {
                $OS = 'Windows';
            } elseif (preg_match('/mac/i', $OS)) {
                $OS = 'MAC';
            } elseif (preg_match('/linux/i', $OS)) {
                $OS = 'Linux';
            } elseif (preg_match('/unix/i', $OS)) {
                $OS = 'Unix';
            } elseif (preg_match('/bsd/i', $OS)) {
                $OS = 'BSD';
            } else {
                $OS = 'Other';
            }
            return $OS;
        } else {
            return "unknow";
        }
    }

    //获得访客真实ip
    public static function getIpAddr()
    {
        $ip = "";
        $ips = [];
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //获取代理ip
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        }
        if ($ip) {
            $ips = array_unshift($ips, $ip);
        }
        $count = count($ips);
        for ($i = 0; $i < $count; $i++) {
            if (!preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i])) {//排除局域网ip
                $ip = $ips[$i];
                break;
            }
        }
        $tip = empty($_SERVER['REMOTE_ADDR']) ? $ip : $_SERVER['REMOTE_ADDR'];
        if ($tip == "127.0.0.1") { //获得本地真实IP
            return self::getOnlineip();
        } else {
            return $tip;
        }
    }

    //获得本地真实IP
    public static function getOnlineip()
    {
        $ip_json = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=myip");
        $ip_arr = json_decode(stripslashes($ip_json), 1);
        if ($ip_arr['code'] == 0) {
            return $ip_arr['data']['ip'];
        }

    }

    //根据ip获得访客所在地地名
    public static function getIpFrom($ip = '')
    {
        if (empty($ip)) {
            $ip = self::getIpAddr();
        }
        $ip_json = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip);//根据taobao ip
        $ip_arr = json_decode(stripslashes($ip_json), 1);
        if ($ip_arr['code'] == 0) {
            return $ip_arr['data']['region'].$ip_arr['data']['city'];
        } else {
            return false;
        }

    }
}