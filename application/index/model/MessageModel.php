<?php
namespace app\index\model;
use think\Model;

class MessageModel extends Model
{
	public function insertMsg($param) {
        $result = db('message')->insert($param);
        if(false === $result) {
            return msg(-1, '', $this->getError());
        } else {
        return msg(1, url('/index/index/index'), '留言成功');
        }
    }
}