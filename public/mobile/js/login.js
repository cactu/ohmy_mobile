$(function(){
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
     /*
    * 用户名重复ajax验证
    * */
    $('#register_nickname').blur(function() {
        var nikename=$('#register_nickname').val();
//        alert(nikename);
        if(nikename.trim()!=""){
            if(isStandard(nikename)){
                $.ajax({
                    url: "http://www.baidu.com",
                    type:"post",
                    dataType: 'json',
                    data: "nikename="+nikename,
                    beforeSend: function(){
                        $('#register_nickname').parent().find(".register_loading").removeClass("hide");
                        $('#register_nickname').parent().find(".register_checked").addClass("hide");
                    },
                    success: function(msg){
                        //昵称可用
                        if(msg){
                            $('#register_nickname').parent().find(".register_loading").addClass("hide");
                            $('#register_nickname').parent().find(".register_checked").removeClass("hide");
                            $('#register_nickname').removeClass("error");
                            $("#register_nickname").parent().find(".error_info").text("");
                        //昵称不可用
                        }else{
                            $("#register_nickname").parent().find(".error_info").text("此昵称已被占用");
                        }

                    }
                });
            }else{
                $("#register_nickname").parent().find(".error_info").text("昵称3-20字符，仅支持字母/中文/数字/下划线");
                $("#register_nickname").addClass("error");
            }

        }
        else{
            $("#register_nickname").parent().find(".error_info").text("昵称不能为空");
            $("#register_nickname").addClass("error");
        }

    });
    /*
    * 验证邮箱
    * */
    $("#register_email").blur(function(){
        var email = $(this).val();
        if(isEmail(email)){
            $.ajax({
                url: "http://www.baidu.com",
                type:"post",
                dataType: 'json',
                data: "nikename="+nikename,
                beforeSend: function(){
                    $("#register_email").parent().find(".register_loading").removeClass("hide");
                    $("#register_email").parent().find(".register_checked").addClass("hide");
                },
                success: function(){
                    //邮箱有效时执行
                    $("#register_email").parent().find(".register_loading").addClass("hide");
                    $("#register_email").parent().find(".register_checked").removeClass("hide");
                    $('#register_email').removeClass("error");
                    $("#register_email").parent().find(".error_info").text("");
                }
            });
        }else{
                $("#register_email").parent().find(".error_info").text("请输入有效的邮箱");
                $("#register_email").addClass("error");
        };
    });
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
    $(".uc_info .active .btn_bind").text("解绑");
    $(".user_nav ul li").click(function(){
        var index = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");;
        $(".user_nav_content .uc_info:eq("+index+")").css("display","block").siblings().css("display","none");
    });
    /*
    * 登录注册切换
    * */
    $(".login_tab .register_item").click(function(){
        $(this).addClass("active");
        $(".login_tab .register_item").removeClass("active");
        $(".login_tab .register_content").removeClass("hide");
        $(".login_tab .login_content").addClass("hide");
    });
    $(".login_tab .login_item").click(function(){
        $(this).addClass("active");
        $(".login_tab .login_item").removeClass("active");
        $(".login_tab .login_content").removeClass("hide");
        $(".login_tab .register_content").addClass("hide");
    });
});