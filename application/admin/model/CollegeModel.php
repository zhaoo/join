<?php
namespace app\admin\model;

use think\Model;

class CollegeModel extends Model
{
    // 确定链接表名
    protected $name = 'college';

    // 查询学院
    public function getCollegeByWhere($where, $offset, $limit) {
        return $this->where($where)->limit($offset, $limit)->select();
    }

    // 根据搜索条件获取所有的学院数量
    public function getAllCollege($where) {
        return $this->where($where)->count();
    }

    // 添加学院
    public function addCollege($param) {
        try{
            $result = $this->validate('CollegeValidate')->save($param);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('college/index'), '添加成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 编辑学院
    public function editCollege($param) {
        try{
            $result = $this->validate('CollegeValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('college/index'), '编辑学院成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 根据学院的id获取学院的信息
    public function getOneCollege($id) {
        return $this->where('id', $id)->find();
    }

    //获取所有学院
    public function getAllCol() {
        return db('college')->select();
    }

    // 删除学院
    public function delCollege($id) {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除成功');
        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
