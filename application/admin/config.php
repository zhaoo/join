<?php
return [
    // 模板参数替换
    'view_replace_str' => array(
        '__CSS__'    => '/static/admin/css',
        '__JS__'     => '/static/admin/js',
        '__IMG__' => '/static/admin/images',
    ),

    // 用户状态
    'user_status' => [
        '1' => '正常',
        '2' => '禁用'
    ],

    // 用户是否是指导老师
    'user_teacher' => [
        '0' => '学生',
        '1' => '指导老师'
    ],

    // 角色状态
    'role_status' => [
        '1' => '启用',
        '2' => '禁用'
    ],

    // 竞赛状态
    'contest_status' => [
        '1' => '正常',
        '2' => '禁用'
    ],

    // 比赛状态
    'publish_status' => [
        '1' => '开启',
        '2' => '停止'
    ],

    // 比赛状态
    'signup_status' => [
        '0' => '待审核',
        '1' => '预选',
        '2' => '通过',
        '3' => '未通过'
    ],

    // 链接状态
    'links_status' => [
        '1' => '正常',
        '2' => '禁用'
    ],

    // 个人信息公开状态
    'public_status' => [
        '1' => '公开',
        '2' => '保密'
    ],

    // 团队公开状态
    'group_public' => [
        '1' => '公开',
        '2' => '保密'
    ],

    // 团队招募状态
    'group_recruit' => [
        '1' => '招募中',
        '2' => '满员'
    ],

    // 任务招募状态
    'task_complete' => [
        '1' => '未完成',
        '2' => '已完成'
    ],

    // 系统信息
    'sys_info' => [
        'name' => '竞赛加',
        'version' => '0.1.180602',
    ],
];
