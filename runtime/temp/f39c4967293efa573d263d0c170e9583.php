<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"E:\wwwroot\join\public/../application/admin\view\group\recruit.html";i:1537276280;s:67:"E:\wwwroot\join\public/../application/admin\view\common\header.html";i:1532707956;s:67:"E:\wwwroot\join\public/../application/admin\view\common\footer.html";i:1538031104;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>招兵买马 -- <?php echo SYS_NAME; ?></title>
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
            <?php if(is_array($user) || $user instanceof \think\Collection || $user instanceof \think\Paginator): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="col-sm-4 recruit">
                    <div class="contact-box">
                        <div class="col-sm-4">
                            <div class="text-center">
                                <a href="javascript:userZone(<?php echo $vo['id']; ?>,'<?php echo $vo['nic_name']; ?>')"><img class="img-circle m-t-xs img-responsive" src="<?php echo $vo['head']; ?>"></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="div-head">
                                <a href="javascript:userZone(<?php echo $vo['id']; ?>,'<?php echo $vo['nic_name']; ?>')"><h3><strong><?php echo $vo['nic_name']; ?></strong></h3></a>
                                <?php if($vo['teacher'] == '指导老师'): ?><small><strong><?php echo $vo['teacher']; ?></strong></small><?php endif; ?>
                            </div>
                            <div class="div-label">
                                <span class="label label-success"><?php echo $vo['function']; ?></span>&nbsp;<?php echo $vo['speciality']; ?>
                            </div>
                            <div class="div-contact">
                                <address>
                                    <a href="tencent://message/?Menu=yes&uin=<?php echo $vo['qq']; ?>"><p>QQ:&nbsp;<?php echo $vo['qq']; ?></p></a>
                                    <a href="javascript:wechatQrcode(<?php echo $vo['id']; ?>)"><p>微信:&nbsp;<?php echo $vo['wechat']; ?></p></a>
                                    <a href="#modal-form" data-toggle="modal" class="a-email"><p>E-mail:&nbsp;<?php echo $vo['email']; ?></p></a>
                                </address>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div id="modal-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal m-t" id="mailForm" method="post" action="<?php echo url('email/index'); ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">主题：</label>
                            <div class="input-group col-sm-7">
                                <input id="subject" type="text" class="form-control" name="subject" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">内容：</label>
                            <div class="input-group col-sm-7">
                                <textarea id="body" class="form-control" name="body" required="" aria-required="true"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">收件人邮箱：</label>
                            <div class="input-group col-sm-7">
                                <input id="save" type="text" class="form-control" name="save" required="" aria-required="true" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">发件人邮箱：</label>
                            <div class="input-group col-sm-7">
                                <input id="send_email" type="text" class="form-control" name="send_email" required="" aria-required="true" value="<?php echo $my_email; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">发件人昵称：</label>
                            <div class="input-group col-sm-7">
                                <input id="send_name" type="text" class="form-control" name="send_name" required="" aria-required="true" value="<?php echo $my_name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3 col-sm-offset-8">
                                <button class="btn btn-primary" type="submit">发送</button>
                            </div>
                        </div>
                    </form>
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
    //邮件发送配置
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
            }else{
                layer.msg(res.msg, {anim: 6});
            }
        });
    }
    $(document).ready(function(){
        //邮件发送
        var options = {
            beforeSubmit:showStart,
            success:showSuccess
        };
        $('#mailForm').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });
        //表单验证
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
        //收件人邮箱填充
        $('.a-email').on('click',function(){
            var email = $(this).find('p').html().slice(13);
            $('#save').val(email);
        })
        //动画效果
        $('.contact-box').each(function(){
            animationHover(this, 'pulse');
        });
    });
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
    function wechatQrcode(id){
        layer.open({
          type: 1,
          title: false,
          closeBtn: 0,
          area: '430',
          skin: 'layui-layer-nobg',
          shadeClose: true,
          content: $('#wechat-qrcode-'+id)
        });
    }
</script>
</body>
<?php if(is_array($user) || $user instanceof \think\Collection || $user instanceof \think\Paginator): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="<?php echo $vo['wechat_qrcode']; ?>" id="wechat-qrcode-<?php echo $vo['id']; ?>" border="0" style="display:none;width:auto;height:auto;max-width:200px;max-height:200px;"><?php endforeach; endif; else: echo "" ;endif; ?>
</html>
