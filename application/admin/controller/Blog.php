<?php
namespace app\admin\controller;
use app\admin\model\BlogModel;
use app\admin\model\UserModel;

class Blog extends Base
{
	// 文章列表
	public function list() {
		$blogModle = new BlogModel();
		$userModel = new UserModel();
		$userId = input('param.id');
        $isAuthor = false;
		if (!$userId) {
			$userId = session('id');
            $isAuthor = true;
		}
		$articleList = $blogModle->getArticleList($userId);
		foreach($articleList as $key=>$vo){
            $articleList[$key]['post_time'] = date('Y-m-d', strtotime($vo['post_time']));
            $articleList[$key]['tags'] = explode(',',$vo['tags']);
            $user = $userModel->getOneUser($vo['user_id']);
            $articleList[$key]['user'] = $user['nic_name'];
        }
		$this->assign([
            'articleList' => $articleList,
            'isAuthor' => $isAuthor,
        ]);
		return $this->fetch();
	}

	// 文章页面
	public function article() {
		$id = input('param.id');
		$blogModle = new BlogModel();
		$blogModle->viewAdd($id);
		$article = $blogModle->getArticle($id);
		$article['tag'] = explode(',',$article['tags']);
		$this->assign([
            'article' => $article,
        ]);
		return $this->fetch();
	}

	// 添加文章
    public function articleAdd() {
        if(request()->isPost()){
            $param = input('post.');
            $param['post_time'] = date('Y-m-d H:i:s');
            $param['user_id'] = session('id');
            $blogModle = new BlogModel();
            $flag = $blogModle->addArticle($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        return $this->fetch();
    }

    // 编辑文章
    public function articleEdit() {
        $blogModle = new BlogModel();
        if(request()->isPost()){
            $param = input('post.');
            $param['post_time'] = date('Y-m-d H:i:s');
            $flag = $blogModle->editArticle($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $this->assign([
            'article' => $blogModle->getArticle($id),
        ]);
        return $this->fetch();
    }
}