<?php
namespace app\admin\model;
use think\Model;

class MsgModel extends Model
{

	// 确定链接表名
    protected $name = 'msg';

	//获取指定团队ID的留言信息
	public function getMsgById($id){
		return db('msg')->where('group_id',$id)->order('post_time desc')->select();
	}

    // 根据条件获取消息数量
    public function getAllMsg($where) {
        return $this->where($where)->count();
    }

	//添加消息
    public function insertMsg($param) {
        try{
            $result =  $this->save($param);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, '', '添加消息成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 删除消息
    public function delMsg($id) {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除消息成功');

        }catch( PDOException $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}