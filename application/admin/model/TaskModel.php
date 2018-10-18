<?php
namespace app\admin\model;

use think\Model;

class TaskModel extends Model
{
    // 确定链接表名
    protected $name = 'task';

    // 查询任务
    public function getTaskByWhere($where, $offset, $limit) {
        return $this->where($where)->limit($offset, $limit)->order('complete')->select();
    }

    // 根据搜索条件获取所有的任务数量
    public function getAllTask($where) {
        return $this->where($where)->count();
    }

    // 添加任务
    public function addTask($param) {
        try{
            $result = $this->validate('TaskValidate')->save($param);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('task/index'), '添加任务成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 编辑任务
    public function editTask($param) {
        try{
            $result = $this->validate('TaskValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('task/index'), '编辑任务成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 根据任务的id获取关于的信息
    public function getOneTask($id) {
        return $this->where('id', $id)->find();
    }

    // 删除任务
    public function delTask($id) {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除任务成功');
        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
