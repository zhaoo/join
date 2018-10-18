<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"E:\wwwroot\join\public/../application/admin\view\zone\index.html";i:1537187585;s:67:"E:\wwwroot\join\public/../application/admin\view\common\header.html";i:1532707956;s:67:"E:\wwwroot\join\public/../application/admin\view\common\footer.html";i:1538031104;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>个人页面 -- <?php echo SYS_NAME; ?></title>
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
<body class="gray-bg zone">
    <div class="wrapper wrapper-content">
        <div class="row animated fadeInRight">
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>个人页面</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right div-img">
                            <img class="img-responsive" src="<?php echo $user['head']; ?>">
                        </div>
                        <div class="ibox-content profile-content">
                            <h1><strong><?php echo $user['nic_name']; ?></strong></h1>
                            <h3><strong>基本信息：</strong></h3>
                                <p style="display: inline-block;"><strong>姓名:</strong></p>&nbsp;
                                    <div class="div-label" style="display: inline-block;"><?php echo $user['real_name']; ?></div><br>
                                <p style="display: inline-block;"><strong>专业:</strong></p>&nbsp;
                                    <div class="div-label" style="display: inline-block;"><?php echo $user['college']; ?>&nbsp;-&nbsp;<?php echo $user['major']; ?>&nbsp;-&nbsp;<?php echo $user['class']; ?></div><br>
                                <p style="display: inline-block;"><strong>学号:</strong></p>&nbsp;
                                    <div class="div-label" style="display: inline-block;"><?php echo $user['stu_id']; ?></div>
                            <h3><strong>个人特长：</strong></h3>
                                <div class="div-label"><span class="label label-success"><?php echo $user['function']; ?></span>&nbsp;<?php echo $user['speciality']; ?></div>
                                <p><?php echo $user['intro']; ?></p>
                            <h3><strong>联系方式：</strong></h3>
                                <p><li class="fa fa-qq"></li>&nbsp;<?php echo $user['qq']; ?></p>
                                <p><li class="fa fa-wechat"></li>&nbsp;<?php echo $user['wechat']; ?></p>
                                <p><li class="fa fa-envelope"></li>&nbsp;<?php echo $user['email']; ?></p>
                                <p><li class="fa fa-phone"></li>&nbsp;<?php echo $user['tel']; ?></p>
                            <div class="user-button">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-primary btn-sm btn-block" id="blog"><i class="fa fa-file-text-o"></i> 博客</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-primary btn-sm btn-block" id="contact"><i class="fa fa-link"></i> 联系</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-primary btn-sm btn-block" id="group"><i class="fa fa-users"></i> 组队</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-email" class="modal fade" aria-hidden="true">
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
                                <input id="save" type="text" class="form-control" name="save" required="" aria-required="true" value="<?php echo $user['email']; ?>">
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
    <div id="modal-recruit-group" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal m-t" id="groupForm" method="post" action="<?php echo url('group/recruitgroup'); ?>">
                        <input type="hidden" name="to_id" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="from_id" value="<?php echo $my_id; ?>">
                        <input type="hidden" name="title" value="邀请入队">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">主题：</label>
                            <div class="input-group col-sm-7">
                                <input type="text" class="form-control" required="" aria-required="true" value="邀请入队" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">团队：</label>
                            <div class="input-group col-sm-7">
                                <select id="group_id" name="group_id" class="form-control m-b">
                                    <?php if(!empty($group)): if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): if( count($group)==0 ) : echo "" ;else: foreach($group as $key=>$vo): ?>
                                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">留言：</label>
                            <div class="input-group col-sm-7">
                                <textarea id="contant" class="form-control" name="contant" required="" aria-required="true"></textarea>
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
    <div id="modal-letter" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal m-t" id="letterForm" method="post" action="<?php echo url('zone/letter'); ?>">
                        <input type="hidden" name="to_id" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="from_id" value="<?php echo $my_id; ?>">
                        <input type="hidden" name="title" value="私信">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">主题：</label>
                            <div class="input-group col-sm-7">
                                <input type="text" class="form-control" required="" aria-required="true" value="私信" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">内容：</label>
                            <div class="input-group col-sm-7">
                                <textarea id="contant" class="form-control" name="contant" required="" aria-required="true"></textarea>
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
        $('#groupForm').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });
        $('#letterForm').submit(function(){
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
        //联系按钮
        $("#contact").click(function(){ 
            var index = layer.open({
                title: '联系',
                skin: 'layui-layer-molv',
                closeBtn: 0,
                area: '380px',
                shadeClose: true,
                btn: ['<li class="fa fa-qq"></li>&nbsp;QQ', '<li class="fa fa-wechat"></li>&nbsp;微信', '<li class="fa fa-envelope"></li>&nbsp;邮件','<li class="fa fa-send"></li>&nbsp;私信'],
                yes: function(index, layero){
                    layer.close(index);
                    window.location.href = 'tencent://message/?Menu=yes&uin='+'<?php echo $user['qq']; ?>';
                },
                btn2: function(index, layero){
                    layer.open({
                      type: 1,
                      title: false,
                      closeBtn: 0,
                      area: '430',
                      skin: 'layui-layer-nobg',
                      shadeClose: true,
                      content: $('#wechat-qrcode')
                    });
                },
                btn3: function(index, layero){
                    layer.close(index);
                }
            });
            $("div[class='layui-layer-btn']").css({"text-align":"center"});
            $("a[class^='layui-layer-btn']").css({"color":"#ffffff","background":"#009f95"});
            $("a[class='layui-layer-btn2']").attr({"href":"#modal-email","data-toggle":"modal"}); 
            $("a[class='layui-layer-btn3']").attr({"href":"#modal-letter","data-toggle":"modal"});
        });
        //组队按钮
        $("#group").click(function(){ 
            var index = layer.open({
                title: '组队',
                skin: 'layui-layer-molv',
                closeBtn: 0,
                shadeClose: true,
                btn: ['邀请入队'],
                yes: function(index, layero){
                    layer.close(index);
                }
            });
            $("div[class='layui-layer-btn']").css({"text-align":"center"});
            $("a[class^='layui-layer-btn']").css({"color":"#ffffff","background":"#009f95"});
            $("a[class='layui-layer-btn0']").attr({"href":"#modal-recruit-group","data-toggle":"modal"});
        });
        //博客按钮
        $("#blog").click(function(){
            window.location.href = "<?php echo url('admin/blog/list'); ?>"+"?id="+"<?php echo $user['id']; ?>";
        });
    });
</script>
</body>
<!-- 微信二维码 -->
<img src="<?php echo $user['wechat_qrcode']; ?>" id="wechat-qrcode" border="0" style="display:none;width:auto;height:auto;max-width:200px;max-height:200px;">
</html>