<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"E:\wwwroot\join\public/../application/admin\view\profile\index.html";i:1536652016;s:67:"E:\wwwroot\join\public/../application/admin\view\common\header.html";i:1532707956;s:67:"E:\wwwroot\join\public/../application/admin\view\common\footer.html";i:1538031104;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>个人资料 -- <?php echo SYS_NAME; ?></title>
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
                        <li class="active"><a data-toggle="tab" href="#profile" aria-expanded="true">编辑资料</a>
                        </li>
                        <li class=""><a data-toggle="tab" href="#passwd-edit" aria-expanded="false">修改密码</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="profile" class="tab-pane active">
                            <div class="panel-body">
                                <form class="form-horizontal m-t" id="profileForm" method="post" action="<?php echo url('profile/index'); ?>">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">头像：</label>
                                        <div class="input-group col-sm-4">
                                            <div id="croppic" style="width:150px;height:150px;position:relative;border:1px solid "></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">昵称：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="nic_name" type="text" class="form-control" name="nic_name" value="<?php echo $user_data['nic_name']; ?>" placeholder="请输入昵称" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">姓名：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="real_name" type="text" class="form-control" name="real_name" value="<?php echo $user_data['real_name']; ?>" placeholder="请输入真实姓名" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">学院：</label>
                                        <div class="input-group col-sm-4">
                                            <select id="college_id" name="college_id" class="form-control m-b">
                                                <?php if(!empty($college)): if(is_array($college) || $college instanceof \think\Collection || $college instanceof \think\Paginator): if( count($college)==0 ) : echo "" ;else: foreach($college as $key=>$vo): ?>
                                                    <option <?php if($user_data['college_id']==$vo['id']): ?> selected="selected" <?php endif; ?> value="<?php echo $vo['id']; ?>"><?php echo $vo['college']; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">专业：</label>
                                        <div class="input-group col-sm-4">
                                            <select id="major" name="major" class="form-control m-b"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">班级：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="class" type="text" class="form-control" name="class" value="<?php echo $user_data['class']; ?>" placeholder="请输入班级" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">学号：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="stu_id" type="text" class="form-control" name="stu_id" value="<?php echo $user_data['stu_id']; ?>" placeholder="请输入学号" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">特长：</label>
                                        <div class="input-group col-sm-4">
                                            <select id="function" name="function" class="form-control m-b">
                                                <?php if(!empty($function)): if(is_array($function) || $function instanceof \think\Collection || $function instanceof \think\Paginator): if( count($function)==0 ) : echo "" ;else: foreach($function as $key=>$vo): ?>
                                                    <option <?php if($user_data['function']==$vo): ?> selected="selected" <?php endif; ?>><?php echo $vo; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">标签：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="speciality" type="text" class="form-control" name="speciality" value="<?php echo $user_data['speciality']; ?>" placeholder="请输入特长" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">介绍：</label>
                                        <div class="input-group col-sm-4">
                                            <textarea id="intro" type="text" class="form-control" name="intro" placeholder="请输入个人介绍" ><?php echo $user_data['intro']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Q&nbsp;&nbsp;Q：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="qq" type="text" class="form-control" name="qq" value="<?php echo $user_data['qq']; ?>" placeholder="请输入QQ" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">微信：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="wechat" type="text" class="form-control" name="wechat" value="<?php echo $user_data['wechat']; ?>" placeholder="请输入微信" >
                                            <input name="wechat_qrcode" id="wechat_qrcode" type="hidden"/>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary" id="qrcode-bytton"><i class="fa fa-qrcode"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">邮箱：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="email" type="email" class="form-control" name="email" value="<?php echo $user_data['email']; ?>" placeholder="请输入邮箱" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">电话：</label>
                                        <div class="input-group col-sm-4">
                                            <input id="tel" type="text" class="form-control" name="tel" value="<?php echo $user_data['tel']; ?>" placeholder="请输入电话" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">公开：</label>
                                        <div class="input-group col-sm-4">
                                            <?php if(is_array($public) || $public instanceof \think\Collection || $public instanceof \think\Paginator): if( count($public)==0 ) : echo "" ;else: foreach($public as $key=>$vo): ?>
                                            <div class="radio i-checks col-sm-6">
                                                <label>
                                                    <input type="radio" value="<?php echo $key; ?>" <?php if($key == $user_data['public']): ?>checked<?php endif; ?> name="public"><?php echo $vo; ?>
                                                </label>
                                            </div>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
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
                        <div id="passwd-edit" class="tab-pane">
                            <div class="panel-body">
                                <form class="form-horizontal m-t" id="passwdForm" method="post" action="<?php echo url('profile/passwdEdit'); ?>">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">旧密码：</label>
                                        <div class="input-group col-sm-4">
                                            <input type="password" class="form-control" name="old_password"  placeholder="请输入旧密码">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">新密码：</label>
                                        <div class="input-group col-sm-4">
                                            <input type="password" class="form-control" name="new_password"  placeholder="请输入新密码">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">重复新密码：</label>
                                        <div class="input-group col-sm-4">
                                            <input type="password" class="form-control" name="re_new_password"  placeholder="请再次输入新密码">
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
    //头像上传插件
    function croppicUp() {
        var cropperOptions = {
			uploadUrl:'<?php echo url('admin/profile/uploadHeade'); ?>',
            cropUrl:'<?php echo url('admin/profile/cropHeade'); ?>',
            modal:true
		}
		var cropperHeader = new Croppic('croppic', cropperOptions);
    }
    $(document).ready(function(){
        croppicUp();
        majorMenu();
        $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",});
        var options = {
            beforeSubmit:showStart,
            success:showSuccess
        };
        $('#profileForm').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });
        $('#passwdForm').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });
        $('#speciality').tagsinput('add', 'some tag');
        $(".bootstrap-tagsinput").addClass('col-sm-12').find('input').addClass('form-control').attr('placeholder', '输入后按 Enter');
        //专业下拉菜单
        function majorMenu() {
            var id = $('#college_id').val();
            $.post('/admin/profile/getMajor',{id:id}, function(data) {
                $('#major').empty();
                var major = data.split(",");
                for(var i=0;i<major.length;i++){
                    if('<?php echo $user_data['major']; ?>'==major[i]){
                        $('#major').append("<option selected='selected'>"+major[i]+"</option>");
                    }else{
                        $('#major').append("<option>"+major[i]+"</option>");
                    }
                }
            });
        }
        $('#college_id').on('change',function(){
            majorMenu();
        });
        //二维码
        layui.use('upload', function(){
            var upload = layui.upload;
            var uploadInst = upload.render({
                elem: '#qrcode-bytton',
                url: "<?php echo url('profile/qrcode'); ?>",
                accept: 'images',
                done: function(res){
                    $("#wechat_qrcode").val(res.data.src);
                    layer.msg("二维码上传完成");
                },
                error: function(){}
            });
        });
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