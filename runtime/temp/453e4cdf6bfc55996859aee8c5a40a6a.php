<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"E:\wwwroot\join\public/../application/admin\view\login\login.html";i:1537336860;s:67:"E:\wwwroot\join\public/../application/admin\view\common\header.html";i:1532707956;s:67:"E:\wwwroot\join\public/../application/admin\view\common\footer.html";i:1538031104;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>登录 -- <?php echo SYS_NAME; ?></title>
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
<script>if(window.top !== window.self){ window.top.location = window.location;}</script>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>
                <!-- <h1 class="logo-name">+</h1> -->
                <img src="__IMG__/logo.png" class="logo-png">
            </div>
            <h3 id="err_msg">欢迎使用 <?php echo SYS_NAME; ?></h3>
            <form class="m-t" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" required="" id="user_name" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" required="" id="password" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="验证码" name="code" id="code" style="width:199px;float:left;margin-bottom:15px;"/>
                    <img id="verify" src="<?php echo url('checkVerify'); ?>" onclick="javascript:this.src='<?php echo url('checkVerify'); ?>?tm='+Math.random();" style="cursor: pointer;border-width:1px 1px 1px 0px;border-style:solid;border-color:#e5e6e7;"/>
                </div>
                <button type="button" class="btn btn-primary block full-width m-b" id="login_btn">登 录</button>
                <p class="text-muted text-center">
                    <a href="login.html#">忘记密码</a> | <a href="<?php echo url('login/register'); ?>">注册账号</a> | <a href="<?php echo url('index/index/index'); ?>">返回首页</a>
                </p>
            </form>
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
        document.onkeydown=function(event){
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if(e && e.keyCode==13){ // enter 键
                $('#login_btn').click();
            }
        };
        var lock = false;
        $(function () {
            $('#login_btn').click(function(){
                if(lock){
                    return;
                }
                lock = true;
                $('#err_msg').hide();
                $('#login_btn').removeClass('btn-success').addClass('btn-danger').val('登录中...');
                var username = $('#user_name').val();
                var password = $('#password').val();
                var code = $('#code').val();
                $.post("<?php echo url('login/doLogin'); ?>",{'user_name':username, 'password':password, 'code':code},function(data){
                    lock = false;
                    $('#login_btn').val('登录').removeClass('btn-danger').addClass('btn-success');
                    if(data.code!=1){
                        $('#verify').attr('src', '<?php echo url('checkVerify'); ?>?tm='+Math.random());
                        $('#code').val('');
                        $('#err_msg').show().html("<span style='color:red'>"+data.msg+"</span>");
                        return;
                    }else{
                        window.location.href=data.data;
                    }
                });
            });
        });
    </script>
</body>
</html>
