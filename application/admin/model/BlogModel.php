<?php
namespace app\admin\model;

use think\Model;

class BlogModel extends Model
{
    // 确定链接表名
    protected $name = 'blog';

    // 添加文章
    public function addArticle($param) {
        try{
            $result = $this->validate('BlogValidate')->save($param);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('blog/list'), '添加文章成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 编辑文章
    public function editArticle($param) {
        try{
            $result = $this->validate('BlogValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('blog/list'), '编辑文章成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 浏览量++
    public function viewAdd($id) {
        $this->where('id', $id)->setInc('view');
    }

    // 根据文章id获取文章
    public function getArticle($id) {
        return $this->where('id', $id)->find();
    }

    // 根据用户的id获取文章列表
    public function getArticleList($id) {
        return $this->where('user_id', $id)->select();
    }

    // 删除文章
    public function delArticle($id) {
        try{
            $this->where('id', $id)->delete();
            return msg(1, '', '删除文章成功');
        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
