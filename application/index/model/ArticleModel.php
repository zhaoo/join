<?php
namespace app\index\model;
use think\Model;

class ArticleModel extends Model
{
	//获取所有文章
	public function getAllArticles() {
		$articles = db('articles')->order('post_time desc')->select();
		return $articles;
	}

	//根据竞赛获取文章
	public function getArticleByContest($id) {
		$article = db('articles')->where('contest_id',$id)->select();
		return $article;
	}

	//获取单个文章
	public function getOneArticle($id) {
		$article = db('articles')->where('id',$id)->find();
		return $article;
	}
}