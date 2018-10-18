<?php
namespace app\index\controller;
use app\index\model\ContestModel;

class Index extends Base
{
    public function index() {
        $banner = true;
        $contestModel = new ContestModel();
        $contest = $contestModel->getAllCon();
        $exhibition[] = '';
        foreach($contest as $key=>$vo){
        	$exhibitionOne[$key] = explode(',',$vo['exhibition']);
        	$exhibition = array_merge($exhibition, $exhibitionOne[$key]);
        }
        $this->assign([
        	'banner' => $banner,
        	'exhibition' => $exhibition,
    	]);
        return $this->fetch();
    }
}
