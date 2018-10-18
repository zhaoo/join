<?php
namespace app\admin\model;

use think\Model;

class AboutModel extends Model
{
    // 确定链接表名
    protected $name = 'about';

    // 查询关于
    public function getAboutByWhere($where, $offset, $limit) {
        return $this->where($where)->limit($offset, $limit)->order('post_time desc')->select();
    }

    // 根据搜索条件获取所有的关于数量
    public function getAllAbout($where) {
        return $this->where($where)->count();
    }

    // 添加关于
    public function addAbout($param) {
        try{
            $result = $this->validate('AboutValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('about/index'), '添加关于成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 编辑关于
    public function editAbout($param) {
        try{
            $result = $this->validate('AboutValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('about/index'), '编辑关于成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 根据关于的id获取关于的信息
    public function getOneAbout($id) {
        return $this->where('id', $id)->find();
    }

    // 删除关于
    public function delAbout($id) {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除关于成功');
        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
