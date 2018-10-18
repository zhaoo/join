<?php
namespace app\index\model;
use think\Model;

class AboutModel extends Model
{
	//获取关于
	public function getAbout() {
		$about = db('about')->order('post_time desc')->find();
		return $about;
	}
}