<?php
namespace app\admin\model;
use think\Model;

class MessageModel extends Model
{
    // 确定链接表名
    protected $name = 'message';

    // 获取留言列表
    public function getMessageByWhere($where, $offset, $limit) {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    // 获取留言数量
    public function getMessageNum($where) {
        return $this->where($where)->count();
    }

    // 根据留言id获取留言信息
    public function getOneMessage($id) {
        return $this->where('id', $id)->find();
    }

    // 删除留言
    public function delMessage($id) {
        try {
            $this->where('id', $id)->delete();
            return msg(1, '', '删除留言成功');
        } catch( PDOException $e) {
            return msg(-1, '', $e->getMessage());
        }
    }
}