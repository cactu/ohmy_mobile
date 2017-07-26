<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
    <title>小小发明家</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1, minimum-scale=1">
	<link rel="stylesheet" href="//cdn.bootcss.com/normalize/4.2.0/normalize.min.css">
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/mobile/css/qrCode.css')}}">
	<script type="text/javascript" src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script>
    (function resizeFont(){
        document.documentElement.style.fontSize=document.documentElement.clientWidth/7.5+'px';
    })();    	    
    </script>
</head>
<body>
	<div class='wrap'>
        <form id='qrForm'>
            <div>
                <div class='input_group name'>
                    <span class='title'>小朋友姓名：</span>
                    <input type="text" name="name">
                </div>                
                <div class='error'></div>
            </div>
            <div>
                <div class='input_group'>
                    <div class='age'>
                        <p class='title'>年龄：</p>
                        <input type="tel" name="age">
                    </div>
                    <div class='sex'>
                        <p class='title'>性别：</p>
                        <input type="radio" name="sex" value="1" checked/>男
                        <input type="radio" name="sex" value="2" />女
                    </div>
                    
                </div>
                <div class='error'></div>
            </div>
            <div>
                <div class='input_group phone'>
                    <p class='title'>手机：</p>
                    <input type="tel" name="phone">
                </div>
                <div class='error'></div>
            </div>
            <div>
                <div class=' check'>
                    <p class='title'>验证码：</p>
                    <input type="text" name="check">
                    <div>
                        <input type="button" name="send" class='send' value='发送验证码'>
                        <div class='door'></div>
                    </div>
                    
                </div>
                <div class='error'></div>
            </div>            
            <div class='submit'>
                <img src="{{asset('/mobile/img/qr_send.png')}}" id="qrSubmit"/>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
        </form>
    </div>

    
</body>
<script type="text/javascript" src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript" src="{{asset('/mobile/js/qrCode.js')}}"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
    
</script>
</html>