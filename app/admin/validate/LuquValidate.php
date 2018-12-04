<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\validate;

use think\Validate;

class LuquValidate extends Validate
{
    protected $rule = [
        'xueid' => 'require',
        'name' => 'require',
		'sfcode'    => ['/(^\d(15)$)|((^\d{18}$))|(^\d{17}(\d|X|x)$)/'],
        'phone'     => ['/^1[34578]\d{9}$/'],
    ];

    protected $message = [
        'xueid.require' => '学号必填',
        'name.require' => '分类名称必须',
        'sfcode'    => '非法身份证号，请仔细核实',
        'phone'     => '电话格式不正确',
    ];

    protected $scene = [
        'add'  => ['name'],
        'edit' => ['name'],
    ];
}