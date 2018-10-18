<?php
namespace app\index\controller;
use app\index\model\PublishModel;
use app\index\model\SignupModel;
use app\index\model\GroupModel;

class Signup extends Base
{
    public function index() {
        $id=input('id');
	    $publishModel = new PublishModel();
        $groupModel = new GroupModel();
        $group = $groupModel->getGroupByLeaderId(session('id'));
	    $this->assign([
				'contest' => $publishModel->getAllPublish(),
                'thisContest' => $publishModel->getThePublish($id),
                'group' => $group,
		]);
	    return $this->fetch();
    }

    public function addSignup() {
    	if(request()->isAjax()){
            $param = $this->request->param();
            $param['time_signup'] = date('Y-m-d H:i:s');
            $param['header_id'] = session('id');
            if (empty($param['header_id'])) {
                return json(msg(-1, '', '报名失败：请登录'));
            }
            if (empty($param['name'])) {
                return json(msg(-1, '', '报名失败：请输入比赛名称'));
            }
            if (empty($param['contest_id'])) {
                return json(msg(-1, '', '报名失败：请选择竞赛类别'));
            }
            if (empty($param['group_id'])) {
                return json(msg(-1, '', '报名失败：请选择团队'));
            }
            $signupModel = new SignupModel();
            $flag = $signupModel->addSignup($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
    }
}
