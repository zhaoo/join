<?php
namespace app\index\model;
use think\Model;

class LinksModel extends Model
{
    //获取链接
    public function getLinks() {
        $links = db('links')->select();
        return $links;
    }
}