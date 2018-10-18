<?php
namespace app\index\model;
use think\Model;

class GroupModel extends Model
{
    //获取指定组长Id的团队信息
    public function getGroupByLeaderId($id){
        return db('group')->where('leader_id',$id)->select();
    }
}