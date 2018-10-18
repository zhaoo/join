<?php
namespace app\index\model;
use think\Model;

class PublishModel extends Model
{
	//获取所有比赛
	public function getAllPublish() {
		return db('publish')->select();
	}

	//获取单个比赛
	public function getOnePublish($id) {
		return db('publish')->where('id',$id)->find();
	}

	//根据竞赛ID获取比赛
	public function getThePublish($id) {
		return db('publish')->where('contest_id',$id)->select();
	}
}