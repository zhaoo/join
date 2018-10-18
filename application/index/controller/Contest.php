<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\ContestModel;

class Contest extends Base
{
	public function index(){
        //渲染竞赛页面
        $id=input('id');
    	$contestModel = new ContestModel();
		$conOne = $contestModel->getOneCon($id);
        $conOne['title'] = $conOne['name']." -- 竞赛+";
		$exhibition = explode(',',$conOne['exhibition']);
		$this->assign([
			'conOne'=>$conOne,
			'exhibition' => $exhibition,
		]);
		return $this->fetch();
	}
}