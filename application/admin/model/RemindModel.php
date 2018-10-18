<?php
namespace app\admin\model;
use think\Model;

class RemindModel extends Model
{

	// 确定链接表名
    protected $name = 'remind';

	//获取指定ID的提醒信息
	public function getRemindById($id){
		return $this->where('to_id',$id)->order('post_time desc')->select();
	}

    // 根据条件获取提醒数量
    public function getAllRemind($where) {
        return $this->where($where)->count();
    }

	//添加提醒
    public function insertRemind($param) {
        try{
            $result =  $this->save($param);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, '', '添加提醒成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 删除提醒
    public function delRemind($id) {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除提醒成功');

        }catch( PDOException $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}