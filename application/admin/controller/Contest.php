<?php
namespace app\admin\controller;
use app\admin\model\ContestModel;

class Contest extends Base
{
    // 竞赛列表
    public function index() {
        if(request()->isAjax()){
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (!empty($param['searchText'])) {
                $where['name'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $contest = new ContestModel();
            $selectResult = $contest->getContestsByWhere($where, $offset, $limit);
            $status = config('contest_status');
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['thumbnail'] = '<img src="' . $vo['thumbnail'] . '" width="40px" height="40px">';
                $selectResult[$key]['status'] = $status[$vo['status']];
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['os_url'] = showOperate($this->makeOsButton($vo['os_url']));
                $selectResult[$key]['url'] = showOperate($this->makeUrlButton($vo['id']));
            }
            $return['total'] = $contest->getContestsNum($where);
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加竞赛
    public function contestAdd() {
        if(request()->isPost()) {
            $param = input('post.');
            $contestModel = new ContestModel();
            $flag = $contestModel->insertContest($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
         $this->assign([
            'status' => config('contest_status')
        ]);
        return $this->fetch();
    }

    // 编辑竞赛
    public function contestEdit() {
        $contestModel = new ContestModel();
        if(request()->isPost()) {
            $param = input('post.');
            $flag = $contestModel->editContest($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $contest = $contestModel->getOneContest($id);
        $exhibition = explode(',',$contest['exhibition']);
        $this->assign([
            'contest' => $contest,
            'status' => config('contest_status'),
            'exhibition' => $exhibition,
        ]);
        return $this->fetch();
    }

    // 删除用户
    public function contestDel() {
        $id = input('param.id');
        $con = new ContestModel();
        $flag = $con->delContest($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 上传缩略图
    public function uploadThumbnail() {
        if(request()->isAjax()){
            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/contest/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/images/contest');
            if($info){
                $src =  '/upload/images/contest' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            }else{
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    // 上传展示图
    public function uploadExhibition() {
        if(request()->isAjax()){
            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/contest/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/images/contest');
            if($info){
                $src =  '/upload/images/contest' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            }else{
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    // 拼装操作按钮
    private function makeButton($id) {
        return [
            '编辑' => [
                'auth' => 'contest/contestedit',
                'href' => url('contest/contestEdit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'contest/contestdel',
                'href' => "javascript:contestDel(" .$id .")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }

    // 拼装官网链接
    private function makeOsButton($url) {
        return [
            '官网' => [
                'auth' => 'contest/index',
                'href' => $url,
                'btnStyle' => 'primary',
                'icon' => 'fa fa-chain'
            ],
        ];
    }

    // 拼装竞赛链接
    private function makeUrlButton($id) {
        return [
            '竞赛' => [
                'auth' => 'contest/index',
                'href' => url('/index/contest/index', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-chain'
            ],
        ];
    }
}
