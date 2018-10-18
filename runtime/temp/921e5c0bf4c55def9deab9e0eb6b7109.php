<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"E:\wwwroot\join\public/../application/index\view\index\index.html";i:1539873875;s:67:"E:\wwwroot\join\public/../application/index\view\common\header.html";i:1537945836;s:67:"E:\wwwroot\join\public/../application/index\view\common\footer.html";i:1539873981;}*/ ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="zh-cn"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="zh-cn"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="zh-cn"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="zh-cn"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
<head>
    <title>首页 -- <?php echo SYS_NAME; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="竞赛, 高校, 大学生, 管理系统">
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
	<!-- 竞赛目录 -->
	<div id="contest-catalog" class="content-section-b" style="border-top: 0">
		<div class="container">
			<div class="col-md-6 col-md-offset-3 text-center wrap_title">
				<h2>竞赛</h2>
				<p class="lead" style="margin-top:0">Contest</p>
			</div>
			<div class="row">
				<?php if(is_array($conMenu) || $conMenu instanceof \think\Collection || $conMenu instanceof \think\Paginator): $i = 0; $__LIST__ = $conMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<div class="col-sm-4 wow fadeInDown text-center">
					  	<a href="<?php echo url('contest/index',array('id'=>$vo['id'])); ?>">
					  		<img class="cont-img" data-original="<?php echo $vo['thumbnail']; ?>" alt="<?php echo $vo['name']; ?>">
						</a>
					  	<h3><a href="<?php echo url('contest/index',array('id'=>$vo['id'])); ?>"><?php echo $vo['name']; ?></a></h3>
					    <p class="lead line-limit-length"><?php echo $vo['description']; ?></p>
					</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<!-- <div class="row tworow">
				<div class="col-sm-4  wow fadeInDown text-center">
				  <img class="rotate" src="__IMG__/icon/laptop.svg" alt="Generic placeholder image">
				  <h3>服务外包大赛</h3>
				  <p class="lead">Epsum factorial non deposit quid pro quo hic escorol. Olypian quarrels et gorilla congolium sic ad nauseum. </p>
				 <p><a class="btn btn-embossed btn-primary view" role="button">了解详情</a></p>
				</div>
			</div> -->
		</div>
	</div>
	<!-- 展示 -->
	<div id="screen" class="content-section-b">
        <div class="container">
          	<div class="row" >
				<div class="col-md-6 col-md-offset-3 text-center wrap_title ">
					<h2>展示</h2>
					<p class="lead" style="margin-top:0">Exhibition</p>
			 	</div>
		  	</div>
		    <div class="row wow bounceInUp" >
            	<div id="owl-demo" class="owl-carousel">
                    <?php if(is_array($exhibition) || $exhibition instanceof \think\Collection || $exhibition instanceof \think\Paginator): $i = 0; $__LIST__ = $exhibition;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo): ?>
							<a href="<?php echo $vo; ?>" class="image-link">
								<div class="item">
									<img  class="img-responsive img-rounded" data-original="<?php echo $vo; ?>" alt="">
								</div>
							</a>
                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            	</div>       
          	</div>
        </div>
	</div>
	<!-- 作品 -->
	<div class="content-section-b"> 
		<div class="container">
			<div class="row" >
				<div class="col-md-6 col-md-offset-3 text-center wrap_title ">
					<h2>作品</h2>
					<p class="lead" style="margin-top:0">Works</p>
			 	</div>
		  	</div>
            <div class="row">
                <div class="col-sm-6 wow fadeInLeftBig">
                     <div id="owl-demo-1" class="owl-carousel">
						<a href="/upload/images/contest/20180912/20180912205741.jpg" class="image-link">
							<div class="item">
								<img  class="img-responsive img-rounded" data-original="/upload/images/contest/20180912/20180912205741.jpg" alt="">
							</div>
						</a>
						<a href="/upload/images/contest/20180912/20180912205802.jpg" class="image-link">
							<div class="item">
								<img  class="img-responsive img-rounded" data-original="/upload/images/contest/20180912/20180912205802.jpg" alt="">
							</div>
						</a>
						<a href="/upload/images/contest/20180912/20180912205816.jpg" class="image-link">
							<div class="item">
								<img  class="img-responsive img-rounded" data-original="/upload/images/contest/20180912/20180912205816.jpg" alt="">
							</div>
						</a>
					</div>       
                </div>
                <div class="col-sm-6 wow fadeInRightBig"  data-animation-delay="200">   
                    <h3 class="section-heading">zhaooBlog</h3>
					<div class="sub-title lead3">前端： jQuery, Bootstrap, Font Awesome, FancyBox, particles.js<br>后端： Django, django-mdeditor, markdown, Pygments</div>
                    <p class="lead">该作品是一个极简式设计的个人博客，作品采用MTV架构实现，且全站自适应。MarkDown编辑功能可以方便用户快速排版，即时捕捉灵感。</p>
					 <p><a class="btn btn-embossed btn-primary" href="http://zhaooblog.izhaoo.com/" role="button" target="_blank">在线预览</a> 
					 <a class="btn btn-embossed btn-info" href="https://github.com/izhaoo/zhaooBlog" role="button" target="_blank">代码下载</a></p>
				</div>  			
			</div>
        </div>
    </div>
	<!-- 留言 -->
	<div class="content-section-b">
		<div class="container">
			<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center wrap_title">
				<h2>留言</h2>
				<p class="lead" style="margin-top:0">Comment</p>
			</div>
			<form id="msgForm" method="post" action="<?php echo url('/index/index/addMsg'); ?>">
				<div class="col-md-6">
					<div class="form-group">
						<label for="nic_name">昵称</label>
						<div class="input-group">
							<input type="text" class="form-control" name="nic_name" id="nic_name" placeholder="<?php if(!empty($session['nic_name'])): ?><?php echo $session['nic_name']; endif; ?>" required>
							<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
						</div>
					</div>
					<div class="form-group">
						<label for="email">E-Mail</label>
						<div class="input-group">
							<input type="email" class="form-control" id="email" name="email" placeholder="<?php if(!empty($session['email'])): ?><?php echo $session['email']; endif; ?>" required  >
							<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
						</div>
					</div>
					<div class="form-group">
						<label for="content">内容</label>
						<div class="input-group">
							<textarea name="content" id="content" class="form-control" rows="5" required></textarea>
							<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
						</div>
					</div>
					<input type="submit" value="提交" class="btn tada btn-embossed btn-primary pull-right">
				</div>
			</form>
			<hr class="featurette-divider hidden-lg">
				<div class="col-md-5 col-md-push-1 address">
					<address>
					<h3>联系</h3>
					<p class="lead">@zhaoo<br>
					<a href="tencent://message/?Menu=yes&uin=894519210" target="_blank">QQ: 894519210</a><br>
					<a href="mailto:izhaoo@qq.com" target="_blank">E-Mail: izhaoo@qq.com</a><br>
					<a href="https://note.izhaoo.com" target="_blank">Blog: https://note.izhaoo.com</a></p>
					</address>
					<h3>分享</h3>
					<div class="social-share row" data-sites="qq,wechat,qzone,weibo,facebook,twitter"></div>
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
<script>
	$(document).ready(function() {
    var height = $(window).height();
    $("#spig").hide();
    $(window).scroll(function() {
        if ($(window).scrollTop() > height) {
            $("#spig").fadeIn(500);
        } else {
            $("#spig").fadeOut(500);
        }
    });
});
</script>
</body>
</html>