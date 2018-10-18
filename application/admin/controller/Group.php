<?php
namespace app\admin\controller;
use app\admin\model\UserModel;
use app\admin\model\GroupModel;
use app\admin\model\MsgModel;
use app\admin\model\SignupModel;
use app\admin\model\PublishModel;
use app\admin\model\RemindModel;
use app\admin\model\TaskModel;

class Group extends Base
{
	public function index(){
		return $this->fetch();
	}
    //我的团队
    public function myGroup(){
        $id = session('id');
        $groupModel = new GroupModel();
        $userModel = new UserModel();
        $signupModel = new SignupModel();
        $msgModel = new MsgModel();
        $taskModel = new TaskModel();
        $selectResult = $groupModel->getAllGroup();
        foreach($selectResult as $key=>$vo){
            $memberId = explode(',',$selectResult[$key]['member_id']);
            $probe = 0;
            for($i=0;$i<count($memberId);$i++){ 
                if($memberId[$i] == $id){
                    $probe += 1;
                }
            }
            if($probe==0){
                unset($selectResult[$key]);
            }
        }
        foreach($selectResult as $key=>$vo){
            $memberId = explode(',',$selectResult[$key]['member_id']);
            $selectResult[$key]['member_num'] = count($memberId);
            $whereSignup['group_id'] = $selectResult[$key]['id'];
            $selectResult[$key]['contest_num'] = $signupModel->getAllSignup($whereSignup);
            $whereMsg['group_id'] = $selectResult[$key]['id'];
            $selectResult[$key]['msg_num'] = $msgModel->getAllMsg($whereMsg);
            $whereComplete['complete'] = 2;
            $whereComplete['group_id'] = $vo['id'];
            $whereAll['group_id'] = $vo['id'];
            $completeTask = $taskModel->getAllTask($whereComplete);
            $allTask = $taskModel->getAllTask($whereAll);
            $persent = round($completeTask/($allTask+0.00001)*100);
            $selectResult[$key]['persent_num'] = $persent;
            if ($persent <= 33) {
                $selectResult[$key]['bar_class'] = 'progress-bar-danger';
            } elseif ($persent <= 66) {
                $selectResult[$key]['bar_class'] = 'progress-bar-warning';
            } else {
                $selectResult[$key]['bar_class'] = '';
            }
            $selectResult[$key]['uncomplete_num'] = $allTask-$completeTask;
            $selectResult[$key]['all_num'] = $allTask;
            for($i=0;$i<count($memberId);$i++){
                $user = $userModel->getOneUser($memberId[$i]);
                $selectResult[$key]['user'][$i]['head'] = $user['head'];
                $selectResult[$key]['user'][$i]['id'] = $user['id'];
                $selectResult[$key]['user'][$i]['nic_name'] = $user['nic_name'];
            }
        }
        $this->assign([
            'group' => $selectResult,
        ]);
        return $this->fetch();
    }

    //所有团队
    public function allGroup(){
        $groupModel = new GroupModel();
        $userModel = new UserModel();
        $signupModel = new SignupModel();
        $msgModel = new MsgModel();
        $taskModel = new TaskModel();
        $selectResult = $groupModel->getAllGroup();
        foreach($selectResult as $key=>$vo){
            $memberId = explode(',',$selectResult[$key]['member_id']);
            $selectResult[$key]['member_num'] = count($memberId);
            $whereSignup['group_id'] = $selectResult[$key]['id'];
            $selectResult[$key]['contest_num'] = $signupModel->getAllSignup($whereSignup);
            $whereMsg['group_id'] = $selectResult[$key]['id'];
            $selectResult[$key]['msg_num'] = $msgModel->getAllMsg($whereMsg);
            $whereComplete['complete'] = 2;
            $whereComplete['group_id'] = $vo['id'];
            $whereAll['group_id'] = $vo['id'];
            $completeTask = $taskModel->getAllTask($whereComplete);
                        $allTask = $taskModel->getAllTask($whereAll);
            $persent = round($completeTask/($allTask+0.00001)*100);
            $selectResult[$key]['persent_num'] = $persent;
            if ($persent <= 33) {
                $selectResult[$key]['bar_class'] = 'progress-bar-danger';
            } elseif ($persent <= 66) {
                $selectResult[$key]['bar_class'] = 'progress-bar-warning';
            } else {
                $selectResult[$key]['bar_class'] = '';
            }
            $selectResult[$key]['uncomplete_num'] = $allTask-$completeTask;
            $selectResult[$key]['all_num'] = $allTask;
            for($i=0;$i<count($memberId);$i++){
                $user = $userModel->getOneUser($memberId[$i]);
                $selectResult[$key]['user'][$i]['head'] = $user['head'];
                $selectResult[$key]['user'][$i]['id'] = $user['id'];
                $selectResult[$key]['user'][$i]['nic_name'] = $user['nic_name'];
            }
        }
        $this->assign([
            'group' => $selectResult,
        ]);
        return $this->fetch();
    }

    //团队页面
    public function oneGroup(){
        $id = input('id');
        if($id){
            $groupModel = new GroupModel();
            $userModel = new UserModel();
            $msgModel = new MsgModel();
            $signupModel = new SignupModel();
            $publishModel = new PublishModel();
            $taskModel = new TaskModel();
            $hasAuth = true;
            $group = $groupModel->getGroupById($id);
            $memberId = explode(',',$group['member_id']);
            if (session('role_id') == 3) {
                $inG = 0;
                foreach ($memberId as $key => $vo) {
                    if(session('id') == $vo) {
                        $inG++;
                    }
                }
                if($inG==0) {
                    // $this->error('403 您没有权限');
                    $hasAuth = false;
                }
            }
            $inGroup = 0;
            if($group['recruit']!=1){
                $inGroup++;
            }
            $group['establish_time'] = date('Y-m-d', strtotime($group['establish_time']));
            $leader = $userModel->getOneUser($group['leader_id']);
            $group['leader']['head'] = $leader['head'];
            $group['leader']['id'] = $group['leader_id'];
            $group['leader']['name'] = $leader['nic_name'];
            $function = explode(',',$group['function']);
            for($i=0;$i<count($memberId);$i++){
                if($memberId[$i] == session('id')){
                    $inGroup++;
                }
                $user = $userModel->getOneUser($memberId[$i]);
                $group['user'][$i]['head'] = $user['head'];
                $group['user'][$i]['id'] = $user['id'];
                $group['user'][$i]['nic_name'] = $user['nic_name'];
                $group['user'][$i]['real_name'] = $user['real_name'];
                $group['user'][$i]['function'] = $function[$i];
                $group['user'][$i]['option'] = showOperate($this->makeButton($user['id'], $id));
                $where['user_id'] = $user['id'];
                $where['group_id'] = $id;
                $group['user'][$i]['all_task_count'] = $taskModel->getAllTask($where);
                $where['complete'] = 1;
                $group['user'][$i]['uncomplete_task_count'] = $taskModel->getAllTask($where);
            }
            $msg = $msgModel->getMsgById($id);
            foreach($msg as $key=>$vo){
                $user = $userModel->getOneUser($vo['user_id']);
                $msg[$key]['user_name'] = $user['nic_name'];
                $msg[$key]['head'] = $user['head'];
                $time_dif = time() - strtotime($msg[$key]['post_time']);
                if($time_dif<60){
                    $msg[$key]['time_dif'] = round($time_dif).'秒钟前'; //秒
                }elseif($time_dif<3600){
                    $msg[$key]['time_dif'] = round($time_dif/60).'分钟前'; //分
                }elseif($time_dif<86400){
                    $msg[$key]['time_dif'] = round($time_dif/3600).'小时前'; //时
                }elseif($time_dif<2592000){
                    $msg[$key]['time_dif'] = round($time_dif/86400).'天前'; //天
                }elseif($time_dif<31104000){
                    $msg[$key]['time_dif'] = round($time_dif/2592000).'月前'; //月
                }else{
                    $msg[$key]['time_dif'] = round($time_dif/31104000).'年前'; //年
                }
            }
            $myself['head'] = session('head');
            $myself['id'] = session('id');
            $myself['name'] = session('nic_name');
            $signup = $signupModel->getSignupByGroup($id);
            $status = config('signup_status');
            foreach($signup as $key=>$vo){
                $signup[$key]['status'] = $status[$vo['status']];
                $signup[$key]['time_signup'] = date('Y-m-d',strtotime($vo['time_signup']));
                $publish = $publishModel->getOnePublish($signup[$key]['contest_id']);
                $signup[$key]['time_end'] = $publish['time_end'];
                $signup[$key]['time_have'] = round((strtotime($publish['time_end'])-time())/86400).'天';
                $whereComplete['complete'] = 2;
                $whereComplete['group_id'] = $vo['group_id'];
                $whereAll['group_id'] = $vo['group_id'];
                $completeTask = $taskModel->getAllTask($whereComplete);
                $allTask = $taskModel->getAllTask($whereAll);
                if ($allTask==0) {
                    $persent = 0;
                } else {
                    $persent = round($completeTask/$allTask*100);
                }
                $signup[$key]['complete_num'] = '<div class="progress progress-mini"><div style="width: '.$persent.'%;" class="progress-bar"></div></div><small>'.$persent.'%</small>';
            }
            $this->assign([
                'group' => $group,
                'msg' => $msg,
                'myself' => $myself,
                'signup' => $signup,
                'in_group' => $inGroup,
                'has_auth' => $hasAuth,
            ]);
        }else{
            $this->error('403 没有传入团队ID');
        }
        return $this->fetch();
    }

    //编辑团队
    public function groupEdit() {
        $groupModel = new GroupModel();
        $userModel = new UserModel();
        if(request()->isPost()){
            $param = input('post.');
            $member = explode(',',$param['member']);
            $param['member_id'] = '';
            for($i=0;$i<count($member);$i++){
                $user = $userModel->getOneUserReal($member[$i]);
                $param['member_id'] .= $user['id'].',';
            }
            $param['member_id'] = rtrim($param['member_id'], ',');
            $flag = $groupModel->editGroup($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $group = $groupModel->getGroupById($id);
        if($group['leader_id'] == session('id')){
            $memberId = explode(',',$group['member_id']);
            $group['member'] = '';
            for($i=0;$i<count($memberId);$i++){
                $user[$i] = $userModel->getOneUser($memberId[$i]);
                $group['member'] .= $user[$i]['real_name'].',';
            }
            $group['member'] = rtrim($group['member'], ',');
            $this->assign([
                'group' => $group,
                'public' => config('group_public'),
                'recruit' => config('group_recruit'),
                'user' => $user,
            ]);
            return $this->fetch();
        }else{
            $this->error('403 您不是队长，没有权限编辑团队');
        }
    }

    //创建团队
    public function groupAdd() {
        if(request()->isPost()){
            $param = input('post.');
            $param['establish_time'] = date('Y-m-d H:i:s');
            $param['leader_id'] = session('id');
            $param['member_id'] = session('id');
            $groupModel = new GroupModel();
            $flag = $groupModel->insertGroup($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $this->assign([
            'public' => config('group_public'),
            'recruit' => config('group_recruit'),
        ]);
        return $this->fetch();
    }

    // 删除团队
    public function groupDel() {
        $id = input('param.id');
        $groupModel = new GroupModel();
        $flag = $groupModel->delGroup($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    //添加消息
    public function msgAdd() {
        if(request()->isPost()){
            $param = input('post.');
            $param['post_time'] = date('y-m-d H:i:s',time());
            $msgModel = new MsgModel();
            $flag = $msgModel->insertMsg($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
    }

    //删除消息
    public function msgDel() {
        $id = input('param.id');
        $msgModel = new MsgModel();
        $flag = $msgModel->delMsg($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    //招兵买马
	public function recruit(){
		$userModel = new UserModel();
		$selectResult = $userModel->getAllPublicUsers();
        $isTeacher = config('user_teacher');
		foreach($selectResult as $key=>$vo){
            $selectResult[$key]['teacher'] = $isTeacher[$vo['teacher']];
		    $speciality = explode(',',$selectResult[$key]['speciality']);
            $selectResult[$key]['speciality']='';
            for($i=0;$i<count($speciality);$i++){ 
                $selectResult[$key]['speciality'] .= showOperateLabel($this->makeLabel($speciality[$i]));
            } 
        }
        $this->assign([
            'user' => $selectResult,
            'my_email' => session('email'),
            'my_name' => session('nic_name'),
        ]);
		return $this->fetch();
	}

    // 团队排名
    public function rank() {
        $groupModel = new GroupModel();
        $userModel = new UserModel();
        $signupModel = new SignupModel();
        $taskModel = new TaskModel();
        $selectResult = $groupModel->getAllGroup();
        foreach($selectResult as $key=>$vo){
            $selectResult[$key]['establish_time'] = date('Y-m-d', strtotime($vo['establish_time']));
            $memberId = explode(',',$selectResult[$key]['member_id']);
            $selectResult[$key]['member_num'] = count($memberId);
            $whereSignup['group_id'] = $selectResult[$key]['id'];
            $selectResult[$key]['contest_num'] = $signupModel->getAllSignup($whereSignup);
            $whereMsg['group_id'] = $selectResult[$key]['id'];
            $whereComplete['complete'] = 2;
            $whereComplete['group_id'] = $vo['id'];
            $whereAll['group_id'] = $vo['id'];
            $completeTask = $taskModel->getAllTask($whereComplete);
                        $allTask = $taskModel->getAllTask($whereAll);
            $persent = round($completeTask/($allTask+0.00001)*100);
            $selectResult[$key]['persent_num'] = $persent;
            if ($persent <= 33) {
                $selectResult[$key]['bar_class'] = 'progress-bar-danger';
            } elseif ($persent <= 66) {
                $selectResult[$key]['bar_class'] = 'progress-bar-warning';
            } else {
                $selectResult[$key]['bar_class'] = '';
            }
            $selectResult[$key]['complete_num'] = $completeTask;
            $selectResult[$key]['all_num'] = $allTask;
            for($i=0;$i<count($memberId);$i++){
                $user = $userModel->getOneUser($memberId[$i]);
                $selectResult[$key]['user'][$i]['head'] = $user['head'];
                $selectResult[$key]['user'][$i]['id'] = $user['id'];
                $selectResult[$key]['user'][$i]['nic_name'] = $user['nic_name'];
            }
        }
        array_multisort(array_column($selectResult, 'complete_num'), SORT_DESC, $selectResult);
        $this->assign([
            'group' => $selectResult,
        ]);
        return $this->fetch();
    }

    //申请入队
    public function joinGroup() {
        $remindModel = new RemindModel();
        if(request()->isPost()){
            $param = input('post.');
            $param['post_time'] = date('Y-m-d H:i:s');
            $param['type'] = 2;
            $flag = $remindModel->insertRemind($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
    }

    //邀请组队
    public function recruitGroup() {
        $remindModel = new RemindModel();
        if(request()->isPost()){
            $param = input('post.');
            $param['post_time'] = date('Y-m-d H:i:s');
            $param['type'] = 1;
            $flag = $remindModel->insertRemind($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
    }

    // 接受组队邀请
    public function addMember() {
        $gid = input('param.group_id');
        $uid = input('param.user_id');
        $groupModel = new GroupModel();
        $group = $groupModel->getGroupById($gid);
        $param['member_id'] = $group['member_id'].','.$uid;
        $flag = $groupModel->updateMember($param,$gid);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

	// 拼装标签
    private function makeLabel($content) {
        return [
            $content => [
                'auth' => 'group/recruit',
                'href' => '',
                'labelStyle' => 'primary',
            ]
        ];
    }

    // 拼装操作按钮
    private function makeButton($uid, $gid) {
        return [
            '查看' => [
                'auth' => 'task/index',
                'href' => "javascript:task(".$uid.",".$gid.")",
                'btnStyle' => 'primary',
                'icon' => 'fa fa-eye'
            ]
        ];
    }
}