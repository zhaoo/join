<?php
namespace app\admin\controller;
use app\admin\model\CollegeModel;

class College extends Base
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
            $collegeModel = new CollegeModel();
            $selectResult = $collegeModel->getCollegeByWhere($where, $offset, $limit);
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $major = explode(',',$selectResult[$key]['major']);
                $selectResult[$key]['major']='';
                for($index=0;$index<count($major);$index++){ 
                    $selectResult[$key]['major'] .= showOperateLabel($this->makeLabel($major[$index]));
                } 
            }
            $return['total'] = $collegeModel->getAllcollege($where);
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加学院
    public function collegeAdd() {
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $collegeModel = new CollegeModel();
            $flag = $collegeModel->addCollege($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        return $this->fetch();
    }

    // 编辑学院
    public function collegeEdit() {
        $collegeModel = new CollegeModel();
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $flag = $collegeModel->editCollege($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $this->assign([
            'college' => $collegeModel->getOneCollege($id),
        ]);
        return $this->fetch();
    }

    // 删除学院
    public function collegeDel() {
        $id = input('param.id');
        $collegeModel = new CollegeModel();
        $flag = $collegeModel->delCollege($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 拼装操作按钮
    private function makeButton($id) {
        return [
            '编辑' => [
                'auth' => 'college/collegeedit',
                'href' => url('college/collegeedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'college/collegedel',
                'href' => "javascript:collegeDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }

    // 拼装标签
    private function makeLabel($content) {
        return [
            $content => [
                'auth' => 'college/index',
                'href' => url(''),
                'labelStyle' => 'primary',
            ]
        ];
    }
}
