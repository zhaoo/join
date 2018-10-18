<?php
namespace app\admin\controller;
use app\admin\model\UserModel;
use app\admin\model\CollegeModel;
use app\admin\model\GroupModel;
use app\admin\model\RemindModel;

class Zone extends Base
{
	public function index() {
		$id = input('id');
		$userModel = new UserModel();
		$collegeModel = new CollegeModel();
		$groupModel = new GroupModel();
		if(empty($id)){
			$id = session('id');
			$user = $userModel->getOneUser($id);
		}else{
			$user = $userModel->getOneUser($id);
			if($user['public']!=1){
				$id = session('id');
				$user = $userModel->getOneUser($id);
			}
		}
		$college = $collegeModel->getOneCollege($user['college_id']);
		$user['college'] = $college['college'];
        $speciality = explode(',',$user['speciality']);
        $user['speciality']='';
        for($i=0;$i<count($speciality);$i++){ 
        	$user["speciality"] .= '<span class="label label-primary">'.$speciality[$i].'</span>&nbsp;';
        }
        $group = $groupModel->getGroupByLeaderId(session('id'));
		$this->assign([
            'user' => $user,
            'my_email' => session('email'),
            'my_name' => session('nic_name'),
            'my_id' => session('id'),
            'group' => $group,
        ]);
		return $this->fetch();
	}

	public function letter() {
		$remindModel = new RemindModel();
		if(request()->isPost()){
            $param = input('post.');
            $param['post_time'] = date('Y-m-d H:i:s');
            $param['type'] = 3;
            $flag = $remindModel->insertRemind($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
	}
}