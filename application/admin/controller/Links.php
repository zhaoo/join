<?php
namespace app\admin\controller;
use app\admin\model\LinksModel;

class Links extends Base
{
    // 链接列表
    public function index() {
        if(request()->isAjax()){
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (!empty($param['searchText'])) {
                $where['name'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $links = new LinksModel();
            $selectResult = $links->getLinksByWhere($where, $offset, $limit);
            $status = config('links_status');
            foreach($selectResult as $key=>$vo){ 
                $selectResult[$key]['status'] = $status[$vo['status']];
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['url'] = showOperate($this->makeUrlButton($vo['url']));
            }
            $return['total'] = $links->getLinksNum($where);
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加链接
    public function LinksAdd() {
        if(request()->isPost()) {
            $param = input('post.');
            $links = new LinksModel();
            $flag = $links->insertLinks($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
         $this->assign([
            'status' => config('links_status')
        ]);
        return $this->fetch();
    }

    // 编辑链接
    public function linksEdit() {
        $links = new LinksModel();
        if(request()->isPost()) {
            $param = input('post.');
            $flag = $links->editLinks($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $this->assign([
            'links' => $links->getOneLinks($id),
            'status' => config('links_status'),
        ]);
        return $this->fetch();
    }

    // 删除链接
    public function linksDel() {
        $id = input('param.id');
        $role = new LinksModel();
        $flag = $role->delLinks($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 拼装操作按钮
    private function makeButton($id) {
        return [
            '编辑' => [
                'auth' => 'links/linksedit',
                'href' => url('links/linksEdit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'links/linksdel',
                'href' => "javascript:linksDel(" .$id .")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }

    // 拼装友情链接
    private function makeUrlButton($url) {
        return [
            '链接' => [
                'auth' => 'links/linksedit',
                'href' => $url,
                'btnStyle' => 'primary',
                'icon' => 'fa fa-chain'
            ],
        ];
    }
}
