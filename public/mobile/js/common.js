$(function(){
	//判断移动端还是pc端点击事件
    if ('ontouchstart' in window) {
        var click = 'touchstart';
    } else {
        var click = 'click';
    }

	var $nav = $('.navbar')
	var $menu = $('.menu')
	var $wrap = $('.wrap')
	$nav.find('.burger').on(click,function(){
		if($nav.hasClass('animate')){
			closeMenu();
		}else{
			openMenu();
		}
		
	})
	$wrap.find('.door').on('touchstart',function(e){
		closeMenu();
		e.preventDefault();
	})
	$(document).on('touchmove',function (e){
		if($nav.hasClass('animate')){
			e.preventDefault();
		}	    
	});
	function openMenu(){
		$nav.addClass('animate');
		$menu.addClass('animate');
		$wrap.addClass('animate');
		$('body').css({"overflow-y":'hidden'})		
	};
	function closeMenu(){
		$nav.removeClass('animate');
		$menu.removeClass('animate');
		$wrap.removeClass('animate');
		$('body').css({"overflow-y":'auto'})
	}

	$nav.find('.search').on(click,function(){
		var docHeight = $(document).height();
		$nav.find('.search_div').css({'height':docHeight})
		$('body').css({'overflow-y':'hidden'})
	})
	$nav.find('.del').on('touchend',function(){
		$nav.find('.search_div').css({'height':'0'})
		$('body').css({'overflow-y':'scroll'})

	})
	$nav.find('#sear').on(click,function(){
		var _input = $nav.find('input').val()
		if(_input){
			$("#seaform").submit();
		}else{
			return;
		}
		
	})

	/*登陆后跳回原页面*/
	var saveurl;
	$menu.find('.login_btn').on(click,function(){
		saveurl = window.location.href;
		localStorage.setItem('saveurl', saveurl);
	})
	$('.reply_content .login_text span').on(click,function(){
		saveurl = window.location.href;
		localStorage.setItem('saveurl', saveurl);
	})
	/*回到顶部*/
	window.onscroll = function(){
		var scrollTop = $(this).scrollTop();
　　	var scrollHeight = $(document).height();
　　	var windowHeight = $(this).height();
		//console.log(scrollTop)		
		if(scrollTop>500){
			$('.returnTop').css({'opacity':'0.4','width':'1rem'});
		}else if(scrollTop<500){
			$('.returnTop').css({'opacity':'0'}).delay(1000).css({'width':'0'});
		}
	}

	$('.returnTop').on('touchend',function(e){
		smoothscroll();
		e.preventDefault();
	})
	function smoothscroll(){  
	    var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;  
	    if (currentScroll > 0) {  
	         window.requestAnimationFrame(smoothscroll);  
	         window.scrollTo (0,currentScroll - (currentScroll/5));  
	    }  
	}

	/*详情页分享*/
	var $footer = $('.details_footer');
	$footer.find('.share').on(click,function(e){
		//console.log(window.innerHeight)
		var height = window.innerHeight;
		$footer.find('.share_div').css({'height':height,'display':'block'});
		$('body').css({'overflow-y':'hidden'});
		e.preventDefault();
	});
	$footer.find('.del').on('touchend',function(e){
		$footer.find('.share_div').css({'display':'none'});
		$('body').css({'overflow-y':'scroll'})
		e.preventDefault();
	});

	/*评论页面*/
	var $reply = $('.reply_content');
	var $comment = $('.comment_item');
	/*评论功能*/
	$reply.find('textarea').focus(function(){
		var height = window.innerHeight;
		$(this).addClass('focus');
		$(this).siblings('.sub_comment').css({'display':'block'})
		$reply.siblings('.hide_bg').css({'height':height});
		$('body').css({'overflow-y':'hidden'})
	});
	/*回复他人评论*/
	$comment.find('.reply').on(click,function(){
		var height = window.innerHeight;
		$comment.find('form').css({'display':'block'});
		$comment.parent('ul').siblings('.hide_bg').css({'height':height});
		$('body').css({'overflow-y':'hidden'})
	});
	/*点击蒙层输入框消失*/
	$('.hide_bg').on(click,function(){
		$reply.find('textarea').removeClass('focus');
		$reply.find('textarea').siblings('.sub_comment').css({'display':'none'});
		$reply.siblings('.hide_bg').css({'height':0});
		$comment.find('form').css({'display':'none'});
		$comment.parent('ul').siblings('.hide_bg').css({'height':0});
		$('body').css({'overflow-y':'auto'});
	});
	/*评论提交*/
	$reply.find('.sub_comment').on(click,function(){
		var val = $('.reply_content .text').val();
		val = val.replace(/(^\s*)|(\s*$)/g, '')
		if(val != ''){
			$('#commentForm').submit();
		}else{
			return;
		}
	});
	/*回复提交*/
	$comment.find('.sub_reply').on(click,function(){
		var val = $(this).siblings('.text').val();
		val = val.replace(/(^\s*)|(\s*$)/g, '')
		if(val != ''){
			$('#replyForm').submit();
		}else{
			return;
		}
	})
	
	/*点赞*/
	


	/*判断是否登录状态*/
	function checklogin() {
		if($("#user_id").val() == '') {
			return false;
		} else {
			return true;
		}
	}
})