<?php
namespace app\admin\validate;
use think\Validate;

class LinksValidate extends Validate
{
    protected $rule = [
        ['name', 'unique:links', '链接已经存在']
    ];

}