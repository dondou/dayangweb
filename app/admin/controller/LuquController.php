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
namespace app\admin\controller;

use app\admin\model\LuquModel;
use cmf\controller\AdminBaseController;
use think\Db;

class LuquController extends AdminBaseController
{

    /**
     * 记录列表
     * @adminMenu(
     *     'name'   => '记录管理',
     *     'parent' => 'admin/Setting/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 40,
     *     'icon'   => '',
     *     'remark' => '记录管理',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        $luquPostModel = new LuquModel();
        $luqus         = $luquPostModel->where(['delete_time' => ['eq', 0]])->select();
        $this->assign('luqus', $luqus);
        return $this->fetch();
    }

    /**
     * 添加记录
     * @adminMenu(
     *     'name'   => '添加记录',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加记录',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 添加记录提交
     * @adminMenu(
     *     'name'   => '添加记录提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加记录提交',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {
        $data           = $this->request->param();
        $luquPostModel = new LuquModel();
        $result         = $luquPostModel->validate(true)->save($data);
        if ($result === false) {
            $this->error($luquPostModel->getError());
        }
        $this->success("添加成功！", url("luqu/index"));
    }

    /**
     * 编辑记录
     * @adminMenu(
     *     'name'   => '编辑记录',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑记录',
     *     'param'  => ''
     * )
     */
    public function edit()
    {
        $id             = $this->request->param('id');
        $luquPostModel = new LuquModel();
        $result         = $luquPostModel->where('id', $id)->find();
        $this->assign('result', $result);
        return $this->fetch();
    }

    /**
     * 编辑记录提交
     * @adminMenu(
     *     'name'   => '编辑记录提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑记录提交',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {
        $data           = $this->request->param();
        $luquPostModel = new LuquModel();
        $result         = $luquPostModel->validate(true)->save($data, ['id' => $data['id']]);
        if ($result === false) {
            $this->error($luquPostModel->getError());
        }
        $this->success("保存成功！", url("luqu/index"));
    }

    /**
     * 删除记录
     * @adminMenu(
     *     'name'   => '删除记录',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除记录',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $id             = $this->request->param('id', 0, 'intval');
        $luquPostModel = new LuquModel();
        $result       = $luquPostModel->where(['id' => $id])->find();
        if (empty($result)){
            $this->error('记录不存在!');
        }

        //如果存在页面。则不能删除。
        //$slidePostCount = Db::name('slide_item')->where('slide_id', $id)->count();
        //if ($slidePostCount > 0) {
        //    $this->error('此记录有页面无法删除!');
        //}

        $data         = [
            'object_id'   => $id,
            'create_time' => time(),
            'table_name'  => 'luqu',
            'name'        => $result['name']
        ];

        $resultLuqu = $luquPostModel->save(['delete_time' => time()], ['id' => $id]);
        if ($resultLuqu) {
            Db::name('recycleBin')->insert($data);
        }
        $this->success("删除成功！", url("luqu/index"));
    }
}