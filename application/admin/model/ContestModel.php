<?php
namespace app\admin\model;
use think\Model;

class ContestModel extends Model
{
    // 确定链接表名
    protected $name = 'contest';

    // 获取竞赛列表
    public function getContestsByWhere($where, $offset, $limit) {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    // 获取竞赛数量
    public function getContestsNum($where) {
        return $this->where($where)->count();
    }

    // 添加竞赛
    public function insertContest($param) {
        try {
            $result =  $this->validate('ContestValidate')->save($param);
            if(false === $result) {
                return msg(-1, '', $this->getError());
            } else {
                return msg(1, url('contest/index'), '添加竞赛成功');
            }
        } catch(PDOException $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    // 编辑竞赛
    public function editContest($param) {
        try {
            $result =  $this->validate('ContestValidate')->save($param, ['id' => $param['id']]);
            if(false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else {
                return msg(1, url('contest/index'), '编辑竞赛成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 根据竞赛id获取竞赛信息
    public function getOneContest($id) {
        return $this->where('id', $id)->find();
    }

    // 删除竞赛
    public function delContest($id) {
        try {
            $this->where('id', $id)->delete();
            return msg(1, '', '删除竞赛成功');
        } catch( PDOException $e) {
            return msg(-1, '', $e->getMessage());
        }
    }

    // 根据用户名获取竞赛信息
    public function findContestByName($name) {
        return $this->where('name', $name)->find();
    }

    // 更新竞赛状态
    public function updateStatus($param = [], $uid) {
        try{
            $this->where('id', $uid)->update($param);
            return msg(1, '', 'ok');
        }catch (\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }

    // 根据竞赛检测用户数据
    public function checkContest($userName) {
        return $this->alias('u')->join('role r', 'u.role_id = r.id')
                ->where('u.name', $userName)
                ->find();
    }

    // 获取所有竞赛
    public function getCon() {
        return $this->select();
    }
}