<?php
namespace app\index\controller;
use app\index\model\AboutModel;

class About extends Base
{
	//关于页面
	public function index(){
    	$aboutModel = new AboutModel();
		$about = $aboutModel->getAbout();
		$about['post_time'] = date('Y-m-d', strtotime($about['post_time']));
		$this->assign(['about'=>$about]);
		return $this->fetch();
	}
}
