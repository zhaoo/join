<?php
namespace app\admin\model;
use think\Model;

class LinksModel extends Model
{
    // 确定链接表名
    protected $name = 'links';

    // 获取链接列表
    public function getLinksByWhere($where, $offset, $limit) {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    // 获取链接数量
    public function getLinksNum($where) {
        return $this->where($where)->count();
    }

    // 添加链接
    public function insertLinks($param) {
        try {
            $result =  $this->validate('LinksValidate')->save($param);
            if(false === $result) {
                return msg(-1, '', $this->getError());
            } else {
                return msg(1, url('links/index'), '添加链接成功');
            }
        } catch(PDOException $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    // 编辑链接
    public function editLinks($param) {
        try {
            $result =  $this->validate('LinksValidate')->save($param, ['id' => $param['id']]);
            if(false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else {
                return msg(1, url('links/index'), '编辑链接成功');
            }
        }catch(PDOException $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 搜索链接
    public function getOneLinks($id) {
        return $this->where('id', $id)->find();
    }

    // 删除链接
    public function delLinks($id) {
        try {
            $this->where('id', $id)->delete();
            return msg(1, '', '删除链接成功');
        } catch( PDOException $e) {
            return msg(-1, '', $e->getMessage());
        }
    }

    // 根据用户名获取链接信息
    public function findLinksByName($name) {
        return $this->where('name', $name)->find();
    }

    // 更新链接状态
    public function updateStatus($param = [], $uid) {
        try{
            $this->where('id', $uid)->update($param);
            return msg(1, '', 'ok');
        }catch (\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }

    // 根据链接检测用户数据
    public function checkLinks($userName) {
        return $this->alias('u')->join('role r', 'u.role_id = r.id')
                ->where('u.name', $userName)
                ->find();
    }
}