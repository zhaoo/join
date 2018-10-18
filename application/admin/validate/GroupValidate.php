<?php
namespace app\admin\validate;
use think\Validate;

class GroupValidate extends Validate
{
    protected $rule = [
        ['name', 'unique:group', '团队名称已经存在']
    ];
}