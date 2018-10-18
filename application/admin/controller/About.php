<?php
namespace app\admin\controller;
use app\admin\model\AboutModel;

class About extends Base
{
    // 关于列表
    public function index() {
        if(request()->isAjax()){
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (!empty($param['searchText'])) {
                $where['title'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $aboutModel = new AboutModel();
            $selectAbout = $aboutModel->getAboutByWhere($where, $offset, $limit);
            foreach($selectAbout as $key=>$vo){
                $selectAbout[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }
            $return['total'] = $aboutModel->getAllAbout($where);  // 总数据
            $return['rows'] = $selectAbout;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加关于
    public function aboutAdd() {
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $param['post_time'] = date('Y-m-d H:i:s');
            $aboutModel = new AboutModel();
            $flag = $aboutModel->addAbout($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        return $this->fetch();
    }

    // 编辑关于
    public function aboutEdit() {
        $about = new AboutModel();
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $param['post_time'] = date('Y-m-d H:i:s');
            $flag = $about->editAbout($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $this->assign([
            'about' => $about->getOneAbout($id),
        ]);
        return $this->fetch();
    }

    // 删除关于
    public function aboutDel() {
        $id = input('param.id');
        $aboutModel = new AboutModel();
        $flag = $aboutModel->delAbout($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 拼装操作按钮
    private function makeButton($id) {
        return [
            '编辑' => [
                'auth' => 'about/aboutedit',
                'href' => url('about/aboutedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'about/aboutdel',
                'href' => "javascript:aboutDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
