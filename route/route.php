<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

return [
    "/" => "front/index/index",
    "index/:page" => "front/index/index",
    "blogs/:categoryId/[:tags]"=>"front/index/blogs",
    "blogsDetail/:id/[:page]" => "front/index/blogsDetail",
    "tags" => "front/index/tags",
    "readers" => "front/index/readers",
    "links" => "front/index/links",
    "search/[:page]" => "front/index/search",
    "/newBlog" => "front/blog/newBlog",
    "/makeBlog" => "front/blog/makeBlog",
    "/myBlog/:userId/[:page]" => "front/blog/myBlog",
];