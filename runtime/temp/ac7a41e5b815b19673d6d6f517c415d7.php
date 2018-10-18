<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"E:\wwwroot\join\public/../application/admin\view\group\onegroup.html";i:1537773935;s:67:"E:\wwwroot\join\public/../application/admin\view\common\header.html";i:1532707956;s:67:"E:\wwwroot\join\public/../application/admin\view\common\footer.html";i:1538031104;}*/ ?>
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
<body class="gray-bg one-group">
    <div class="row">
        <div class="col-sm-9">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="m-b-md">
                                    <?php if($group['leader_id'] == $myself['id']): ?><a href="javascript:groupDel(<?php echo $group['id']; ?>)" class="btn btn-danger btn-xs pull-right">删除团队</a><a href="<?php echo url('groupedit',array('id'=>$group['id'])); ?>" class="btn btn-primary btn-xs pull-right">编辑团队</a>
                                    <?php endif; if($in_group==0): ?><a href="#modal-join-group" class="btn btn-primary btn-xs pull-right" data-toggle="modal">申请入队</a><?php endif; ?>
                                    <h2 class="text-center"><?php echo $group['name']; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <dl class="dl-horizontal">
                                    <dt>组长：</dt>
                                    <dd class="project-people">
                                        <a href="javascript:userZone(<?php echo $group['leader']['id']; ?>,'<?php echo $group['leader']['name']; ?>')">
                                            <img alt="leader" class="img-circle" src="<?php echo $group['leader']['head']; ?>">
                                        </a>
                                    </dd>
                                    <dt>成员：</dt>
                                    <dd class="project-people">
                                        <?php if(is_array($group['user']) || $group['user'] instanceof \think\Collection || $group['user'] instanceof \think\Paginator): $i = 0; $__LIST__ = $group['user'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                            <a href="javascript:userZone(<?php echo $vo['id']; ?>,'<?php echo $vo['nic_name']; ?>')">
                                                <img alt="member" class="img-circle" src="<?php echo $vo['head']; ?>">
                                            </a>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-sm-6" id="cluster_info">
                                <dl class="dl-horizontal">
                                    <dt>状态：</dt>
                                    <dd>                        
                                        <?php if($group['recruit']==1): ?>
                                            <span class="label label-primary">招募中</span>
                                        <?php else: ?>
                                            <span class="label label-warning">已满员</span>
                                        <?php endif; ?>
                                    </dd>
                                    <dt>成立：</dt>
                                    <dd><?php echo $group['establish_time']; ?></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <dl class="dl-horizontal">
                                    <dt>简介：</dt>
                                    <dd><?php echo $group['intro']; ?></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row m-t-sm">
                            <div class="col-sm-12">
                                <div class="panel blank-panel">
                                    <div class="panel-heading">
                                        <div class="panel-options">
                                            <ul class="nav nav-tabs">
                                                <li><a href="project_detail.html#tab-1" data-toggle="tab">团队消息</a></li>
                                                <li class=""><a href="project_detail.html#tab-2" data-toggle="tab">竞赛列表</a></li>
                                                <li class=""><a href="project_detail.html#tab-3" data-toggle="tab">任务列表</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-1">
                                                <div class="feed-activity-list">
                                                    <?php if($has_auth == true): if(is_array($msg) || $msg instanceof \think\Collection || $msg instanceof \think\Paginator): $i = 0; $__LIST__ = $msg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                            <div class="feed-element">
                                                                <a href="javascript:userZone(<?php echo $vo['user_id']; ?>,'<?php echo $vo['user_name']; ?>')" class="pull-left">
                                                                    <img alt="member" class="img-circle" src="<?php echo $vo['head']; ?>">
                                                                </a>
                                                                <div class="media-body ">
                                                                    <small class="pull-right"><?php echo $vo['time_dif']; ?></small>
                                                                    <strong><?php echo $vo['user_name']; ?></strong>
                                                                    <br>
                                                                    <small class="text-muted"><?php echo $vo['post_time']; ?></small>
                                                                    <div class="well"><?php echo $vo['contant']; ?></div>
                                                                    <div class="pull-right">
                                                                        <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> 点赞 </a>
                                                                        <a class="btn btn-xs btn-primary"><i><strong>@</strong></i> 回复</a>
                                                                        <?php if($vo['user_id'] == $myself['id']): ?><a class="btn btn-xs btn-warning" href="javascript:msgDel(<?php echo $vo['id']; ?>)"><i class="fa fa-close"></i> 删除</a><?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; endif; else: echo "" ;endif; else: ?>
                                                        <div class="alert alert-danger">抱歉，您没有权限查看该内容！</div>
                                                    <?php endif; ?>
                                                    <div class="feed-element">
                                                        <form class="form-horizontal m-t" id="msgForm" method="post" action="<?php echo url('group/msgadd'); ?>">
                                                            <input type="hidden" name="user_id" value="<?php echo $myself['id']; ?>">
                                                            <input type="hidden" name="group_id" value="<?php echo $group['id']; ?>">
                                                            <a href="javascript:userZone(<?php echo $myself['id']; ?>,'<?php echo $myself['name']; ?>')" class="pull-left">
                                                                <img alt="member" class="img-circle" src="<?php echo $myself['head']; ?>">
                                                            </a>
                                                            <div class="media-body group-body-msg">
                                                                <textarea class="form-control group-msg" placeholder="填写留言..." required="" aria-required="true" id="contant" name="contant"></textarea>
                                                            </div>
                                                            <div class="pull-right">
                                                                <button class="btn btn-xs btn-primary" type="submit"><i class="fa fa-send"></i> 发送</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab-2">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>竞赛</th>
                                                            <th>进度</th>
                                                            <th>状态</th>
                                                            <th>报名时间</th>
                                                            <th>结束时间</th>
                                                            <th>剩余时间</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(is_array($signup) || $signup instanceof \think\Collection || $signup instanceof \think\Paginator): $i = 0; $__LIST__ = $signup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $vo['name']; ?>
                                                                </td>
                                                                <td><?php echo $vo['complete_num']; ?></td>
                                                                <td>
                                                                    <span class="label label-primary"> <?php echo $vo['status']; ?></span>
                                                                </td>
                                                                <td>
                                                                    <?php echo $vo['time_signup']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $vo['time_end']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $vo['time_have']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="tab-3">
                                                <?php if($has_auth == true): ?>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>成员</th>
                                                                <th>职能</th>
                                                                <th>剩余任务</th>
                                                                <th>所有任务</th>
                                                                <th>任务操作</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                <?php if(is_array($group['user']) || $group['user'] instanceof \think\Collection || $group['user'] instanceof \think\Paginator): $i = 0; $__LIST__ = $group['user'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                                    <tr>
                                                                        <td><?php echo $vo['real_name']; ?></td>
                                                                        <td><span class="label label-primary"><?php echo $vo['function']; ?></span></td>
                                                                        <td><?php echo $vo['uncomplete_task_count']; ?> 个</td>
                                                                        <td><?php echo $vo['all_task_count']; ?> 个</td>
                                                                        <td><?php echo $vo['option']; ?></td>
                                                                    </tr>
                                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </tbody>
                                                    </table>
                                                <?php else: ?>
                                                    <div class="alert alert-danger">抱歉，您没有权限查看该内容！</div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-join-group" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal m-t" id="groupForm" method="post" action="<?php echo url('group/joingroup'); ?>">
                        <input type="hidden" name="to_id" value="<?php echo $group['leader_id']; ?>">
                        <input type="hidden" name="from_id" value="<?php echo $myself['id']; ?>">
                        <input type="hidden" name="title" value="申请入队">
                        <input type="hidden" name="group_id" value="<?php echo $group['id']; ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">主题：</label>
                            <div class="input-group col-sm-7">
                                <input type="text" class="form-control" required="" aria-required="true" value="申请入队" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">团队：</label>
                            <div class="input-group col-sm-7">
                                <input type="text" class="form-control" required="" aria-required="true" value="<?php echo $group['name']; ?>" disabled>
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
    function task(uid, gid){
        parent.layer.open({
            type: 2,
            title: false,
            closeBtn: false,
            shade: [0],
            area: ['340px', '215px'],
            offset: 'rb',
            time: 500,
            shift: 2,
            content: ['<?php echo url("admin/task/index"); ?>'+'?uid='+uid+'&gid='+gid, 'no'],
            end: function(){
                parent.layer.open({
                    type: 2,
                    title: '任务',
                    shadeClose: true,
                    shade: false,
                    maxmin: true, 
                    area: ['1000px', '600px'],
                    content: '<?php echo url("admin/task/index"); ?>'+'?uid='+uid+'&gid='+gid
                });
            }
        });
    }
     function msgDel(id){
        layer.confirm('确认删除此消息?', {icon: 3, title:'提示'}, function(index){
            $.getJSON("<?php echo url('group/msgDel'); ?>", {'id' : id}, function(res){
                if(1 == res.code){
                    layer.alert(res.msg, {title: '友情提示', icon: 1, closeBtn: 0}, function(){
                        window.location.href = res.data;
                    });
                }else{
                    layer.alert(res.msg, {title: '友情提示', icon: 2});
                }
            });
            layer.close(index);
        })
    }
    function groupDel(id){
        layer.confirm('确认删除此团队?', {icon: 3, title:'提示'}, function(index){
            $.getJSON("<?php echo url('group/groupDel'); ?>", {'id' : id}, function(res){
                if(1 == res.code){
                    layer.alert(res.msg, {title: '友情提示', icon: 1, closeBtn: 0}, function(){
                        window.location.href = res.data;
                    });
                }else{
                    layer.alert(res.msg, {title: '友情提示', icon: 2});
                }
            });
            layer.close(index);
        })
    }
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
        $('#msgForm').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });
        $('#groupForm').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
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
