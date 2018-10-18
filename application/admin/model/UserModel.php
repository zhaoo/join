<?php
namespace app\admin\model;
use think\Model;

class UserModel extends Model
{
    // 确定链接表名
    protected $name = 'user';

    // 根据搜索条件获取用户列表信息
    public function getUsersByWhere($where, $offset, $limit) {
        return $this->alias('user')
                    ->field( 'user.*,role_name')
                    ->join('role rol', 'user.role_id = ' . 'rol.id')
                    ->where($where)
                    ->limit($offset, $limit)
                    ->order('id desc')
                    ->select();
    }

    // 根据搜索条件获取所有的用户数量
    public function getAllUsers($where) {
        return $this->where($where)->count();
    }

    //获取公开用户
    public function getAllPublicUsers() {
        return $this->where('public',1)->select();
    }

    // 添加用户
    public function insertUser($param) {
        try{
            $result =  $this->validate('UserValidate')->save($param);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('user/index'), '添加用户成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 导入用户
    public function importUser($param) {
        try{
            $result =  $this->validate('UserValidate')->insertAll($param);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('user/index'), '导入用户成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 编辑用户信息
    public function editUser($param) {
        try{
            $result =  $this->validate('UserValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('user/index'), '编辑用户成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 根据用户id获取角色信息
    public function getOneUser($id) {
        return $this->where('id', $id)->find();
    }

    // 根据用户真实姓名获取角色信息
    public function getOneUserReal($real_name) {
        return $this->where('real_name', $real_name)->find();
    }

    // 删除用户
    public function delUser($id) {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除用户成功');

        }catch( PDOException $e){
            return msg(-1, '', $e->getMessage());
        }
    }

    // 根据用户名获取用户信息
    public function findUserByName($name) {
        return $this->where('user_name', $name)->find();
    }

    // 更新用户状态
    public function updateStatus($param = [], $uid) {
        try{
            $this->where('id', $uid)->update($param);
            return msg(1, '', '修改用户状态成功');
        }catch (\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }

    // 根据用户名检测用户数据
    public function checkUser($userName) {
        return $this->alias('user')
                ->field( 'user.*,role_name,rule')
                ->join('role rol', 'user.role_id = rol.id')
                ->where('user.user_name', $userName)
                ->find();
    }

    // 保存头像
    public function headSave($headUrl, $uid) {
        try{
            $this->where('id', $uid)->update(['head' => $headUrl]);
            return msg(1, '', '上传头像成功');
        }catch (\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
