$(function(){
	//判断移动端还是pc端点击事件
    if ('ontouchend' in window) {
        var click = 'touchend';
    } else {
        var click = 'click';
    }

	$qrForm = $('#qrForm');

	//手机号验证
	var reg = /^((13[0-9])|(15[^4])|(18[0-9])|(17[0-8])|(147,145))\d{8}$/;
	
	var wait = 60 ;
	
	$qrForm.find('.send').on(click,function(){
		var num = $qrForm.find('.phone input').val();
		//console.log(1)
		if(reg.test(num)){
			//console.log('ok')
			time(this);
		}else{
			$qrForm.find('.phone').next('.error').text('请输入有效手机号码;');
			setTimeout(clearError,3000);
		}		
	})
	function clearError(){
		$qrForm.find('.phone').next('.error').text('');
	}
	//
	function time(o) {    
            o.setAttribute("disabled", true);  
            //o.className += 'sending';
            o.value= wait +"s后重新发送";  
            wait--;
            //console.log(wait);  
            var timer = setTimeout(function(){
            	time(o)
            },1000)
            if(wait == -1){
            	o.removeAttribute("disabled");    
            	//removeClass(o,'sending');        
	            o.value="发送验证码"; 
	            clearInterval(timer);
	            wait = 60;	            
            }  
          
    } 

    //签到提交
    $('#qrSubmit').on(click,function(){
    	var data = $("#qrForm").serialize();
    })
})