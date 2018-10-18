/* By: zhaoo */
/* 2018-05-23 12:53:34 */

//留言板
	var index = '';
    function showStart(){
        index = layer.load(0, {shade: false});
        return true;
    }
    function showSuccess(res){
        layer.ready(function(){
            layer.close(index);
            layer.msg(res.msg, {anim: 6});
        });
    }
	$(function(){
        //输入内容后高亮
        $('.form-control').bind('input propertychange',function(){
            if($(this).val() == ''){
                $(this).css("border-color","#bdc3c7");
                $(this).next().css({"background-color":"#bdc3c7","border-color":"#bdc3c7"});
            }else{
                $(this).css("border-color","#1abc9c");
                $(this).next().css({"background-color":"#1abc9c","border-color":"#1abc9c"});
            }
        });
        //form提交
        var options = {
            beforeSubmit:showStart,
            success:showSuccess,
        };
        $("#msgForm").submit(function(e){
            $(this).ajaxSubmit(options);
            $(this).resetForm();
            return false;
        });
    });

// Back To Top
$(document).ready(function() {
    var height = $(window).height();
    $(".back-to-top").hide();
    $(window).scroll(function() {
        if ($(window).scrollTop() > height) {
            $(".back-to-top").fadeIn(500);
        } else {
            $(".back-to-top").fadeOut(500);
        }
    });
    $('.back-to-top').click(function() {
        $('body,html').animate({
            scrollTop: '0px'
        }, 900);
    });
});

// 隐藏浮动小人
function hideSpig() {
    $('#spig').hide();
}

// 下拉菜单由点击按钮改为鼠标悬停
// $(document).ready(function(){
//     $(document).off('click.bs.dropdown.data-api');
// });

// $(function() {
//     $(".dropdown-toggle").on("mouseover", function() {
//         $(this).dropdown('toggle');
//     })
// 	$(".dropdown-toggle").on("mouseout", function() {
//     	$(this).dropdown('toggle');
//     })
// })
