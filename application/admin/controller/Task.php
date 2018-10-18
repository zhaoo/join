<?php
namespace app\admin\controller;
use app\admin\model\TaskModel;

class Task extends Base
{
    // 任务列表
    public function index() {
        $uid = input('uid');
        $gid = input('gid');
        if(request()->isAjax()){
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            $where['user_id'] = $param['uid'];
            $where['group_id'] = $param['gid'];
            if (!empty($param['searchText'])) {
                $where['name'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $taskModel = new TaskModel();
            $selectResult = $taskModel->getTaskByWhere($where, $offset, $limit);
            $complete = config('task_complete');
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['complete'] = showOperateLabel($this->makeLabel($complete[$vo['complete']]));
                $selectResult[$key]['have_time'] = round((strtotime($vo['complete_time'])-time())/86400).'天';
            }
            $return['total'] = $taskModel->getAllTask($where);
            $return['rows'] = $selectResult;
            return json($return);
        }
        $this->assign([
            'uid' => $uid,
            'gid' => $gid,
        ]);
        return $this->fetch();
    }

    // 编辑任务
    public function taskEdit() {
        $uid = input('uid');
        $taskModel = new TaskModel();
        if(request()->isPost()){
            $param = input('post.');
            $param['post_time'] = date('Y-m-d H:i:s');
            $flag = $taskModel->editTask($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $this->assign([
            'task' => $taskModel->getOneTask($id),
            'complete' => config('task_complete'),
        ]);
        return $this->fetch();
    }

    // 添加任务
    public function taskAdd() {
        $uid = input('uid');
        $gid = input('gid');
        if(request()->isPost()){
            $param = input('post.');
            $param['post_time'] = date('Y-m-d H:i:s');
            $taskModel = new TaskModel();
            $flag = $taskModel->addTask($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $this->assign([
            'uid' => $uid,
            'gid' => $gid,
        ]);
        return $this->fetch();
    }

    // 删除任务
    public function taskDel() {
        $id = input('param.id');
        $taskModel = new TaskModel();
        $flag = $taskModel->delTask($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 拼装操作按钮
    private function makeButton($id) {
        return [
            '编辑' => [
                'auth' => 'task/taskedit',
                'href' => url('task/taskedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'task/taskdel',
                'href' => "javascript:taskDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }

    // 拼装标签
    private function makeLabel($content) {
        $style = 'primary';
        if ($content=='未完成') {
            $style = 'danger';
        }
        return [
            $content => [
                'auth' => 'task/index',
                'href' => '',
                'labelStyle' => $style,
            ]
        ];
    }
}
