<?php
namespace app\admin\model;
use think\Model;

class SysinfoModel extends Model
{
	//获取系统信息
	public function getSysinfo() {
		$sysinfo = db('sysinfo')->find();
		return $sysinfo;
	}

	//更新系统信息
	public function updateSysinfo($param = []) {
        try{
            db('sysinfo')->where('id',1)->update($param);
            return msg(1, '', '修改系统设置成功');
        }catch (\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}