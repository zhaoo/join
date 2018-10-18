<?php
namespace app\admin\controller;
use app\admin\model\ArticleModel;
use app\admin\model\ContestModel;

class Articles extends Base
{
    // 文章列表
    public function index() {
        if(request()->isAjax()){
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (!empty($param['searchText'])) {
                $where['title'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $article = new ArticleModel();
            $con = new ContestModel();
            $selectResult = $article->getArticlesByWhere($where, $offset, $limit);
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['thumbnail'] = '<img src="' . $vo['thumbnail'] . '" width="40px" height="40px">';
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $conResult = $con->getOneContest($vo['contest_id']);
                $selectResult[$key]['contest_id'] = $conResult['name'];
                $selectResult[$key]['url'] = showOperate($this->makeUrlButton($vo['id']));
            }
            $return['total'] = $article->getAllArticles($where);  // 总数据
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加文章
    public function articleAdd() {
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $param['post_time'] = date('Y-m-d H:i:s');
            $article = new ArticleModel();
            $flag = $article->addArticle($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $con = new ContestModel();
        $this->assign([
            'con' => $con->getCon()
        ]);
        return $this->fetch();
    }

    // 编辑文章
    public function articleEdit() {
        $article = new ArticleModel();
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $param['post_time'] = date('Y-m-d H:i:s');
            $flag = $article->editArticle($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $con = new ContestModel();
        $this->assign([
            'article' => $article->getOneArticle($id),
            'con' => $con->getCon()
        ]);
        return $this->fetch();
    }

    // 删除文章
    public function articleDel() {
        $id = input('param.id');
        $article = new ArticleModel();
        $flag = $article->delArticle($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 上传缩略图
    public function uploadImg() {
        if(request()->isAjax()){
            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/images/articles');
            if($info){
                $src =  '/upload/images/articles' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            }else{
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    // 拼装操作按钮
    private function makeButton($id) {
        return [
            '编辑' => [
                'auth' => 'articles/articleedit',
                'href' => url('articles/articleedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'articles/articledel',
                'href' => "javascript:articleDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }

    // 拼装文章链接
    private function makeUrlButton($id) {
        return [
            '文章' => [
                'auth' => 'articles/articleedit',
                'href' => "javascript:articleUrl(".$id.")",
                'btnStyle' => 'primary',
                'icon' => 'fa fa-chain'
            ],
        ];
    }
}
