<?php
namespace app\admin\validate;
use think\Validate;

class RoleValidate extends Validate
{
    protected $rule = [
        ['role_name', 'unique:role', '角色已经存在']
    ];

}