<?php
namespace app\admin\model;
use think\Model;

class GroupModel extends Model
{
	//确定链接表名
    protected $name = 'group';

	//获取公开团队信息
	public function getAllGroup(){
		return db('group')->where('public',1)->select();
	}

	//获取指定ID的团队信息
	public function getGroupById($id){
		return db('group')->where('id',$id)->find();
	}

    //获取指定名称的团队信息
    public function getGroupByName($name){
        return db('group')->where('name',$name)->find();
    }

    //获取指定组长Id的团队信息
    public function getGroupByLeaderId($id){
        return db('group')->where('leader_id',$id)->select();
    }

    // 更新团队成员
    public function updateMember($param = [], $id) {
        try{
            $this->where('id', $id)->update($param);
            return msg(1, url('group/mygroup'), '更新团队成员成功');
        }catch (\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }

    // 创建团队
    public function insertGroup($param) {
        try{
            $result =  $this->validate('GroupValidate')->save($param);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('group/mygroup'), '创建团队成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

	// 编辑团队
    public function editGroup($param) {
        try{
            $result =  $this->validate('GroupValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('group/mygroup'), '编辑团队成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 删除团队
    public function delGroup($id) {
        try{
            $this->where('id', $id)->delete();
            return msg(1, 'group/mygroup', '删除团队成功');
        }catch( PDOException $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}