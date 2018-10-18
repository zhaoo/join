<?php
namespace app\admin\controller;
use app\admin\model\PublishModel;
use app\admin\model\ContestModel;

class Publish extends Base
{
    // 发布列表
    public function index() {
        if(request()->isAjax()){
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (!empty($param['searchText'])) {
                $where['title'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $publishModel = new PublishModel();
            $contestModel = new ContestModel();
            $status = config('publish_status');
            $selectResult = $publishModel->getPublishByWhere($where, $offset, $limit);
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $conResult = $contestModel->getOneContest($vo['contest_id']);
                $selectResult[$key]['contest_id'] = $conResult['name'];
                $selectResult[$key]['status'] = $status[$vo['status']];
            }
            $return['total'] = $publishModel->getAllpublish($where);  // 总数据
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加发布
    public function publishAdd() {
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $publishModel = new PublishModel();
            $flag = $publishModel->addPublish($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $contestModel = new ContestModel();
        $this->assign([
            'con' => $contestModel->getCon(),
            'status' => config('publish_status')
        ]);
        return $this->fetch();
    }

    // 编辑发布
    public function publishEdit() {
        $publishModel = new PublishModel();
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $flag = $publishModel->editPublish($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $contestModel = new ContestModel();
        $this->assign([
            'publish' => $publishModel->getOnePublish($id),
            'con' => $contestModel->getCon(),
            'status' => config('publish_status')
        ]);
        return $this->fetch();
    }

    // 打印发布
    public function print() {
        $publishModel = new PublishModel();
        $id = input('param.id');
        $contestModel = new ContestModel();
        $this->assign([
            'publish' => $publishModel->getOnePublish($id),
        ]);
        return $this->fetch();
    }

    // 删除发布
    public function publishDel() {
        $id = input('param.id');
        $publishModel = new PublishModel();
        $flag = $publishModel->delPublish($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 拼装操作按钮
    private function makeButton($id) {
        return [
            '报名' => [
                'auth' => 'signup/signupadd',
                'href' => url('signup/signupadd', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-send'
            ],
            '打印' => [
                'auth' => 'publish/print',
                'href' => url('publish/print', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-print'
            ],
            '编辑' => [
                'auth' => 'publish/publishedit',
                'href' => url('publish/publishedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'publish/publishdel',
                'href' => "javascript:publishDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
