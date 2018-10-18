<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"E:\wwwroot\join\public/../application/admin\view\group\allgroup.html";i:1537773957;s:67:"E:\wwwroot\join\public/../application/admin\view\common\header.html";i:1532707956;s:67:"E:\wwwroot\join\public/../application/admin\view\common\footer.html";i:1538031104;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>我的团队 -- <?php echo SYS_NAME; ?></title>
	<meta name="keywords" content="<?php echo SYS_KEYWORDS; ?>">
	<meta name="description" content="<?php echo SYS_DESCRIPTION; ?>">  
	<link href="__CSS__/bootstrap.min.css?v=3.3.6" rel="stylesheet">
	<link href="__CSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">
	<link href="__CSS__/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
	<link href="__CSS__/animate.min.css" rel="stylesheet">
    <link href="__CSS__/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="__CSS__/style.min.css?v=4.1.0" rel="stylesheet">
	<link href="__CSS__/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="__JS__/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="__CSS__/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="__CSS__/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="__JS__/layui/css/layui.css"rel="stylesheet">
    <link href="__JS__/plugins/zTree/zTreeStyle.css" rel="stylesheet" type="text/css">
    <link href="/static/common/croppic/css/croppic.css" rel="stylesheet">
    <link href="__CSS__/zhaoo.css" rel="stylesheet">
    <!--[if lt IE 9]>
	<meta http-equiv="refresh" content="0;ie.html"/>
	<![endif]-->
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div class="col-sm-4">
            <div class="ibox">
                <div class="ibox-title">
                    <?php if($vo['recruit']==1): ?>
                        <span class="label label-primary pull-right">招募中</span>
                    <?php else: ?>
                        <span class="label label-warning pull-right">已满员</span>
                    <?php endif; ?>
                    <a href="<?php echo url('onegroup',array('id'=>$vo['id'])); ?>"><h5><?php echo $vo['name']; ?></h5></a>
                </div>
                <div class="ibox-content">
                    <div class="team-members">
                        <?php if(is_array($vo['user']) || $vo['user'] instanceof \think\Collection || $vo['user'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['user'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?>
                            <a href="javascript:userZone(<?php echo $voo['id']; ?>,'<?php echo $voo['nic_name']; ?>')"><img alt="member" class="img-circle" src="<?php echo $voo['head']; ?>"></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <p><?php echo $vo['intro']; ?></p>
                    <div style="padding-top: 10px">
                        <span>当前完成进度：</span>
                        <div class="stat-percent"><?php echo $vo['persent_num']; ?>%</div>
                        <div class="progress progress-mini">
                            <div style="width: <?php echo $vo['persent_num']; ?>%;" class="progress-bar <?php echo $vo['bar_class']; ?>"></div>
                        </div>
                    </div>
                    <div class="row  m-t-sm">
                        <div class="col-sm-3">
                            <div class="font-bold">比赛</div>
                            <?php echo $vo['contest_num']; ?> 个
                        </div>
                        <div class="col-sm-3">
                            <div class="font-bold">成员</div>
                            <?php echo $vo['member_num']; ?> 人
                        </div>
                        <div class="col-sm-3">
                            <div class="font-bold">消息</div>
                            <?php echo $vo['msg_num']; ?> 条
                        </div>
                        <div class="col-sm-3">
                            <div class="font-bold">任务</div>
                            <?php echo $vo['uncomplete_num']; ?>/<?php echo $vo['all_num']; ?> 个
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<script src="__JS__/contabs.js"></script>
<script src="__JS__/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="__JS__/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="__JS__/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
<script src="__JS__/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="__JS__/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="__JS__/plugins/validate/jquery.validate.min.js"></script>
<script src="__JS__/plugins/validate/messages_zh.min.js"></script>
<script src="__JS__/layui/layui.js"></script>
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/plugins/ueditor/ueditor.config.js"></script>
<script src="__JS__/plugins/ueditor/ueditor.all.js"></script>
<script src="__JS__/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="__JS__/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="__JS__/plugins/pace/pace.min.js"></script>
<script src="__JS__/plugins/suggest/bootstrap-suggest.min.js"></script>
<script src="__JS__/plugins/iCheck/icheck.min.js"></script>
<script src="__JS__/plugins/layer/laydate/laydate.js"></script>
<script src="__JS__/plugins/sweetalert/sweetalert.min.js"></script>
<script src="__JS__/plugins/layer/layer.min.js"></script>
<script src="__JS__/plugins/zTree/jquery.ztree.core-3.5.js"></script>
<script src="__JS__/plugins/zTree/jquery.ztree.excheck-3.5.js"></script>
<script src="__JS__/plugins/zTree/jquery.ztree.exedit-3.5.js"></script>
<script src="__JS__/plugins/cropper/cropper.min.js"></script>
<script src="__JS__/hplus.min.js?v=4.1.0"></script>
<script src="/static/common/croppic/js/croppic.min.js"></script>
<script>
    function userZone(id,nic_name){
        parent.layer.open({
            type: 2,
            title: false,
            closeBtn: false,
            shade: [0],
            area: ['340px', '215px'],
            offset: 'rb',
            time: 500,
            shift: 2,
            content: ['/admin/zone/index/id/'+id, 'no'],
            end: function(){
                parent.layer.open({
                    type: 2,
                    title: nic_name,
                    shadeClose: true,
                    shade: false,
                    maxmin: true, 
                    area: ['400px', '600px'],
                    content: '/admin/zone/index/id/'+id
                });
            }
        });
    }
</script>
</body>
</html>
