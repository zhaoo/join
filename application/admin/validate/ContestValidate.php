<?php
namespace app\admin\validate;
use think\Validate;

class ContestValidate extends Validate
{
    protected $rule = [
        ['name', 'unique:contest', '管理员已经存在']
    ];
}