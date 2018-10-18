<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\RoleModel;
use app\admin\model\SysinfoModel;
use app\admin\model\UserModel;

class Base extends Controller
{
    public function _initialize()
    {
        //检查登录
        if(empty(session('username')) || empty(session('id'))){
            $loginUrl = url('login/index');
            if(request()->isAjax()){
                return msg(111, $loginUrl, '登录超时');
            }
            $this->redirect($loginUrl);
        }
        //检查登录超时
        $userModel = new UserModel();
        $user = $userModel->getOneUser(session('id'));
        if((time()-$user['last_login_time'])>3600){
            $lockScreenUrl = url('login/lockscreen');
            if(request()->isAjax()){
                return msg(111, $lockScreenUrl, '登录超时');
            }
            $this->redirect($lockScreenUrl);
        }
        //检查缓存
        $this->cacheCheck();
        //检测权限
        $control = lcfirst(request()->controller());
        $action = lcfirst(request()->action());
        if(empty(authCheck($control . '/' . $action))){
            if(request()->isAjax()){
                return msg(403, '', '您没有权限');
            }
            $this->error('403 您没有权限');
        }
        //系统信息
        $sysinfoModel = new SysinfoModel();
        $sysinfo = $sysinfoModel->getSysinfo();
        define('SYS_NAME', $sysinfo['name']);
        define('SYS_DESCRIPTION', $sysinfo['description']);
        define('SYS_KEYWORDS', $sysinfo['keywords']);
        define('SYS_VERSION', $sysinfo['version']);
        $this->assign([
            'head'     => session('head'),
            'nic_name' => session('nic_name'),
            'rolename' => session('role')
        ]);
    }

    private function cacheCheck()
    {
        $action = cache(session('role_id'));
        if(is_null($action) || empty($action)){
            // 获取该管理员的角色信息
            $roleModel = new RoleModel();
            $info = $roleModel->getRoleInfo(session('role_id'));
            cache(session('role_id'), $info['action']);
        }
    }

    protected function removRoleCache()
    {
        $roleModel = new RoleModel();
        $roleList = $roleModel->getRole();
        foreach ($roleList as $value) {
            cache($value['id'], null);
        }
    }
}
