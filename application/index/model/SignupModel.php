<?php
namespace app\index\model;
use think\Model;

class SignupModel extends Model
{
	public function addSignup($param) {
        $result =  db('signup')->insert($param);
        if(false === $result) {
            return msg(-1, '', $this->getError());
        } else {
        return msg(1, url('/index/signup/index'), '报名成功');
        }
    }
}