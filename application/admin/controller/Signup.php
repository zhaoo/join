<?php
namespace app\admin\controller;
use app\admin\model\PublishModel;
use app\admin\model\SignupModel;
use app\admin\model\ContestModel;
use app\admin\model\UserModel;
use app\admin\model\GroupModel;

class Signup extends Base
{
    // 报名列表
    public function index() {
        if(request()->isAjax()){
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $signupModel = new SignupModel();
            $publishModel = new PublishModel();
            $userModel = new UserModel();
            $groupModel = new GroupModel();
            $where = [];
            if (!empty($param['searchText'])) {
                $where['title'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $status = config('signup_status');
            $selectResult = $signupModel->getSignupByWhere($where, $offset, $limit);
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['status'] = $status[$vo['status']];
                $publish = $publishModel->getOnePublish($vo['contest_id']);
                $selectResult[$key]['contest'] = $publish['name'];
                $group = $groupModel->getGroupById($selectResult[$key]['group_id']);
                $selectResult[$key]['group'] = showOperateLabel($this->makeLabel($group['name'])); 
            }
            $return['total'] = $signupModel->getAllsignup($where);
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加报名
    public function signupAdd() {
        $id = input('param.id');
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $param['time_signup'] = date('Y-m-d H:i:s');
            $signupModel = new SignupModel();
            $flag = $signupModel->addSignup($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $publishModel = new PublishModel();
        $pub = $publishModel->getOnePublish($id);
        $publish['id'] = $id;
        $publish['name'] = $pub['name'];
        $groupModel = new GroupModel();
        $group = $groupModel->getGroupByLeaderId(session('id'));
        $this->assign([
            'publish' => $publish,
            'group' => $group,
        ]);
        return $this->fetch();
    }

    // 编辑报名
    public function signupEdit() {
        $signupModel = new SignupModel();
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $flag = $signupModel->editSignup($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $this->assign([
            'signup' => $signupModel->getOneSignup($id),
            'status' => config('signup_status')
        ]);
        return $this->fetch();
    }

    // 删除报名
    public function signupDel() {
        $id = input('param.id');
        $signupModel = new SignupModel();
        $flag = $signupModel->delSignup($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 展示报名
    public function show() {
        $id = input('param.id');
        $signupModel = new SignupModel();
        $groupModel = new GroupModel();
        $publishModel = new PublishModel();
        $userModel = new UserModel();
        $signup = $signupModel->getOneSignup($id);
        $group = $groupModel->getGroupById($signup['group_id']);
        $memberId = explode(',',$group['member_id']);
        foreach ($memberId as $key => $vo) {
            $user = $userModel->getOneUser($memberId[$key]);
            $group['member'][$key] = $user['real_name'];
        }
        $contest = $publishModel->getOnePublish($signup['contest_id']);
        $timeStart = date('Y.m.d', strtotime($signup['time_signup']));
        $timeEnd = date('Y.m.d', strtotime($contest['time_end']));
        $signup['time'] = $timeStart.' - '.$timeEnd;
        // $qrcodeData = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        $qrcodeData = url();
        $qrcodeReturn = createQrcode($qrcodeData);
        $signup['qrcode'] = $qrcodeReturn;
        $this->assign([
            'signup' => $signup,
            'group' => $group,
            'contest' => $contest,
        ]);
        return $this->fetch();
    }

    //批量导出报名表
    public function export(){
        $signupModel = new SignupModel();
        $publishModel = new PublishModel();
        $groupModel = new GroupModel();
        $status = config('signup_status');
        $list = $signupModel->getAllSignupNone();
        foreach($list as $key=>$vo){
            $publish = $publishModel->getOnePublish($vo['contest_id']);
            $list[$key]['contest'] = $publish['name'];
            $group = $groupModel->getGroupById($vo['group_id']);
            $list[$key]['group'] = $group['name'];
            $list[$key]['status'] = $status[$vo['status']];
        }
        vendor('PHPExcel.PHPExcel');
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ID')                      
                ->setCellValue('B1', '比赛')
                ->setCellValue('C1', '名称')
                ->setCellValue('D1', '团队')
                ->setCellValue('E1', '报名时间')
                ->setCellValue('F1', '状态');
        for($i=0;$i<count($list);$i++){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.($i+2),$list[$i]['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.($i+2),$list[$i]['contest']);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.($i+2),$list[$i]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.($i+2),$list[$i]['group']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.($i+2),$list[$i]['time_signup']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.($i+2),$list[$i]['status']);
        }
        $filename = '竞赛报名表'.date('ymd',time()).'.xls';
        $objPHPExcel->getActiveSheet()->setTitle('竞赛报名表');
        header("Content-Type: application/force-download");  
        header("Content-Type: application/octet-stream");  
        header("Content-Type: application/download");  
        header('Content-Disposition:inline;filename="'.$filename.'"');  
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    // 拼装标签
    private function makeLabel($content) {
        $groupModel = new GroupModel();
        $group = $groupModel->getGroupByName($content);
        $id = $group['id'];
        return [
            $content => [
                'auth' => 'signup/index',
                'href' => 'javascript:group('.$id.')',
                'labelStyle' => 'primary',
            ]
        ];
    }

    // 拼装操作按钮
    private function makeButton($id) {
        return [
            '查看' => [
                'auth' => 'task/index',
                'href' => url('signup/show', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-eye'
            ],
            '审核' => [
                'auth' => 'signup/signupedit',
                'href' => url('signup/signupedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'signup/signupdel',
                'href' => "javascript:signupDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
