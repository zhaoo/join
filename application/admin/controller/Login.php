<?php
namespace app\admin\controller;
use app\admin\model\RoleModel;
use app\admin\model\UserModel;
use app\admin\model\SysinfoModel;
use think\Controller;
use org\Verify;

class Login extends Controller
{
    // 登录页面
    public function index() {
        $this->sysinfo();
        return $this->fetch('login');
    }

    // 注册页面
    public function register() {
        $this->sysinfo();
        return $this->fetch('register');
    }

    // 登录超时页面
    public function lockscreen() {
        $this->sysinfo();
        $userModel = new UserModel();
        $this->assign([
            'user' => $userModel->getOneUser(session('id')),
        ]);
        return $this->fetch('lockscreen');
    }

    // 登录操作
    public function doLogin() {
        $userName = input("param.user_name");
        $password = input("param.password");
        $code = input("param.code");
        $result = $this->validate(compact('userName', 'password', "code"), 'AdminValidate');
        if(true !== $result){
            return json(msg(-1, '', $result));
        }
        $verify = new Verify();
        if (!$verify->check($code)) {
            return json(msg(-2, '', '验证码错误'));
        }
        $userModel = new UserModel();
        $hasUser = $userModel->checkUser($userName);
        if(empty($hasUser)){
            return json(msg(-3, '', '用户不存在'));
        }
        if(md5($password . config('salt')) != $hasUser['password']){
            return json(msg(-4, '', '密码错误'));
        }
        if(1 != $hasUser['status']){
            return json(msg(-5, '', '该账号被禁用'));
        }
        session('username', $hasUser['user_name']);
        session('id', $hasUser['id']);
        session('head', $hasUser['head']);
        session('role', $hasUser['role_name']);
        session('role_id', $hasUser['role_id']);
        session('rule', $hasUser['rule']);
        session('nic_name', $hasUser['nic_name']);
        session('email', $hasUser['email']);
        // 更新管理员状态
        $param = [
            'login_times' => $hasUser['login_times'] + 1,
            'last_login_ip' => request()->ip(),
            'last_login_time' => time(),
        ];
        $res = $userModel->updateStatus($param, $hasUser['id']);
        if(1 != $res['code']){
            return json(msg(-6, '', $res['msg']));
        }
        return json(msg(1, url('index/index'), '登录成功'));
    }

    // 注册操作
    public function doRegister() {
        $userName = input("param.user_name");
        $password = input("param.password");
        $password_again = input("param.password_again");
        $code = input("param.code");
        $result = $this->validate(compact('userName', 'password', 'code'), 'AdminValidate');
        if(true !== $result){
            return json(msg(-1, '', $result));
        }
        $verify = new Verify();
        if(!$verify->check($code)){
            return json(msg(-2, '', '验证码错误'));
        }
        if(($password)!=($password_again)){
            return json(msg(-3, '', '两次输入密码不同'));
        }
        $userModel = new UserModel();
        $hasUser = $userModel->checkUser($userName);
        if($hasUser){
            return json(msg(-4, '', '用户已存在'));
        }
        $param = [
            'user_name' => $userName,
            'password' => md5($password.config('salt')),
            'nic_name' => 'Null',
            'head' => '/static/admin/images/profile_default.jpg' // 默认头像
        ];
        $res = $userModel->insertUser($param);
        if(1 != $res['code']){
            return json(msg(-5, '', $res['msg']));
        }
        return json(msg(1, url('login/index'), '注册成功'));
    }

    // 登录超时操作
    public function doLockScreen() {
        $userName = session('username');
        $password = input("param.password");
        if(empty($password)){
            return json(msg(-1,'','请输入密码'));
        }
        $userModel = new UserModel();
        $hasUser = $userModel->checkUser($userName);
        if(md5($password.config('salt')) != $hasUser['password']){
            return json(msg(-2, '', '密码错误'));
        }
        if(1 != $hasUser['status']){
            return json(msg(-3, '', '该账号被禁用'));
        }
        $param = [
            'login_times' => $hasUser['login_times'] + 1,
            'last_login_ip' => request()->ip(),
            'last_login_time' => time()
        ];
        $res = $userModel->updateStatus($param, $hasUser['id']);
        if(1 != $res['code']){
            return json(msg(-6, '', $res['msg']));
        }
        return json(msg(1, url('index/index'), '登录成功'));
    }

    // 验证码
    public function checkVerify() {
        ob_clean();
        $verify = new Verify();
        $verify->imageH = 32;
        $verify->imageW = 100;
        $verify->length = 4;
        $verify->useNoise = false;
        $verify->fontSize = 14;
        return $verify->entry();
    }

    // 退出操作
    public function loginOut() {
        session('username', null);
        session('id', null);
        session('head', null);
        session('role', null);
        session('role_id', null);
        session('rule', null);
        $this->redirect(url('index'));
    }

    //系统信息
    private function sysinfo() {
        $sysinfoModel = new SysinfoModel();
        $sysinfo = $sysinfoModel->getSysinfo();
        define('SYS_NAME', $sysinfo['name']);
        define('SYS_DESCRIPTION', $sysinfo['description']);
        define('SYS_KEYWORDS', $sysinfo['keywords']);
        define('SYS_VERSION', $sysinfo['version']);
        return $this->fetch('register');
    }
}
