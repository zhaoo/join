<?php
namespace app\admin\model;

use think\Model;

class ArticleModel extends Model
{
    // 确定链接表名
    protected $name = 'articles';

    // 查询文章
    public function getArticlesByWhere($where, $offset, $limit) {
        return $this->where($where)->limit($offset, $limit)->order('post_time desc')->select();
    }

    // 根据搜索条件获取所有的文章数量
    public function getAllArticles($where) {
        return $this->where($where)->count();
    }

    // 添加文章
    public function addArticle($param) {
        try{
            $result = $this->validate('ArticleValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('articles/index'), '添加文章成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 编辑文章信息
    public function editArticle($param) {
        try{
            $result = $this->validate('ArticleValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{
                return msg(1, url('articles/index'), '编辑文章成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    // 根据文章的id 获取文章的信息
    public function getOneArticle($id) {
        return $this->where('id', $id)->find();
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
