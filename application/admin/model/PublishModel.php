<?php
namespace app\admin\model;

use think\Model;

class PublishModel extends Model
{
    // 确定链接表名
    protected $name = 'publish';

    // 查询发布
    public function getPublishByWhere($where, $offset, $limit) {
        return $this->where($where)->limit($offset, $limit)->select();
    }

    // 根据搜索条件获取所有的发布数量
    public function getAllPublish($where) {
        return $this->where($where)->count();
    }

    // 添加发布
    public function addPublish($param) {
        try{
            $result = $this->validate('PublishValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('publish/index'), '发布成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 编辑发布
    public function editPublish($param) {
        try{
            $result = $this->validate('PublishValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('publish/index'), '编辑发布成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 根据发布的id 获取发布的信息
    public function getOnePublish($id) {
        return $this->where('id', $id)->find();
    }

    // 删除发布
    public function delPublish($id) {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除成功');
        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
