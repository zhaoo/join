<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"E:\wwwroot\join\public/../application/admin\view\group\rank.html";i:1537775945;s:67:"E:\wwwroot\join\public/../application/admin\view\common\header.html";i:1532707956;s:67:"E:\wwwroot\join\public/../application/admin\view\common\footer.html";i:1538031104;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>团队排名 -- <?php echo SYS_NAME; ?></title>
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
    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>所有团队</h5>
                        <div class="ibox-tools">
                            <a href="<?php echo url('group/groupAdd'); ?>" class="btn btn-primary btn-xs">创建团队</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="project-list">
                            <?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <table class="table table-hover">
                                    <tbody>
                                        <colgroup>
                                            <col width="10%";></col>
                                            <col width="10%";></col>
                                            <col width="20%";></col>
                                            <col width="30%";></col>
                                            <col width="20%";></col>
                                        </colgroup>
                                        <tr>
                                            <td class="project-title">
                                                <a href="<?php echo url('onegroup',array('id'=>$vo['id'])); ?>"><?php echo $vo['name']; ?></a>
                                                <br/>
                                                <small>创建于 <?php echo $vo['establish_time']; ?></small>
                                            </td>
                                            <td>
                                                <strong>完成任务: <?php echo $vo['complete_num']; ?> 个</strong>
                                            </td>
                                            <td class="project-completion">
                                                    <small>当前进度： <?php echo $vo['persent_num']; ?>%</small>
                                                    <div class="progress progress-mini">
                                                        <div style="width: <?php echo $vo['persent_num']; ?>%;" class="progress-bar <?php echo $vo['bar_class']; ?>"></div>
                                                    </div>
                                            </td>
                                            <td class="project-people">
                                                <?php if(is_array($vo['user']) || $vo['user'] instanceof \think\Collection || $vo['user'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['user'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?>
                                                    <a href="javascript:userZone(<?php echo $voo['id']; ?>,'<?php echo $voo['nic_name']; ?>')"><img alt="member" class="img-circle" src="<?php echo $voo['head']; ?>"></a>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </td>
                                            <td class="project-actions">
                                                <?php if($vo['recruit']==1): ?>
                                                    <a class="btn btn-primary btn-sm">招募中</a>
                                                <?php else: ?>
                                                    <a class="btn btn-warning btn-sm">已满员</a>
                                                <?php endif; ?>
                                                <a href="<?php echo url('onegroup',array('id'=>$vo['id'])); ?>" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                </div>
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