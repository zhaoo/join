<?php
namespace app\index\controller;
use app\index\model\ArticleModel;
use app\index\model\ContestModel;

class Articles extends Base
{
	//文章页面
	public function index(){
        $id = input('id');
    	$articleModel = new ArticleModel();
		$article = $articleModel->getOneArticle($id);
		$article['post_time'] = date('Y-m-d', strtotime($article['post_time']));
		$this->assign(['article'=>$article]);
		return $this->fetch();
	}

	//PV统计
	public function addPV(){
    	if(request()->isGet()){
    		$id = input('param.id');
    		db('articles')->where("id = $id")->setInc('pv');
    	}
	}

	//文章列表
	public function list(){
		$id = input('id');
		$articleModel = new ArticleModel();
		$contestModel = new ContestModel();
		if ($id) {
			$articleList = $articleModel->getArticleByContest($id);
		} else {
			$articleList = $articleModel->getAllArticles();
		}
		foreach($articleList as $key=>$vo){
                $articleList[$key]['post_time'] = date('Y-m-d', strtotime($articleList[$key]['post_time']));
                $contest = $contestModel->getOneCon($vo['contest_id']);
                $articleList[$key]['contest'] = $contest['name'];
                $articleList[$key]['contest_id'] = $contest['id'];
        }
		$this->assign(['articleList'=>$articleList]);
		return $this->fetch();
	}
}