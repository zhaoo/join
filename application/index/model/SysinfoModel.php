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
}