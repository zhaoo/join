<?php
namespace app\admin\controller;
use app\admin\model\RoleModel;
use app\admin\model\UserModel;

class User extends Base
{
    //用户列表
    public function index() {
        if(request()->isAjax()){
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (!empty($param['searchText'])) {
                $where['user_name'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $user = new UserModel();
            $selectResult = $user->getUsersByWhere($where, $offset, $limit);
            $status = config('user_status');
            // 拼装参数
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['head'] = '<img src="' . $vo['head'] . '" width="40px" height="40px">';
                $selectResult[$key]['last_login_time'] = date('Y-m-d H:i:s', $vo['last_login_time']);
                $selectResult[$key]['status'] = $status[$vo['status']];
                if( 1 == $vo['role_id'] ){
                    $selectResult[$key]['operate'] = '';
                    continue;
                }
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }
            $return['total'] = $user->getAllUsers($where);  //总数据
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加用户
    public function userAdd() {
        if(request()->isPost()){
            $param = input('post.');
            $param['password'] = md5($param['password'] . config('salt'));
            $param['head'] = '/static/admin/images/profile_default.jpg'; // 默认头像
            $userModel = new UserModel();
            $flag = $userModel->insertUser($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $role = new RoleModel();
        $this->assign([
            'role' => $role->getRole(),
            'status' => config('user_status'),
            'teacher' => config('user_teacher'),
        ]);
        return $this->fetch();
    }

    // 批量导入用户
    public function userImport() {
        if(request()->isAjax()){
            $file = request()->file('file');
            if($file){
                $info = $file->validate(['ext'=>'xls,xlsx'])->move(ROOT_PATH . 'public' .DS.'upload'. DS . 'excel');
                if($info){
                    $path=ROOT_PATH . 'public' . DS.'upload'.DS .'excel/'.$info->getSaveName();
                    vendor("PHPExcel.PHPExcel");
                    $ext = strrchr($path, '.');
                    if($ext == '.xls'){
                        $objReader=new \PHPExcel_Reader_Excel5();
                    }else if($ext == '.xlsx'){
                        $objReader=new \PHPExcel_Reader_Excel2007();
                    }
                    $objPHPExcel = $objReader->load($path,$encode='utf-8');
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();
                    $a=0;
                    for($i=2;$i<=$highestRow;$i++){
                        $data[$a]['user_name'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                        $data[$a]['password'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                        $data[$a]['nic_name'] = '导入用户-'.date("Ymd").'-'.rand(1000,9999);
                        $a++;
                    }
                    $userModel = new UserModel();
                    $flag = $userModel->importUser($data);
                    return json(msg($flag['code'], $flag['data'], $flag['msg']));
                }else{
                    return json(msg(-1, '', $file->getError()));
                }
            }else{
                return json(msg(-1, '', '请上传Excel文件'));
            }
        }
    }

    // 编辑用户
    public function userEdit() {
        $user = new UserModel();
        if(request()->isPost()){
            $param = input('post.');
            if(empty($param['password'])){
                unset($param['password']);
            }else{
                $param['password'] = md5($param['password'] . config('salt'));
            }
            $flag = $user->editUser($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $role = new RoleModel();
        $this->assign([
            'user' => $user->getOneUser($id),
            'status' => config('user_status'),
            'teacher' => config('user_teacher'),
            'role' => $role->getRole(),
        ]);
        return $this->fetch();
    }

    // 删除用户
    public function userDel() {
        $id = input('param.id');
        $role = new UserModel();
        $flag = $role->delUser($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 拼装操作按钮
    private function makeButton($id) {
        return [
            '编辑' => [
                'auth' => 'user/useredit',
                'href' => url('user/userEdit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'user/userdel',
                'href' => "javascript:userDel(" .$id .")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}