var visitor = '同学';
jQuery(document).ready(function($) {
	$("#spig").mousedown(function(e) {
		if (e.which == 3) {
			showMessage("<a href='/admin/index/index'>后台</a> <a onclick='hideSpig()' href='javacript:;'>隐藏</a>", 10000)
		}
	});
	$("#spig").bind("contextmenu", function(e) {
		return false
	})
});
jQuery(document).ready(function($) {
	$("#message").hover(function() {
		$("#message").fadeTo("100", 1)
	})
});
jQuery(document).ready(function($) {
	$(".mumu").mouseover(function() {
		$(".mumu").fadeTo("300", 0.3);
		msgs = ["右击我有特殊功能哦~", "更多功能请登录后台~"];
		var i = Math.floor(Math.random() * msgs.length);
		showMessage(msgs[i])
	});
	$(".mumu").mouseout(function() {
		$(".mumu").fadeTo("300", 1)
	})
});
jQuery(document).ready(function($) {
	showMessage('欢迎访问卓鹰网~', 6000)
	$(".spig").animate({
		top: $(".spig").offset().top + 300,
		left: document.body.offsetWidth - 160
	}, {
		queue: false,
		duration: 1000
	})
});
var spig_top = 50;
jQuery(document).ready(function($) {
	var f = $(".spig").offset().top;
	$(window).scroll(function() {
		$(".spig").animate({
			top: $(window).scrollTop() + f + 300
		}, {
			queue: false,
			duration: 1000
		})
	})
});
jQuery(document).ready(function($) {
	var c = 0;
	$(".mumu").click(function() {
		if (!ismove) {
			c++;
			if (c <= 4) {
				msgs = ["筋斗云！~我飞！", "惹不起你，我还躲不起你么？", "干嘛动我呀！小心我咬你！"];
				var i = Math.floor(Math.random() * msgs.length)
			} else {
				msgs = ["你有完没完呀？", "你已经点我" + c + "次了", "还点我？", "我真的要咬你了！"];
				var i = Math.floor(Math.random() * msgs.length)
			}
			s = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.75, -0.1, -0.2, -0.3, -0.4, -0.5, -0.6, -0.7, -0.75];
			var a = Math.floor(Math.random() * s.length);
			var b = Math.floor(Math.random() * s.length);
			$(".spig").animate({
				left: document.body.offsetWidth / 2 * (1 + s[a]),
				top: document.body.offsetheight / 2 * (1 + s[a])
			}, {
				duration: 500,
			})
		} else {
			ismove = false
		}
	})
});

function showMessage(a, b) {
	if (b == null) b = 10000;
	jQuery("#message").hide().stop();
	jQuery("#message").html(a);
	jQuery("#message").fadeIn();
	jQuery("#message").fadeTo("1", 1);
	jQuery("#message").fadeOut(b)
};
var _move = false;
var ismove = false;
var _x, _y;
jQuery(document).ready(function($) {
	$("#spig").mousedown(function(e) {
		_move = true;
		_x = e.pageX - parseInt($("#spig").css("left"));
		_y = e.pageY - parseInt($("#spig").css("top"))
	});
	$(document).mousemove(function(e) {
		if (_move) {
			var x = e.pageX - _x;
			var y = e.pageY - _y;
			var a = $(window).width() - $('#spig').width();
			var b = $(document).height() - $('#spig').height();
			if (x >= 0 && x <= a && y > 0 && y <= b) {
				$("#spig").css({
					top: y,
					left: x
				});
				ismove = true
			}
		}
	}).mouseup(function() {
		_move = false
	})
});