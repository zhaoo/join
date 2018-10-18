<?php
namespace app\admin\controller;
use app\admin\model\MessageModel;

class Message extends Base
{
    // 留言列表
    public function index() {
        if(request()->isAjax()){
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (!empty($param['searchText'])) {
                $where['nic_name'] = ['like', '%' . $param['searchText'] . '%'];
            }
            if (session('role_id') == 3) {
                $where['nic_name'] = session('nic_name');
            }
            $msg = new MessageModel();
            $selectResult = $msg->getMessageByWhere($where, $offset, $limit);
            foreach($selectResult as $key=>$vo){ 
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['upload_times'] = date('Y-m-d H:i:s', $vo['upload_times']);
            }
            $return['total'] = $msg->getMessageNum($where);
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 删除留言
    public function messageDel() {
        $id = input('param.id');
        $msg = new MessageModel();
        $flag = $msg->delMessage($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 拼装操作按钮
    private function makeButton($id) {
        return [
            '删除' => [
                'auth' => 'message/messagedel',
                'href' => "javascript:messageDel(" .$id .")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
