<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"E:\wwwroot\join\public/../application/admin\view\index.html";i:1537277309;s:67:"E:\wwwroot\join\public/../application/admin\view\common\header.html";i:1532707956;s:67:"E:\wwwroot\join\public/../application/admin\view\common\footer.html";i:1538031104;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>后台 -- <?php echo SYS_NAME; ?></title>
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
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i></div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span><img alt="image" class="img-circle" src="<?php echo $head; ?>" style="width:64px;height:64px;"/></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs"><strong class="font-bold"><?php echo $nic_name; ?></strong></span>
                                <span class="text-muted text-xs block"><?php echo $rolename; ?></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <?php if(authCheck('zone/index')): ?>
                                <li><a class="J_menuItem" href="<?php echo url('admin/zone/index'); ?>">个人页面</a></li>
                            <?php endif; if(authCheck('blog/list')): ?>
                                <li><a class="J_menuItem" href="<?php echo url('admin/blog/list'); ?>">我的博客</a></li>
                            <?php endif; if(authCheck('profile/index')): ?>
                                <li><a class="J_menuItem" href="<?php echo url('admin/profile/index'); ?>">编辑资料</a></li>
                            <?php endif; ?>
                            <li class="divider"></li>
                            <li><a href="<?php echo url('admin/login/loginOut'); ?>">注销</a></li> 
                            <li><a href="<?php echo url('index/index/index'); ?>">退出</a></li> 
                        </ul>
                    </div>
                    <!-- <div class="logo-element"><?php echo SYS_NAME; ?></div> -->
                    <div class="logo-element"><img src="__IMG__/logo.png" class="navbar-logo"></div>
                </li>
                <li>
                    <a class="J_menuItem" href="<?php echo url('index/index/index'); ?>"><i class="fa fa-home"></i> <span class="nav-label">首页</span></a>
                </li>
                <?php if(!empty($menu)): if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
                <li class="menu">
                    <a href="<?php echo $vo['href']; ?>">
                        <i class="<?php echo $vo['style']; ?>"></i>
                        <span class="nav-label"><?php echo $vo['node_name']; ?> </span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if(!empty($vo['child'])): if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): if( count($vo['child'])==0 ) : echo "" ;else: foreach($vo['child'] as $key=>$v): ?>
                        <li>
                            <a class="J_menuItem" href="<?php echo $v['href']; ?>"><?php echo $v['node_name']; ?></a>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </ul>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </ul>
            <!-- <img src="__IMG__/eagle.png" class="eagle" draggable="false"> -->
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="<?php echo url('search/index'); ?>">
                        <div class="form-group">
                            <input type="text" placeholder="搜索 …" class="form-control" name="search" id="search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i> 
                            <?php if($remind_num): ?><span class="label label-primary"><?php echo $remind_num; ?></span><?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <?php if($remind): if(is_array($remind) || $remind instanceof \think\Collection || $remind instanceof \think\Paginator): $i = 0; $__LIST__ = $remind;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <li class="m-t-xs">
                                    <div class="dropdown-messages-box">
                                        <a href="javascript:userZone(<?php echo $vo['from_id']; ?>,'<?php echo $vo['from']; ?>')" class="pull-left">
                                            <img alt="image" class="img-circle" src="<?php echo $vo['head']; ?>">
                                        </a>
                                        <div class="media-body">
                                            <?php switch($vo['type']): case "1": ?>
                                                    <a href="javascript:addMember(<?php echo $vo['to_id']; ?>,<?php echo $vo['group_id']; ?>,<?php echo $vo['id']; ?>)" class="add-member-a">
                                                <?php break; case "2": ?>
                                                    <a href="javascript:addMember(<?php echo $vo['from_id']; ?>,<?php echo $vo['group_id']; ?>,<?php echo $vo['id']; ?>)" class="add-member-a">
                                                <?php break; case "3": ?>
                                                    <a href="javascript:letter('<?php echo $vo['contant']; ?>',<?php echo $vo['from_id']; ?>,<?php echo $vo['to_id']; ?>)" class="add-member-a">
                                                <?php break; endswitch; ?>
                                            <strong><?php echo $vo['from']; ?>&nbsp;-&nbsp;<?php echo $vo['title']; ?></strong></a>
                                            <a href="javascript:remindDel(<?php echo $vo['id']; ?>)" class="remind-a"><span class="label-sm label-danger pull-right remind-span"><i class="fa fa-close"></i></span></a>
                                            <small class="pull-right"><?php echo $vo['time_dif']; ?>&nbsp;</small>
                                            <?php switch($vo['type']): case "1": ?>
                                                    <a href="javascript:addMember(<?php echo $vo['to_id']; ?>,<?php echo $vo['group_id']; ?>,<?php echo $vo['id']; ?>)" class="add-member-a">
                                                <?php break; case "2": ?>
                                                    <a href="javascript:addMember(<?php echo $vo['from_id']; ?>,<?php echo $vo['group_id']; ?>,<?php echo $vo['id']; ?>)" class="add-member-a">
                                                <?php break; case "3": ?>
                                                    <a href="javascript:letter('<?php echo $vo['contant']; ?>',<?php echo $vo['from_id']; ?>,<?php echo $vo['to_id']; ?>)" class="add-member-a">
                                                <?php break; endswitch; ?>
                                            <p><?php echo $vo['contant']; ?></p></a>
                                            <br>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                            <?php endforeach; endif; else: echo "" ;endif; else: ?>暂无消息<?php endif; ?>
                        </ul>
                    </li>
                    <li class="hidden-xs">
                        <a href="<?php echo url('index/index/index'); ?>"><i class="fa fa-home"></i> 首页</a>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i> 主题
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i></button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="index.html">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i></button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">常用操作<span class="caret"></span></button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabGo"><a>前进</a></li>
                    <li class="J_tabBack"><a>后退</a></li>
                    <li class="J_tabFresh"><a>刷新</a></li>
                    <li class="J_clearCache"><a>清除缓存</a></li>
                    <li class="divider"></li>
                    <li class="J_tabShowActive"><a>定位当前选项卡</a></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a></li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="<?php echo url('index/index/index'); ?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%"
                    src="<?php echo url('index/index/index'); ?>" frameborder="0"
                    data-id="index.html" seamless>
            </iframe>
        </div>
        <div class="footer">
            <div class="pull-right">Copyright&copy; 2018-<?php echo date("Y"); ?> | <a href="https://note.izhaoo.com" target="_blank">zhaoo</a> .AllRightsReserved</div>
        </div>
    </div>
    <!--右侧部分结束-->
    <!--右侧边栏开始-->
    <div id="right-sidebar">
        <div class="sidebar-container">
            <ul class="nav nav-tabs navs-3">
                <li class="active">
                    <a data-toggle="tab" href="#tab-1">
                        <i class="fa fa-gear"></i> 主题
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="skin-setttings">
                        <div class="title">主题设置</div>
                        <div class="setings-item">
                            <span>收起左侧菜单</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                    <label class="onoffswitch-label" for="collapsemenu">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定顶部</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                    <label class="onoffswitch-label" for="fixednavbar">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                                <span>固定宽度</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                    <label class="onoffswitch-label" for="boxedlayout">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="title">皮肤选择</div>
                        <div class="setings-item default-skin nb">
                            <span class="skin-name ">
                                <a href="#" class="s-skin-0">默认皮肤</a>
                            </span>
                        </div>
                        <div class="setings-item blue-skin nb">
                            <span class="skin-name ">
                                <a href="#" class="s-skin-1">蓝色主题</a>
                            </span>
                        </div>
                        <div class="setings-item yellow-skin nb">
                            <span class="skin-name ">
                                <a href="#" class="s-skin-3">黄色主题</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal-reply" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-horizontal m-t" id="letterForm" method="post" action="<?php echo url('zone/letter'); ?>">
                    <input type="hidden" name="to_id">
                    <input type="hidden" name="from_id">
                    <input type="hidden" name="title" value="回信">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">主题：</label>
                        <div class="input-group col-sm-7">
                            <input type="text" class="form-control" required="" aria-required="true" value="回信" disabled>
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
    //第一次登录补全信息
    $(document).ready(function(){
        $.getJSON("<?php echo url('index/isFirstLogin'); ?>",function(res){
            if(res.code == -1){
                layer.confirm('是否补全用户信息？',{
                    btn: ['补全','忽略']
                    }, function(){
                        window.location.href = res.data;
                    }, function(){
                        layer.msg('是是是，您说了算。');
                });
            }
        });
    });
    //清除缓存
    $(document).ready(function(){
        $('.J_clearCache').on("click", function(){
            layer.confirm('确认要清除缓存？', {}, function (data) {
                $.post('<?php echo url("clear"); ?>', {}, function (data) {
                    layer.msg(data.info, {}, function (index) {
                        layer.close(index);
                        window.location.href = data.url;
                    });
                });
            });
        });
    });
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
        var options = {
            beforeSubmit:showStart,
            success:showSuccess
        };
        $('#letterForm').submit(function(){
            $(this).ajaxSubmit(options);
            return false;
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
    function remindDel(id){
        layer.confirm('确认删除此消息?', {icon: 3, title:'提示'}, function(index){
            $.getJSON("<?php echo url('index/remindDel'); ?>", {'id' : id}, function(res){
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
    function addMember(user_id,group_id,remind_id){
        layer.confirm('是否接受组队邀请?', {icon: 3, title:'提示'}, function(index){
            $.getJSON("<?php echo url('group/addMember'); ?>", {'user_id':user_id,'group_id':group_id}, function(res){
                if(1 == res.code){
                    layer.alert(res.msg, {title: '友情提示', icon: 1, closeBtn: 0}, function(){
                        $.getJSON("<?php echo url('index/remindDel'); ?>", {'id' : remind_id});
                        window.location.href = res.data;
                    });
                }else{
                    layer.alert(res.msg, {title: '友情提示', icon: 2});
                }
            });
            layer.close(index);
        })
    }
    function letter(contant,from_id,to_id){
        var index = layer.open({
            title: '私信',
            skin: 'layui-layer-molv',
            closeBtn: 1,
            shadeClose: true,
            content: contant,
            btn: ['回信'],
            yes: function(index,layero){
                layer.close(index);
            }
        });
        $("a[class='layui-layer-btn0']").attr({"href":"#modal-reply","data-toggle":"modal"});
        $("#modal-reply").find("input[name='to_id']").val(from_id);
        $("#modal-reply").find("input[name='from_id']").val(to_id);
    }
</script>
</body>
</html>
