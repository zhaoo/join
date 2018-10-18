<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"E:\wwwroot\join\public/../application/index\view\signup\index.html";i:1536640482;s:67:"E:\wwwroot\join\public/../application/index\view\common\header.html";i:1537945836;s:67:"E:\wwwroot\join\public/../application/index\view\common\footer.html";i:1539873981;}*/ ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="zh-cn"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="zh-cn"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="zh-cn"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="zh-cn"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
<head>
    <title>报名 -- <?php echo SYS_NAME; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="报名参赛">
    <meta name="description" content="<?php echo SYS_DESCRIPTION; ?>"> 
    <meta name="author" content="zhaoo">
    <link href="__CSS__/bootstrap.css" rel="stylesheet">
    <link href="__CSS__/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="__CSS__/../font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="__CSS__/general.css" rel="stylesheet">
    <link href="__CSS__/custom.css" rel="stylesheet">
	<link href="__CSS__/owl.carousel.css" rel="stylesheet">
    <link href="__CSS__/owl.theme.css" rel="stylesheet">
	<link href="__CSS__/style.css" rel="stylesheet">
	<link href="__CSS__/animate.css" rel="stylesheet">
	<link href="__CSS__/magnific-popup.css" rel="stylesheet">
	<link href="__CSS__/share.min.css" rel="stylesheet">
	<script src="__JS__/modernizr.js"></script>
	<link href="__CSS__/zhaoo.css" rel="stylesheet">
</head>
<body id="home">
	<!-- 预加载 -->
	<div id="preloader">
		<div id="status"></div>
	</div>
	<!-- 轮播图 -->
	<?php if(($banner == true)): ?>
    <div class="intro-header">
		<div class="col-xs-12 text-center abcen1">
			<h1 class="h1_home wow fadeIn" data-wow-delay="0.4s"><?php echo SYS_NAME; ?>.Join</h1>
			<h3 class="h3_home wow fadeIn" data-wow-delay="0.6s"><?php echo SYS_DESCRIPTION; ?></h3>
			<ul class="list-inline intro-social-buttons">
				<li><a href="<?php echo url('admin/index/index'); ?>" class="btn  btn-lg mybutton_gray wow fadeIn" data-wow-delay="1s"><span class="network-name"><?php if(\think\Session::get('id')): ?>后台<?php else: ?>登录<?php endif; ?></span></a></li>
				<li><a href="<?php echo url('signup/index'); ?>" class="btn  btn-lg mybutton_standard wow swing wow fadeIn" data-wow-delay="1s"><span class="network-name">报名</span></a></li>
			</ul>
		</div>   
        <!-- /.container -->
		<div class="col-xs-12 text-center abcen wow fadeIn">
			<div class="button_down "> 
				<a class="imgcircle wow bounceInUp" data-wow-duration="1.5s"  href="#contest-catalog"> <img class="img_scroll" data-original="__IMG__/icon/circle.png" alt=""> </a>
			</div>
		</div>
    </div>
    <?php endif; ?>
	<!-- 导航栏 -->
	<nav class="navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- <a class="navbar-brand" href="/"><?php echo SYS_NAME; ?></a> -->
				<a class="navbar-brand" href="/"><img data-original="__IMG__/logo.png" class="navbar-logo"></a>
			</div>
			<div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li class="menuItem"><a href="/" class="text-decoration:none">首页</a></li>
					<li class="menuItem">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">竞赛</a>
			            <ul class="dropdown-menu zhaoo-dropdown-menu">
			            	<?php if(is_array($conMenu) || $conMenu instanceof \think\Collection || $conMenu instanceof \think\Paginator): $i = 0; $__LIST__ = $conMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				        		<li><a href="<?php echo url('contest/index',array('id'=>$vo['id'])); ?>"><?php echo $vo['name']; ?></a></li>
				        	<?php endforeach; endif; else: echo "" ;endif; ?>
			            </ul>
			        </li>
					<li class="menuItem"><a href="<?php echo url('articles/list'); ?>">文章</a></li>
					<li class="menuItem"><a href="<?php echo url('signup/index'); ?>">报名</a></li>
					<li class="menuItem"><a href="<?php echo url('about/index'); ?>">关于</a></li>
					<li class="menuItem"><a href="<?php echo url('admin/index/index'); ?>"><?php if(\think\Session::get('id')): ?>后台<?php else: ?>登录<?php endif; ?></a></li>
				</ul>
			</div>
		</div>
	</nav> 
	<div class="content-section-c ">
		<div class="container">
			<div class="row signup-row">
			<div class="col-md-6 col-md-offset-3 text-center wrap_title white">
				<h2>报名</h2>
				<p class="lead" style="margin-top:0">Sign up</p>
			</div>
			<div class="mockup-content">
					<div class="morph-button wow pulse morph-button-inflow morph-button-inflow-1">
						<button type="button "><span>报名</span></button>
						<div class="morph-content">
							<div>
								<div class="content-style-form content-style-form-4 ">
									<h2 class="morph-clone">报名</h2>
									<form id="signupForm" method="post" action="<?php echo url('/index/signup/addSignup'); ?>">
										<p><label>名称</label><input id="name" name="name" type="text" placeholder="请输入作品名称" /></p>
		                                <p><label>竞赛</label><select id="contest_id" name="contest_id">
		                                	<?php if(empty($thisContest)): ?><option value="">请选择</option><?php endif; if(!empty($contest)): if(is_array($contest) || $contest instanceof \think\Collection || $contest instanceof \think\Paginator): if( count($contest)==0 ) : echo "" ;else: foreach($contest as $key=>$vo): ?>
		                                        <option value="<?php echo $vo['id']; ?>" <?php if((!empty($thisContest)) AND $thisContest[0]['name']==$vo['name']): ?> selected="selected" <?php endif; ?>><?php echo $vo['name']; ?></option>
		                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
		                                </select></p>
		                                <p><label>团队</label><select id="group_id" name="group_id">
		                                	<?php if(empty($group)): ?><option value="">无团队</option><?php endif; if(!empty($group)): if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): if( count($group)==0 ) : echo "" ;else: foreach($group as $key=>$vo): ?>
		                                        <option value="<?php echo $vo['id']; ?>" ><?php echo $vo['name']; ?></option>
		                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
		                                </select></p>
										<p><label>介绍</label><textarea id="introduce" name="introduce" type="text" style="font-size:16px;" placeholder="请输入作品介绍" /></textarea></p>
										<p><button id="signupCmd">提交</button></p>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>	
<!-- 页脚 -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-7 copyright">
                <h3 class="footer-title">版权所有</h3>
                <p>地址：浙江·杭州</p>
                <p>邮编：310023</p>
                <p>Copyright© 2018-2018 | <a rel="license" href="https://www.izhaoo.com" target="_blank">zhaoo</a> .AllRightsReserved.</p>
            </div>
            <!-- /col-xs-7 -->
            <div class="col-md-5">
                <div class="footer-banner">
                    <h3 class="footer-title">友情链接</h3>
                    <ul>
                        <?php if(is_array($links) || $links instanceof \think\Collection || $links instanceof \think\Paginator): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo $vo['url']; ?>" target="_blank"><?php echo $vo['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="back-to-top"><i class="fa fa-chevron-up"></i></div>
<!-- JS -->
<script src="__JS__/jquery.js"></script>
<script src="__JS__/jquery.lazyload.min.js"></script>
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/bootstrap.js"></script>
<script src="__JS__/bootstrap-tagsinput.js"></script>
<script src="__JS__/owl.carousel.js"></script>
<script src="__JS__/script.js"></script>
<script src="__JS__/stickUp.js"></script>
<script type="text/javascript">
jQuery(function($) {
    $(document).ready(function() {
        $('.navbar-default').stickUp();
    });
});
</script>
<script src="__JS__/wow.js"></script>
<script>
new WOW().init();
</script>
<script src="__JS__/classie.js"></script>
<script src="__JS__/uiMorphingButton_inflow.js"></script>
<script src="__JS__/jquery.magnific-popup.js"></script>
<script src="__JS__/layer/laydate/laydate.js"></script>
<script src="__JS__/layer/layer.min.js"></script>
<script src="__JS__/jquery.share.min.js"></script>
<script src="__JS__/zhaoo.js"></script>
<!-- 浮动小人 -->
<style>
.spig {
    display: block;
    width: 80px;
    height: 80px;
    position: absolute;
    bottom: 400px;
    left: 160px;
    z-index: 9999;
}

#message {
    color: #191919;
    background: #ddd;
    -moz-border-radius: 0px;
    -webkit-border-radius: 0px;
    min-height: 0.5em;
    padding: 5px;
    top: -60px;
    position: absolute;
    text-align: left;
    width: 80px !important;
    z-index: 10000;
    -moz-box-shadow: 0 0 15px #eeeeee;
    -webkit-box-shadow: 0 0 15px #eeeeee;
    box-shadow: 0 0 15px #eeeeee;
    outline: none;
    font-size: 14px;
}

.mumu {
    width: 80px;
    height: 80px;
    cursor: move;
    background: url('__IMG__/spig.png') no-repeat;
}
</style>
<div id="spig" class="spig">
    <div id="message">加载中……</div>
    <div id="mumu" class="mumu"></div>
</div>
<script src="__JS__/spig.js"></script>
<script>
    $("img").lazyload({
        effect: "fadeIn",
        // placeholder : "__IMG__/status.gif",
    });
</script>
<!-- 提交 -->
<script>
	$(document).ready( function() {
	$("#signupCmd").on('click',function(){
		$.ajax({ 
	        type: "POST",   
	        url: "/index/signup/addSignup",
	        data: {
	            "name":$("#name").val(),
	            "contest_id":$("#contest_id").val(),
	            "group_id":$("#group_id").val(),
	            "member":$("#member").val(),
	            "introduce":$("#introduce").val(),
	        },
	        success: function(res) {
	        	layer.msg(res.msg, {anim: 6});
	        	window.location.href = res.data;
	        },
	        error: function(jqXHR){     
	           layer.msg("发生错误：" + jqXHR.status, {anim: 6});
	        },     
	    });
	});
});
</script>
<!-- 下拉报名表 -->
<script>
	UIMorphingButton.prototype._init = function() {
		this.elH = this.el.offsetHeight;
		this.button = this.el.querySelector( 'button' );
		this.expanded = false;
		this.contentEl = this.el.querySelector( '.morph-content' );
		this._initEvents();
	}
</script>
</body>
</html>