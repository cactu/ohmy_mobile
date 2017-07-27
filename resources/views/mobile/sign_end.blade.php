<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
    <title>小小发明家</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1, minimum-scale=1">
	<link rel="stylesheet" href="//cdn.bootcss.com/normalize/4.2.0/normalize.min.css">
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script type="text/javascript" src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script>
    (function resizeFont(){
        document.documentElement.style.fontSize=document.documentElement.clientWidth/7.5+'px';
    })();    	    
    </script>
    <style type="text/css">
        html, body {
            width:7.5rem;   
            max-height:100vh;           
            font-family: Arial,Helvetica,'Hiragino Sans GB','Microsoft YaHei',sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        body{   
            overflow-x:hidden;
            overflow-y: hidden;
            position:relative;
            background:url('{{asset('/mobile/img/signed.png')}}') no-repeat;
            background-size:7.5rem;            
        }
        a:hover, a:visited, a:link, a:active{
            text-decoration: none;
        }
        a{
            display:inline-block;
            position: absolute;
            top:10rem;
            left:50%;
            margin-left:-0.9rem;

        }
        img{            
            width:1.8rem;
        }
    </style>
</head>
<body>
        <a href="{{url('index')}}"><img src="{{asset('/mobile/img/signed_btn.png')}}"></a>
</body>
<script type="text/javascript" src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</html>