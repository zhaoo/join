<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"E:\wwwroot\join\public/../application/admin\view\blog\list.html";i:1537187900;s:67:"E:\wwwroot\join\public/../application/admin\view\common\header.html";i:1532707956;s:67:"E:\wwwroot\join\public/../application/admin\view\common\footer.html";i:1538031104;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>文章列表 -- <?php echo SYS_NAME; ?></title>
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
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <?php if($isAuthor): ?>
            <a href="<?php echo url('blog/articleAdd'); ?>">
                <button class="btn btn-outline btn-primary" type="button" style="margin-bottom: 10px;">添加文章</button>
            </a>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-4">
                <?php if(is_array($articleList) || $articleList instanceof \think\Collection || $articleList instanceof \think\Paginator): $i = 0; $__LIST__ = $articleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="ibox blog-list">
                        <div class="ibox-content">
                            <a href="<?php echo url('article', ['id'=>$vo['id']]); ?>" class="btn-link">
                                <h2><?php echo $vo['title']; ?></h2>
                            </a>
                            <div class="small m-b-xs info">
                                <span><i class="fa fa-user"></i><a href="<?php echo url('/admin/zone/index', ['id'=>$vo['user_id']]); ?>"> <?php echo $vo['user']; ?></a></span>
                                <span><i class="fa fa-clock-o"></i> <?php echo $vo['post_time']; ?></span>
                                <span><i class="fa fa-eye"></i> <?php echo $vo['view']; ?></span>
                                <?php if($isAuthor): ?><span><i class="fa fa-file-text-o"></i><a href="<?php echo url('articleedit', ['id'=>$vo['id']]); ?>"> 编辑</a></span><?php endif; ?>
                            </div>
                            <p><?php echo $vo['abstract']; ?></p>
                            <div class="row">
                                <div class="col-md-6 tags">
                                    <?php if(is_array($vo['tags']) || $vo['tags'] instanceof \think\Collection || $vo['tags'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['tags'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?>
                                        <button class="btn btn-primary btn-xs" type="button"><?php echo $voo; ?></button>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
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
</body>
</html>