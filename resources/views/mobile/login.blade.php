<!DOCTYPE html>
<html>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?d6f780803e0ca9eff6e14ce0ed091fce";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<head lang="en">
	<meta charset="UTF-8">
    <title>OHMY设计</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1, minimum-scale=1">
	<link rel="stylesheet" href="//cdn.bootcss.com/normalize/4.2.0/normalize.min.css">
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('/mobile/css/common.css')}}">
	<link rel="stylesheet" href="{{asset('/mobile/css/login.css')}}">
	<script type="text/javascript" src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        document.documentElement.style.fontSize=document.documentElement.clientWidth/7.5+'px';
    })
    </script>
</head>
<body>
	<div class='wrap'>
		<div class='login_bg wrap1'>
			<div class="logo clearfix">
				<a href="{{url('index')}}" class='clearfix'>
	                <img src="{{asset('/mobile/img/login_logo1.png')}}">
	                <img src="{{asset('/mobile/img/login_logo2.png')}}">
                </a>
            </div>
            <div class='tab_item'>
				</a><span class="login_item active">登录</span>
                <span class="or">OR</span>
                <span class="register_item">注册</span>
            </div>
            <div class='tab_content'>
				<!-- 登陆部分 -->
				<div class="login_content">
                    <form id="loginForm">
                        <div class="input_group">
                            <input type="email" name="email" placeholder="电子邮箱" id="login_email" class="form-control"><i class="nec">*</i>
                            <div class="error_info"></div>
                        </div>
                        <div class="input_group">
                            <input type="password" placeholder="输入密码" id="login_password" name="password"  class="form-control"><i class="nec">*</i>
                            <div class="error_info"></div>
                        </div>
                        <div class="checkbox remember fl clearfix">
                            <label class='clearfix'>
                                <input type="checkbox" id="ck_rmbUser"> <span>记住我</span>
                            </label>
                        </div>
                        <button type="button" id="login_submit">登录</button>
                        <div class="input_group third_login">
                            	<span>第三方登录</span>
                            <a href="{{$qq_url}}" class="login_qq"><i class="iconfont">&#xe60b;</i></a>
                            <a href="{{$webo_url}}" class="login_weibo"><i class="iconfont">&#xe60d;</i></a>

                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    </form>
                </div>
                <!-- 注册部分 -->
                <div class="register_content hide">
                    <form id="regForm">
	                    <div class="input_group">
	                        <input type="text" placeholder="昵称" id="register_username" name="username" class="form-control"><i class="nec">*</i>
	                        <i class="fa fa-spinner fa-pulse register_loading hide"></i>
	                        <i class="fa fa-check-circle register_chicked hide"></i>
	                        <div class="error_info"></div>
	                    </div>
	                    <div class="input_group">
	                        <input type="email" placeholder="电子邮箱" id="register_email" name="email" class="form-control"><i class="nec">*</i>
	                        <i class="fa fa-spinner fa-pulse register_loading hide"></i>
	                        <i class="fa fa-check-circle register_chicked hide"></i>
	                        <div class="error_info"></div>
	                    </div>
	                    <div class="input_group">
	                        <input type="password" placeholder="登录密码" id="register_password" name="password"  class="form-control"><i class="nec">*</i>
	                        <div class="error_info"></div>
	                    </div>
	                    <div class="input_group">
	                        <div class="clearfix">
	                            <input type="text" placeholder="输入验证码" id="register_code" name="code" class="form-control"><i class="nec">*</i>
	                            <img src="" class="code_img" onclick="this.src=this.src+'?i='+Math.random()">
	                        </div>
	                        <div class="error_info"></div>
	                    </div>
	                    <div class="input_group clearfix">
	                        <div class="agreement">
	                            点击立即注册即表示同意并愿意遵守OHMY设计<a href="javascript:;">《用户协议》</a>和<a href="javascript:;">《版权声明》</a>
	                        </div>
	                    </div>
	                    <button type="button" id="register_submit">立即注册</button>
	                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
	                </form>
                </div>
            </div>
		</div>
	</div>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function(){

		if ('ontouchstart' in window) {
	        var click = 'touchstart';
	    } else {
	        var click = 'click';
	    }

	    /*
	    * 验证昵称是否合法
	    * */
	    function isStandard(str){   var isStandard = /^([\u4e00-\u9fa5A-Za-z0-9-_]){3,20}$/;  if(isStandard.test(str)){   return true;  }   return false; }
	    /*
	    * 邮箱是否合法
	    * */
	    function isEmail(str){   var isEmail = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;  if(isEmail.test(str)){   return true;  }   return false; }
	    /*
	    * 判断密码合法
	    * */
	    function isPassword(str){ var isPassword = /^.{3,20}$/; if(isPassword.test(str)){ return true;} return false; }
		
		//记住用户名
		$(document).ready(function () {
			
		    if ($.cookie("rmbUser") == "true") {
		    $("#ck_rmbUser").attr("checked", 'true');
		    $("#login_email").val($.cookie("username"));
		    //$("#login_password").val($.cookie("password"));
		    }
		});
		 
		    
		//取消记住用户名密码的功能（安全考虑）
		function Save() {
		    if ($("#ck_rmbUser").prop("checked")) {
		      var str_username = $("#login_email").val();
		      //var str_password = $("#login_password").val();
		      $.cookie("rmbUser", "true", { expires: 7 }); //存储一个带7天期限的cookie
		      $.cookie("username", str_username, { expires: 7 });
		      //$.cookie("password", str_password, { expires: 7 });
		    }
		    else {
		      $.cookie("rmbUser", "false", { expire: -1 });
		      $.cookie("username", "", { expires: -1 });
		      //$.cookie("password", "", { expires: -1 });
		    }
		};
		
	    $('#login_submit').on('click',function(){
	        var data = $("#loginForm").serialize();
	        var url  = "{{url('login-do')}}";
	        $.post(url,data,function(rs){
	            if(rs.status==0)
	            {
	                $("#login_"+rs.field).parent().find(".error_info").text(rs.info);
	            }else{
	                window.location.href ="{{url('index')}}";
	            }
	        });
	        Save();
	    })
	    
	    $(document).keypress(function(e){
	    	var e = window.event || e;
	    	if(e.keyCode == 13){
	    		var data = $("#loginForm").serialize();
		        var url  = "{{url('login-do')}}";
		        $.post(url,data,function(rs){
		            if(rs.status==0)
		            {
		                //console.info(rs.field);
		                $("#login_"+rs.field).parent().find(".error_info").text(rs.info);
		            }else{
		
		                window.location.href ="{{url('index')}}";
		            }
		        });
		        Save();
	    	}
	    });

	    $('#register_submit').on('click',function(){
	        $(".error_info").text("");
	        var data = $("#regForm").serialize();
	        var url  = "{{url('reg-save')}}";
	        $.post(url,data,function(rs){
	            if(rs.status==0)
	            {
	                console.info(rs);
	                if(rs.field == 'code'){
	                    $("#register_"+rs.field).parent().parent().find(".error_info").text(rs.info);
	                }else{
	                    $("#register_"+rs.field).parent().find(".error_info").text(rs.info);
	                }

	            }else{

	                window.location.href ="{{url('user')}}";
	            }
	        });
	    })

	    /*
	    * 验证密码
	    * */
	    $("#register_password").blur(function(){
	        var password = $(this).val();
	        if(isPassword(password)){
	            $('#register_password').removeClass("error");
	            $("#register_password").parent().find(".error_info").text("");
	        }else{
	            $("#register_password").parent().find(".error_info").text("请输入6-20位密码");
	            $("#register_password").addClass("error");
	        }
	    });
	    $("#new_password").blur(function(){
	        var password = $(this).val();
	        if(isPassword(password)){
	            $('#register_password').removeClass("error");
	            $("#register_password").parent().find(".error_info").text("");
	        }else{
	            $("#register_password").parent().find(".error_info").text("请输入6-20位密码");
	            $("#register_password").addClass("error");
	        }
	    });
	    $('#user_intr').keyup(function(){
	        //输入字符后键盘up时触发事件
	        var txtLeng = $('#user_intr').val().length;      //把输入字符的长度赋给txtLeng
	        //拿输入的值做判断
	        if( txtLeng>20 ){
	            alert("个人简介不超过20个字。");
	            $('#user_intr').parent().find(".max_size").addClass("over");
	        }else{
	        //输入长度小于300时span显示300减去长度
	            $('#user_intr').parent().find(".size").text(txtLeng);
	            $('#user_intr').parent().find(".max_size").removeClass("over");
	        }
	    });
	    /*

	    * 登录注册切换

	    * */

	    $(".tab_item .register_item").on(click,function(){

	        $(this).addClass("active");

	        $(".tab_item .login_item").removeClass("active");

	        $(".tab_content .register_content").removeClass("hide");

	        $(".tab_content .login_content").addClass("hide");

	    });

	    $(".tab_item .login_item").on(click,function(){

	        $(this).addClass("active");

	        $(".tab_item .register_item").removeClass("active");

	        $(".tab_content .login_content").removeClass("hide");

	        $(".tab_content .register_content").addClass("hide");

	    });		
	});
</script>
</body>
</html>