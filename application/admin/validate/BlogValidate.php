<?php
namespace app\admin\validate;
use think\Validate;

class BlogValidate extends Validate
{
    protected $rule = [
        ['title', 'require', '文章标题不能为空'],
    ];

}