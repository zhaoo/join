<?php
namespace app\admin\controller;
use app\admin\model\SysinfoModel;

class Sysinfo extends Base
{
    public function index() {
        if ($this->request->isAJax()) {
            $param = $this->request->param();
            $sysinfoModel = new SysinfoModel();
            $flag = $sysinfoModel->updateSysinfo($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $sysinfoModel = new SysinfoModel();
        $sysinfo = $sysinfoModel->getSysinfo();
        $sysinfo_table = array ( 
            array ( 
                'name' => '系统时间',
                'param' => date('Y-m-d H:i:s')
            ),
            array ( 
                'name' => '运行时间',
                'param' => floor((time()-strtotime("2018-5-7"))/86400) . '天'
            ),
            array ( 
                'name' => '网站域名',
                'param' => $_SERVER['SERVER_NAME']
            ),
            array ( 
                'name' => '运行目录',
                'param' => $_SERVER['DOCUMENT_ROOT']
            ),
            array ( 
                'name' => '操作系统',
                'param' => PHP_OS
            ),
            array ( 
                'name' => '运行环境',
                'param' =>  $_SERVER['SERVER_SOFTWARE']
            ),
            array ( 
                'name' => '服务器IP',
                'param' => $_SERVER['SERVER_ADDR']
            ),
            array ( 
                'name' => '服务器端口',
                'param' => $_SERVER['SERVER_PORT']
            ),
            array ( 
                'name' => 'PHP版本',
                'param' => PHP_VERSION
            ),
            array ( 
                'name' => 'ThinkPHP版本',
                'param' => THINK_VERSION
            ),
            array ( 
                'name' => SYS_NAME.'版本',
                'param' => SYS_VERSION
            ),
            array ( 
                'name' => '最大上传限制',
                'param' => ini_get('upload_max_filesize')
            )
        ); 
        $this->assign([
            'sysinfo_table'=>$sysinfo_table,
            'sysinfo'=>$sysinfo,
            'ssl'=>config('mail'),
            'debug'=>config('mail'),
        ]);
        return $this->fetch();
	}
}