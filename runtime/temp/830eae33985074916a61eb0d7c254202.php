<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"E:\wwwroot\join\public/../application/admin\view\sysinfo\index.html";i:1536652029;s:67:"E:\wwwroot\join\public/../application/admin\view\common\header.html";i:1532707956;s:67:"E:\wwwroot\join\public/../application/admin\view\common\footer.html";i:1538031104;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>系统信息 -- <?php echo SYS_NAME; ?></title>
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
            <div class="col-sm-8">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#sysSetting" aria-expanded="true">系统设置</a></li>
                        <li class=""><a data-toggle="tab" href="#mailSetting" aria-expanded="false">邮件设置</a></li>
                        <li class=""><a data-toggle="tab" href="#sysInfo" aria-expanded="false">系统信息</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="sysSetting" class="tab-pane active">
                            <div class="panel-body">
                                <form class="form-horizontal m-t" id="sysSettingForm" method="post" action="<?php echo url('sysinfo/index'); ?>">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">标题：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="name" type="text" class="form-control" name="name" value="<?php echo $sysinfo['name']; ?>" placeholder="请输入标题" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">副标题：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="description" type="text" class="form-control" name="description" value="<?php echo $sysinfo['description']; ?>" placeholder="请输入副标题" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">学校名称：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="school_name" type="text" class="form-control" name="school_name" value="<?php echo $sysinfo['school_name']; ?>" placeholder="请输入学校名称" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">关键词：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="keywords" type="text" class="form-control" name="keywords" value="<?php echo $sysinfo['keywords']; ?>" placeholder="请输入关键词" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">版本：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="version" type="text" class="form-control" name="version" value="<?php echo $sysinfo['version']; ?>" placeholder="请输入版本" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">用户特长：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="user_function" type="text" class="form-control" name="user_function" value="<?php echo $sysinfo['user_function']; ?>" placeholder="请输入用户职能" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-6">
                                            <button class="btn btn-primary" type="submit">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="mailSetting" class="tab-pane">
                            <div class="panel-body">
                                <form class="form-horizontal m-t" id="mailSettingForm" method="post" action="<?php echo url('sysinfo/index'); ?>">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">地址：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="mail_host" type="text" class="form-control" name="mail_host" value="<?php echo $sysinfo['mail_host']; ?>" placeholder="请输入服务器地址" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">用户名：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="mail_username" type="text" class="form-control" name="mail_username" value="<?php echo $sysinfo['mail_username']; ?>" placeholder="请输入用户名" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">密码：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="mail_password" type="password" class="form-control" name="mail_password" value="<?php echo $sysinfo['mail_password']; ?>" placeholder="请输入密码" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">端口：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="mail_port" type="text" class="form-control" name="mail_port" value="<?php echo $sysinfo['mail_port']; ?>" placeholder="请输入端口" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">发件人邮箱：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="mail_from_address" type="text" class="form-control" name="mail_from_address" value="<?php echo $sysinfo['mail_from_address']; ?>" placeholder="请输入发件人邮箱" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">发件人昵称：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="mail_from_name" type="text" class="form-control" name="mail_from_name" value="<?php echo $sysinfo['mail_from_name']; ?>" placeholder="请输入发件人昵称" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-6">
                                            <button class="btn btn-primary" type="submit">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="sysInfo" class="tab-pane">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>名称</th>
                                        <th>参数</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty($sysinfo_table)): if(is_array($sysinfo_table) || $sysinfo_table instanceof \think\Collection || $sysinfo_table instanceof \think\Paginator): if( count($sysinfo_table)==0 ) : echo "" ;else: foreach($sysinfo_table as $key=>$vo): ?>
                                        <tr>
                                            <td><?php echo $vo['name']; ?></td>
                                            <td><?php echo $vo['param']; ?></td>
                                        </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
<script type="text/javascript">
    var index = '';
    function showStart(){
        index = layer.load(0, {shade: false});
        return true;
    }
    function showSuccess(res){
        layer.ready(function(){
            layer.close(index);
            if(1 == res.code){
                layer.alert(res.msg, {title: '友情提示', icon: 1, closeBtn: 0}, function(){
                    window.location.href = res.data;
                });
            }else if(111 == res.code){
                window.location.reload();
            }else{
                layer.msg(res.msg, {anim: 6});
            }
        });
    }
    $(document).ready(function(){
        $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",});
        var options = {
            beforeSubmit:showStart,
            success:showSuccess
        };
        $('#sysSettingForm,#mailSettingForm').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });
        $('#keywords,#user_function').tagsinput('add', 'some tag');
        $(".bootstrap-tagsinput").addClass('col-sm-12').find('input').addClass('form-control').attr('placeholder', '输入后按 Enter');
    });
    // 表单验证
    $.validator.setDefaults({
        highlight: function(e) {
            $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
        },
        success: function(e) {
            e.closest(".form-group").removeClass("has-error").addClass("has-success")
        },
        errorElement: "span",
        errorPlacement: function(e, r) {
            e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent())
        },
        errorClass: "help-block m-b-none",
        validClass: "help-block m-b-none"
    });
</script>
</body>
</html>
