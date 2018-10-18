<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\ContestModel;
use app\index\model\LinksModel;
use app\index\model\MessageModel;
use app\admin\model\SysinfoModel;

class Base extends Controller
{
	public function _initialize(){
		//导航栏
		$contest = new ContestModel();
		$conMenu = $contest->getAllCon();
        $this->assign(['conMenu'=>$conMenu]);
        //留言板填充
        $session[] = '';
        if (session('nic_name')) {
            $session['nic_name'] = session('nic_name');
        }
        if (session('email')) {
            $session['email'] = session('email');
        }
		$this->assign(['session'=>$session]);
        //友情链接
        $linksClass = new LinksModel();
		$links = $linksClass->getLinks();
		$this->assign(['links'=>$links]);
        //默认不显示导航图
        $banner = false;
        //系统信息
        $sysinfoModel = new SysinfoModel();
        $sysinfo = $sysinfoModel->getSysinfo();
        define('SYS_NAME', $sysinfo['name']);
        define('SYS_DESCRIPTION', $sysinfo['description']);
        define('SYS_KEYWORDS', $sysinfo['keywords']);
        define('SYS_VERSION', $sysinfo['version']);
        //模板输出
        $this->assign(['banner'=>$banner]);
	}

    // 提交留言
    public function addMsg() {
        if(request()->isAjax()){
            $param = $this->request->param();
            if (empty($param['content'])) {
                return json(msg(-1, '', '留言失败：请输入留言内容'));
            } 
            if (empty($param['nic_name'])) {
                $param['nic_name'] = 'Anonymous';
            }
            $param['upload_times'] = time();
            $messageModel = new MessageModel();
            $flag = $messageModel->insertMsg($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
    }
}