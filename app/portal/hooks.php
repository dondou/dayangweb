<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
return [
    'portal_before_assign_article'    => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '文章显示之前', // 钩子名称
        "description" => "文章显示之前", //钩子描述
        "once"        => 0 // 是否只执行一次
    ],
    'portal_admin_after_save_article' => [
        "type"        => 2,//钩子类型(默认为应用钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)
        "name"        => '后台文章保存之后', // 钩子名称
        "description" => "后台文章保存之后", //钩子描述
        "once"        => 0 // 是否只执行一次
    ],
];