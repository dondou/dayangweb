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
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class IndexController extends HomeBaseController
{
    public function index()
    {
        return $this->fetch(':index');
    }
	public function baoming()
    {
		$data= $this->request->param();
		
		
        $rs=DB::name('baoming')->strict(false)->insertGetId($data);
		if($rs){$rf['rs']='o';}else{$rf['rs']='x';}
		return json($rf);
    }
	public function luqu()
    {
		$data= $this->request->param();
		//$data = input('post.');
		$where['name'] = $data['title'];
		//$where['sfcode'] = $data['sfcode'];
		$where['delete_time'] = 0;
        $rs=DB::name('luqu')->where($where)->find();
		if($rs!==null){$rs['rs']='o';}else{$rs['rs']='x';}
		return json($rs);
    }
}
