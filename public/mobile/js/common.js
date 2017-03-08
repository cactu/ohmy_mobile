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
		$nav.find('.search_div').css({'display':'block'})
		//$nav.find('input').focus();
		//$nav.find('input').css({'background':'red'})
	})
	$nav.find('.del').on(click,function(){
		$nav.find('.search_div').css({'display':'none'})
	})
	$nav.find('#sear').on(click,function(){
		var _input = $nav.find('input').val()
		if(_input){
			console.log(_input);
		}else{
			console.log('您没有输入任何内容')
			return;
		}
		
	})

	/*回到顶部*/
	window.onscroll = function(){
		var scrollTop = $(this).scrollTop();
　　	var scrollHeight = $(document).height();
　　	var windowHeight = $(this).height();
		//console.log(scrollTop)		
		if(scrollTop>800){
			$('.returnTop').css({'opacity':'0.4'});
		}else if(scrollTop<800){
			$('.returnTop').css({'opacity':'0'});
		}
	}

	$('.returnTop').on(click,function(){
		smoothscroll()
	})
	function smoothscroll(){  
	    var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;  
	    if (currentScroll > 0) {  
	         window.requestAnimationFrame(smoothscroll);  
	         window.scrollTo (0,currentScroll - (currentScroll/5));  
	    }  
	}
})