<?php
namespace app\index\model;
use think\Model;

class ContestModel extends Model
{
	//获取所有竞赛
	public function getAllCon() {
		return db('contest')->select();
	}
	
	//获取单个竞赛
	public function getOneCon($id) {
		return db('contest')->where('id',$id)->find();
	}
}