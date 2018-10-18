<?php
namespace app\admin\controller;

class Search extends Base
{
	public function index() {
		$search = input('param.search');
		$this->assign([
            'search' => $search,
        ]);
		return $this->fetch();
	}
}