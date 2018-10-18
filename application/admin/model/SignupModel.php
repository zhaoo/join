<?php
namespace app\admin\model;
use think\Model;

class SignupModel extends Model
{
    // 确定链接表名
    protected $name = 'signup';

    // 查询报名
    public function getSignupByWhere($where, $offset, $limit) {
        return $this->where($where)->limit($offset, $limit)->select();
    }

    // 根据ID搜索条件获取所有的报名数量
    public function getAllSignup($where) {
        return $this->where($where)->count();
    }

    // 添加报名
    public function addSignup($param) {
        try{
            $result = $this->validate('SignupValidate')->save($param);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('signup/index'), '报名成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 编辑发布
    public function editSignup($param) {
        try{
            $result = $this->validate('SignupValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('signup/index'), '编辑报名成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 根据报名的ID获取报名的信息
    public function getOneSignup($id) {
        return $this->where('id', $id)->find();
    }

    // 获取所有报名
    public function getAllSignupNone() {
        return $this->order('contest_id desc')->select();
    }

    // 根据报名的团队ID获取报名的信息
    public function getSignupByGroup($id) {
        return $this->where('group_id', $id)->select();
    }

    // 删除报名
    public function delSignup($id) {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除成功');
        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
