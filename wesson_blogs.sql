/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : wesson_blogs

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 08/28/2018 09:25:32 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `a_user`
-- ----------------------------
DROP TABLE IF EXISTS `a_user`;
CREATE TABLE `a_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `a_user`
-- ----------------------------
BEGIN;
INSERT INTO `a_user` VALUES ('1', 'wesson', '21232f297a57a5a743894a0e4a801fc3', null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `f_blogroll`
-- ----------------------------
DROP TABLE IF EXISTS `f_blogroll`;
CREATE TABLE `f_blogroll` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '链接名称',
  `link_url` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `icon` varchar(255) DEFAULT NULL COMMENT '链接图标',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='友情链接';

-- ----------------------------
--  Records of `f_blogroll`
-- ----------------------------
BEGIN;
INSERT INTO `f_blogroll` VALUES ('1', '百度', 'http://www.baidu.com', 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1535385114615&di=8fd52f9d54cca92ab012190fe0391ed8&imgtype=0&src=http%3A%2F%2Fimg.zcool.cn%2Fcommunity%2F01ffaa593fc51ea8012193a3c0c057.png', null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `f_blogs_article`
-- ----------------------------
DROP TABLE IF EXISTS `f_blogs_article`;
CREATE TABLE `f_blogs_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `list_image` varchar(255) DEFAULT NULL COMMENT '列表图片',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` longtext COMMENT '内容',
  `content_text` longtext COMMENT '内容纯文本',
  `view_num` int(11) DEFAULT '0' COMMENT '浏览数',
  `category_id` int(11) DEFAULT NULL COMMENT '栏目id',
  `tags` varchar(255) DEFAULT NULL COMMENT '标签用逗号隔开',
  `source` varchar(255) DEFAULT NULL COMMENT '来源',
  `source_name` varchar(255) DEFAULT NULL COMMENT '来源名称',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `author` varchar(32) DEFAULT 'wesson' COMMENT '作者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='博客文章';

-- ----------------------------
--  Records of `f_blogs_article`
-- ----------------------------
BEGIN;
INSERT INTO `f_blogs_article` VALUES ('1', '/uploads/picture/20180828/5d2112296ca0d63d9a073acedc1a9d9e.jpeg', 'ThinkPHP 神坑之处', '<p>1、如果使用模型获取器，就无法获取到原来的值了，如果真要获取可以采用在获取器返回一个数组来实现。例：</p><p><img src=\"http://localhost/uploads/picture/20180828/46c6ab1b4c8d40c1a2f7bdf8f8e7e5fe.png\" alt=\"http://localhost/uploads/picture/20180828/46c6ab1b4c8d40c1a2f7bdf8f8e7e5fe.png\"><br></p><p><!--5f39ae17-8c62-4a45-bc43-b32064c9388a:W3siYmxvY2tUeXBlIjoiaW1hZ2UiLCJzdHlsZXMiOnsiaGVpZ2h0IjoxMjIsImFsaWduIjoibGVmdCIsIndpZHRoIjpudWxsLCJmbG9hdCI6Im5vbmUifSwiYmxvY2tJZCI6IjExMjItMTUzNTMzMzk1OTQxMSIsInNvdXJjZSI6Ii8vbm90ZS55b3VkYW8uY29tL3NyYy82NkREQTJFRjA4Q0E0OEE1OEQ5MEI0QTc5NTE4REJGQiIsInRpdGxlIjoiIn1d--></p><div yne-bulb-block=\"image\" style=\"text-align: left;\"><img data-media-type=\"image\" src=\"//note.youdao.com/src/66DDA2EF08CA48A58D90B4A79518DBFB\" alt=\"\"></div><div yne-bulb-block=\"image\"><img data-media-type=\"image\" src=\"//note.youdao.com/src/66DDA2EF08CA48A58D90B4A79518DBFB\" alt=\"\"></div><div yne-bulb-block=\"paragraph\">可使用<span>$blogs</span><span>-&gt;</span><span>getOrigin</span><span>(</span><span>\"tags\"</span><span>)获取原来的数据</span></div><p><!--5f39ae17-8c62-4a45-bc43-b32064c9388a:W3siYmxvY2tUeXBlIjoicGFyYWdyYXBoIiwic3R5bGVzIjp7ImFsaWduIjoibGVmdCIsImluZGVudCI6MCwidGV4dC1pbmRlbnQiOjAsImxpbmUtaGVpZ2h0IjoxLjc1fSwiYmxvY2tJZCI6IjE5ODQtMTUzNTIyNjg2OTM5MCIsInJpY2hUZXh0Ijp7ImlzUmljaFRleHQiOnRydWUsImtlZXBMaW5lQnJlYWsiOnRydWUsImRhdGEiOlt7ImNoYXIiOiIxIn0seyJjaGFyIjoi44CBIn0seyJjaGFyIjoi5aaCIn0seyJjaGFyIjoi5p6cIn0seyJjaGFyIjoi5L2/In0seyJjaGFyIjoi55SoIn0seyJjaGFyIjoi5qihIn0seyJjaGFyIjoi5Z6LIn0seyJjaGFyIjoi6I63In0seyJjaGFyIjoi5Y+WIn0seyJjaGFyIjoi5ZmoIn0seyJjaGFyIjoi77yMIn0seyJjaGFyIjoi5bCxIn0seyJjaGFyIjoi5pegIn0seyJjaGFyIjoi5rOVIn0seyJjaGFyIjoi6I63In0seyJjaGFyIjoi5Y+WIn0seyJjaGFyIjoi5YiwIn0seyJjaGFyIjoi5Y6fIn0seyJjaGFyIjoi5p2lIn0seyJjaGFyIjoi55qEIn0seyJjaGFyIjoi5YC8In0seyJjaGFyIjoi5LqGIn0seyJjaGFyIjoi77yMIn0seyJjaGFyIjoi5aaCIn0seyJjaGFyIjoi5p6cIn0seyJjaGFyIjoi55yfIn0seyJjaGFyIjoi6KaBIn0seyJjaGFyIjoi6I63In0seyJjaGFyIjoi5Y+WIn0seyJjaGFyIjoi5Y+vIn0seyJjaGFyIjoi5LulIn0seyJjaGFyIjoi6YeHIn0seyJjaGFyIjoi55SoIn0seyJjaGFyIjoi5ZyoIn0seyJjaGFyIjoi6I63In0seyJjaGFyIjoi5Y+WIn0seyJjaGFyIjoi5ZmoIn0seyJjaGFyIjoi6L+UIn0seyJjaGFyIjoi5ZueIn0seyJjaGFyIjoi5LiAIn0seyJjaGFyIjoi5LiqIn0seyJjaGFyIjoi5pWwIn0seyJjaGFyIjoi57uEIn0seyJjaGFyIjoi5p2lIn0seyJjaGFyIjoi5a6eIn0seyJjaGFyIjoi546wIn0seyJjaGFyIjoi44CCIn0seyJjaGFyIjoi5L6LIn0seyJjaGFyIjoi77yaIn1dfX0seyJibG9ja1R5cGUiOiJpbWFnZSIsInN0eWxlcyI6eyJoZWlnaHQiOjEyMiwiYWxpZ24iOiJsZWZ0Iiwid2lkdGgiOm51bGwsImZsb2F0Ijoibm9uZSJ9LCJibG9ja0lkIjoiMTEyMi0xNTM1MzMzOTU5NDExIiwic291cmNlIjoiLy9ub3RlLnlvdWRhby5jb20vc3JjLzY2RERBMkVGMDhDQTQ4QTU4RDkwQjRBNzk1MThEQkZCIiwidGl0bGUiOiIifSx7ImJsb2NrVHlwZSI6InBhcmFncmFwaCIsInN0eWxlcyI6eyJhbGlnbiI6ImxlZnQiLCJpbmRlbnQiOjAsInRleHQtaW5kZW50IjowLCJsaW5lLWhlaWdodCI6MS43NX0sImJsb2NrSWQiOiIxODg0LTE1MzUyMjY5MjkzMzAiLCJyaWNoVGV4dCI6eyJpc1JpY2hUZXh0Ijp0cnVlLCJrZWVwTGluZUJyZWFrIjp0cnVlLCJkYXRhIjpbeyJjaGFyIjoi5Y+vIn0seyJjaGFyIjoi5L2/In0seyJjaGFyIjoi55SoIn0seyJjaGFyIjoiJCIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiM5ODc2YWEiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiJiIiwic3R5bGVzIjp7ImZvbnQtc2l6ZSI6MTIsImNvbG9yIjoiIzk4NzZhYSIsImJhY2stY29sb3IiOiIjMjMyNTI1In19LHsiY2hhciI6ImwiLCJzdHlsZXMiOnsiZm9udC1zaXplIjoxMiwiY29sb3IiOiIjOTg3NmFhIiwiYmFjay1jb2xvciI6IiMyMzI1MjUifX0seyJjaGFyIjoibyIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiM5ODc2YWEiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiJnIiwic3R5bGVzIjp7ImZvbnQtc2l6ZSI6MTIsImNvbG9yIjoiIzk4NzZhYSIsImJhY2stY29sb3IiOiIjMjMyNTI1In19LHsiY2hhciI6InMiLCJzdHlsZXMiOnsiZm9udC1zaXplIjoxMiwiY29sb3IiOiIjOTg3NmFhIiwiYmFjay1jb2xvciI6IiMyMzI1MjUifX0seyJjaGFyIjoiLSIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiNhOWI3YzYiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiI+Iiwic3R5bGVzIjp7ImZvbnQtc2l6ZSI6MTIsImNvbG9yIjoiI2E5YjdjNiIsImJhY2stY29sb3IiOiIjMjMyNTI1In19LHsiY2hhciI6ImciLCJzdHlsZXMiOnsiZm9udC1zaXplIjoxMiwiY29sb3IiOiIjZmZjNjZkIiwiYmFjay1jb2xvciI6IiMyMzI1MjUifX0seyJjaGFyIjoiZSIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiNmZmM2NmQiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiJ0Iiwic3R5bGVzIjp7ImZvbnQtc2l6ZSI6MTIsImNvbG9yIjoiI2ZmYzY2ZCIsImJhY2stY29sb3IiOiIjMjMyNTI1In19LHsiY2hhciI6Ik8iLCJzdHlsZXMiOnsiZm9udC1zaXplIjoxMiwiY29sb3IiOiIjZmZjNjZkIiwiYmFjay1jb2xvciI6IiMyMzI1MjUifX0seyJjaGFyIjoiciIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiNmZmM2NmQiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiJpIiwic3R5bGVzIjp7ImZvbnQtc2l6ZSI6MTIsImNvbG9yIjoiI2ZmYzY2ZCIsImJhY2stY29sb3IiOiIjMjMyNTI1In19LHsiY2hhciI6ImciLCJzdHlsZXMiOnsiZm9udC1zaXplIjoxMiwiY29sb3IiOiIjZmZjNjZkIiwiYmFjay1jb2xvciI6IiMyMzI1MjUifX0seyJjaGFyIjoiaSIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiNmZmM2NmQiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiJuIiwic3R5bGVzIjp7ImZvbnQtc2l6ZSI6MTIsImNvbG9yIjoiI2ZmYzY2ZCIsImJhY2stY29sb3IiOiIjMjMyNTI1In19LHsiY2hhciI6IigiLCJzdHlsZXMiOnsiZm9udC1zaXplIjoxMiwiY29sb3IiOiIjYTliN2M2IiwiYmFjay1jb2xvciI6IiMyMzI1MjUifX0seyJjaGFyIjoiXCIiLCJzdHlsZXMiOnsiZm9udC1zaXplIjoxMiwiY29sb3IiOiIjNmE4NzU5IiwiYmFjay1jb2xvciI6IiMyMzI1MjUifX0seyJjaGFyIjoidCIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiM2YTg3NTkiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiJhIiwic3R5bGVzIjp7ImZvbnQtc2l6ZSI6MTIsImNvbG9yIjoiIzZhODc1OSIsImJhY2stY29sb3IiOiIjMjMyNTI1In19LHsiY2hhciI6ImciLCJzdHlsZXMiOnsiZm9udC1zaXplIjoxMiwiY29sb3IiOiIjNmE4NzU5IiwiYmFjay1jb2xvciI6IiMyMzI1MjUifX0seyJjaGFyIjoicyIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiM2YTg3NTkiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiJcIiIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiM2YTg3NTkiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiIpIiwic3R5bGVzIjp7ImZvbnQtc2l6ZSI6MTIsImNvbG9yIjoiI2E5YjdjNiIsImJhY2stY29sb3IiOiIjMjMyNTI1In19LHsiY2hhciI6IuiOtyIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiNhOWI3YzYiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiLlj5YiLCJzdHlsZXMiOnsiZm9udC1zaXplIjoxMiwiY29sb3IiOiIjYTliN2M2IiwiYmFjay1jb2xvciI6IiMyMzI1MjUifX0seyJjaGFyIjoi5Y6fIiwic3R5bGVzIjp7ImZvbnQtc2l6ZSI6MTIsImNvbG9yIjoiI2E5YjdjNiIsImJhY2stY29sb3IiOiIjMjMyNTI1In19LHsiY2hhciI6IuadpSIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiNhOWI3YzYiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fSx7ImNoYXIiOiLnmoQiLCJzdHlsZXMiOnsiZm9udC1zaXplIjoxMiwiY29sb3IiOiIjYTliN2M2IiwiYmFjay1jb2xvciI6IiMyMzI1MjUifX0seyJjaGFyIjoi5pWwIiwic3R5bGVzIjp7ImZvbnQtc2l6ZSI6MTIsImNvbG9yIjoiI2E5YjdjNiIsImJhY2stY29sb3IiOiIjMjMyNTI1In19LHsiY2hhciI6IuaNriIsInN0eWxlcyI6eyJmb250LXNpemUiOjEyLCJjb2xvciI6IiNhOWI3YzYiLCJiYWNrLWNvbG9yIjoiIzIzMjUyNSJ9fV19fSx7ImJsb2NrVHlwZSI6InBhcmFncmFwaCIsInN0eWxlcyI6eyJhbGlnbiI6ImxlZnQiLCJpbmRlbnQiOjAsInRleHQtaW5kZW50IjowLCJsaW5lLWhlaWdodCI6MS43NX0sImJsb2NrSWQiOiI0Mzc3LTE1MzUzNTUzNDU1MTciLCJyaWNoVGV4dCI6eyJpc1JpY2hUZXh0Ijp0cnVlLCJrZWVwTGluZUJyZWFrIjp0cnVlLCJkYXRhIjpbeyJjaGFyIjoiMiJ9LHsiY2hhciI6IuOAgSJ9LHsiY2hhciI6IuaXoCJ9LHsiY2hhciI6IuazlSJ9LHsiY2hhciI6IuW5tiJ9LHsiY2hhciI6IuihqCJ9LHsiY2hhciI6IuafpSJ9LHsiY2hhciI6IuivoiJ9LHsiY2hhciI6Iu+8jCJ9LHsiY2hhciI6IuaIliJ9LHsiY2hhciI6IuiAhSJ9LHsiY2hhciI6IuivtCJ9LHsiY2hhciI6IuW5tiJ9LHsiY2hhciI6IuihqCJ9LHsiY2hhciI6IuaViCJ9LHsiY2hhciI6IuaenCJ9LHsiY2hhciI6IuW+iCJ9LHsiY2hhciI6IueDgiJ9XX19XQ==--></p><div yne-bulb-block=\"paragraph\" style=\"text-align: left;\">2、无法并表查询，或者说并表效果很烂</div>', '1、如果使用模型获取器，就无法获取到原来的值了，如果真要获取可以采用在获取器返回一个数组来实现。例：可使用$blogs->getOrigin(\"tags\")获取原来的数据2、无法并表查询，或者说并表效果很烂', '3', '1', '2', '', '', '1535389710', '1535389710', null, 'wesson');
COMMIT;

-- ----------------------------
--  Table structure for `f_blogs_comment`
-- ----------------------------
DROP TABLE IF EXISTS `f_blogs_comment`;
CREATE TABLE `f_blogs_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext COMMENT '评论内容',
  `sort` int(10) DEFAULT NULL COMMENT '排序值',
  `user_id` int(11) DEFAULT NULL COMMENT '评论的用户id',
  `blogs_id` int(11) DEFAULT NULL,
  `ip` varchar(64) DEFAULT NULL COMMENT 'ip',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `os` varchar(64) DEFAULT NULL COMMENT '操作系统',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='博客评论';

-- ----------------------------
--  Records of `f_blogs_comment`
-- ----------------------------
BEGIN;
INSERT INTO `f_blogs_comment` VALUES ('1', '作者首发<img src=\"/static/front/images/arclist/6.gif\" border=\"0\" />', '1', '1', '1', '218.107.218.98', '', 'MAC', '1535389901', '1535389901', null);
COMMIT;

-- ----------------------------
--  Table structure for `f_category`
-- ----------------------------
DROP TABLE IF EXISTS `f_category`;
CREATE TABLE `f_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `sort` int(10) DEFAULT NULL COMMENT '排序值',
  `link_url` varchar(255) DEFAULT '' COMMENT '跳转地址',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='技术方向';

-- ----------------------------
--  Records of `f_category`
-- ----------------------------
BEGIN;
INSERT INTO `f_category` VALUES ('1', '博客首页', '99', '/index/1.html', '1535335786', '1535337564', null), ('2', '后端技术', '98', '', '1535335799', '1535335799', null), ('3', '前端技术', '97', '', '1535335810', '1535335810', null), ('4', '学习日记', '96', '', '1535335821', '1535335821', null), ('5', '运维管理', '95', '', '1535335834', '1535389124', null), ('6', '登录后台', '94', '/admin', '1535375292', '1535375336', null);
COMMIT;

-- ----------------------------
--  Table structure for `f_contact_us`
-- ----------------------------
DROP TABLE IF EXISTS `f_contact_us`;
CREATE TABLE `f_contact_us` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `qrcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `f_everyday_say`
-- ----------------------------
DROP TABLE IF EXISTS `f_everyday_say`;
CREATE TABLE `f_everyday_say` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COMMENT '内容',
  `recommend_time` int(11) DEFAULT NULL COMMENT '推荐时间',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='每日一句';

-- ----------------------------
--  Records of `f_everyday_say`
-- ----------------------------
BEGIN;
INSERT INTO `f_everyday_say` VALUES ('2', '这里是每日一句', '1535212800', '1535208036', '1535208036', null);
COMMIT;

-- ----------------------------
--  Table structure for `f_language_tag`
-- ----------------------------
DROP TABLE IF EXISTS `f_language_tag`;
CREATE TABLE `f_language_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT '栏目id',
  `sort` int(10) DEFAULT NULL COMMENT '排序值',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COMMENT='技术方向';

-- ----------------------------
--  Records of `f_language_tag`
-- ----------------------------
BEGIN;
INSERT INTO `f_language_tag` VALUES ('1', 'JAVA', '2', '99', '1535389264', '1535389264', null), ('2', 'PHP', '2', '99', '1535389273', '1535389273', null), ('3', 'Springboot', '2', '99', '1535389292', '1535389292', null), ('4', 'CSS', '3', '99', '1535389316', '1535389316', null), ('5', 'JavaScript', '3', '99', '1535389337', '1535389337', null), ('6', 'vue', '3', '99', '1535389346', '1535389346', null), ('7', 'ThinkPHP', '4', '99', '1535389366', '1535389366', null), ('8', 'Apache', '5', '99', '1535389379', '1535389379', null), ('9', 'Linux', '5', '99', '1535389391', '1535389391', null), ('10', 'Tomcat', '5', '99', '1535389402', '1535389402', null), ('11', 'Nginx', '5', '99', '1535389412', '1535389412', null), ('12', 'JAVA', '1', '99', '1535389421', '1535389421', null), ('13', 'PHP', '1', '99', '1535389428', '1535389428', null);
COMMIT;

-- ----------------------------
--  Table structure for `f_notice`
-- ----------------------------
DROP TABLE IF EXISTS `f_notice`;
CREATE TABLE `f_notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '公告标题',
  `content` text COMMENT '公告内容',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='公告';

-- ----------------------------
--  Records of `f_notice`
-- ----------------------------
BEGIN;
INSERT INTO `f_notice` VALUES ('2', '欢迎来到WESSON的博客首页', '热烈欢迎', '1535206668', '1535206668', null);
COMMIT;

-- ----------------------------
--  Table structure for `f_slides`
-- ----------------------------
DROP TABLE IF EXISTS `f_slides`;
CREATE TABLE `f_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` varchar(255) NOT NULL,
  `sort` int(10) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL COMMENT '跳转地址',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='轮播图';

-- ----------------------------
--  Records of `f_slides`
-- ----------------------------
BEGIN;
INSERT INTO `f_slides` VALUES ('2', '/uploads/picture/20180826/6a3687c99a65bc81784ea375ac1dc23b.jpeg', '99', '', '1535205887', '1535227321', null), ('3', '/uploads/picture/20180826/7fba7131094f82eaf8bfda866aa43fa4.jpeg', '98', 'http://www.baidu.com', '1535205903', '1535227334', null), ('4', '/uploads/picture/20180826/ec09a2847e29287763eaf394524cfd68.jpeg', '97', '', '1535206076', '1535227347', null), ('5', '/uploads/picture/20180826/b5773d128aa0f4e428d2587bc5ef58e2.jpeg', '9996', '', '1535227359', '1535227359', null);
COMMIT;

-- ----------------------------
--  Table structure for `f_today_recommend`
-- ----------------------------
DROP TABLE IF EXISTS `f_today_recommend`;
CREATE TABLE `f_today_recommend` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '公告标题',
  `content` text COMMENT '公告内容',
  `recommend_time` int(11) DEFAULT NULL COMMENT '推荐时间',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='今日推荐';

-- ----------------------------
--  Records of `f_today_recommend`
-- ----------------------------
BEGIN;
INSERT INTO `f_today_recommend` VALUES ('2', '我是推荐标题', '我是推荐内容', '1535212800', '1535207553', '1535207553', null);
COMMIT;

-- ----------------------------
--  Table structure for `f_user`
-- ----------------------------
DROP TABLE IF EXISTS `f_user`;
CREATE TABLE `f_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `password` varchar(64) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `qq` varchar(64) DEFAULT NULL,
  `we_chat` varchar(64) DEFAULT NULL COMMENT '微信号',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间，当做软件条件',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `f_user`
-- ----------------------------
BEGIN;
INSERT INTO `f_user` VALUES ('1', 'wesson', 'e10adc3949ba59abbe56e057f20f883e', '949929373@qq.com', '949929373', 'chenweixiangtt', '1535389875', '1535389875', null);
COMMIT;

-- ----------------------------
--  Table structure for `picture`
-- ----------------------------
DROP TABLE IF EXISTS `picture`;
CREATE TABLE `picture` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `md5` varchar(255) DEFAULT NULL,
  `sha1` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `picture`
-- ----------------------------
BEGIN;
INSERT INTO `picture` VALUES ('1', '/uploads/picture/20180828/5d2112296ca0d63d9a073acedc1a9d9e.jpeg', '54524ac3fa1ab7caa626d745459e9b97', 'c79288a20884109d8be12511738fa46cb34a6ab3', '1', '1535389569'), ('2', '/uploads/picture/20180828/46c6ab1b4c8d40c1a2f7bdf8f8e7e5fe.png', 'c0db682c693f14d9931b10670b414876', '9cf411d0e0fc12ced017cc0c705618ed85969cf4', '1', '1535389648');
COMMIT;

-- ----------------------------
--  Table structure for `s_param`
-- ----------------------------
DROP TABLE IF EXISTS `s_param`;
CREATE TABLE `s_param` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
