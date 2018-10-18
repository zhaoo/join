<?php
namespace app\admin\controller;
use app\admin\model\NodeModel;
use app\admin\model\UserModel;
use app\admin\model\RemindModel;
use app\admin\model\GroupModel;

class Index extends Base
{
    public function index(){
        $nodeModel = new NodeModel();
        $remindModel = new RemindModel();
        $userModel = new UserModel();
        $where['to_id'] = session('id');
        $remind_num = $remindModel->getAllRemind($where);
        $remind = $remindModel->getRemindById(session('id'));
        foreach($remind as $key=>$vo){
            $user = $userModel->getOneUser($vo['from_id']);
            $remind[$key]['from'] = $user['nic_name'];
            $remind[$key]['head'] = $user['head'];
            $time_dif = time() - strtotime($remind[$key]['post_time']);
            if($time_dif<60){
                $remind[$key]['time_dif'] = round($time_dif).'秒钟前'; //秒
            }elseif($time_dif<3600){
                $remind[$key]['time_dif'] = round($time_dif/60).'分钟前'; //分
            }elseif($time_dif<86400){
                $remind[$key]['time_dif'] = round($time_dif/3600).'小时前'; //时
            }elseif($time_dif<2592000){
                $remind[$key]['time_dif'] = round($time_dif/86400).'天前'; //天
            }elseif($time_dif<31104000){
                $remind[$key]['time_dif'] = round($time_dif/2592000).'月前'; //月
            }else{
                $remind[$key]['time_dif'] = round($time_dif/31104000).'年前'; //年
            }
        }
        $this->assign([
            'menu' => $nodeModel->getMenu(session('rule')),
            'remind_num' => $remind_num,
            'remind' => $remind,
        ]);
        return $this->fetch('/index');
    }

    //第一次登录补全信息
    public function isFirstLogin(){
        $user = new UserModel();
        $res = $user->getOneUser(session('id'));
        if(($res['login_times'])<5 && ($res['nic_name'])=='Null'){
        	return json(msg(-1, url('profile/index'), '请补全信息'));
        }
    }

    //清除缓存
    public function clear(){
        $R = RUNTIME_PATH;
        if ($this->_deleteDir($R)) {
            $result['info'] = '清除缓存成功!';
            $result['status'] = 1;
        } else {
            $result['info'] = '清除缓存失败!';
            $result['status'] = 0;
        }
        $result['url'] = url('admin/index/index');
        return $result;
    }

    // 删除提醒
    public function remindDel() {
        $id = input('param.id');
        $remindModel = new RemindModel();
        $flag = $remindModel->delRemind($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    private function _deleteDir($R){
        $handle = opendir($R);
        while (($item = readdir($handle)) !== false) {
            if ($item != '.' and $item != '..') {
                if (is_dir($R . '/' . $item)) {
                    $this->_deleteDir($R . '/' . $item);
                } else {
                    if (!unlink($R . '/' . $item))
                        die('error!');
                }
            }
        }
        closedir($handle);
        return rmdir($R);
    }
}
