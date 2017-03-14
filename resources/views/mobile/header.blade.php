<!DOCTYPE html>
<html>
<!-- 百度流量统计 -->
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
    <title>{{$webTitle}}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta name="Keywords" content="Little Inventors,小小发明家,LI小小发明家,发明,儿童创意,儿童教育,脑洞,梦想实现,设计,设计师,创意作品展示,创意灵感" />
	<meta name="Description" content="Little Inventors小小发明家是由英国发明家Dominic Wilcox与OHMY Design共同发起的全球性儿童创意活动。我们将在全国各地征集4-14岁小朋友的创意发明，并与专业设计师合作，把小朋友的发明实现。我们将打造中国最完善的儿童创意教育体系，和孩子们一起，把世界变成我们想象的样子！" />
	<meta name='Googlebot' content='index, nofollow, archive'>
    
	<link rel="icon" href="{{asset('/dream/img/llogo.ico')}}" type="image/x-icon"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/normalize/4.2.0/normalize.min.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">   
    <link rel="stylesheet" href="//cdn.bootcss.com/Swiper/3.1.2/css/swiper.min.css">  
    <link rel="stylesheet" href="{{asset('/mobile/css/common.css')}}"> 	
	    
    <script type="text/javascript" src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
    (function resizeFont(){
        document.documentElement.style.fontSize=document.documentElement.clientWidth/7.5+'px';
    })()
    </script>
</head>
<body class='bodybg'>
    <nav class='navbar'>
        <span class='burger'></span>
        <span class='logo'></span>
        <span class='search'></span>
        <div class='search_div clearfix'>
            <form action="{{url('search')}}" name="srcForm" id="seaform" class='clearfix'>
                <i class="iconfont" id="sear">&#xe600;</i>
                <input type="text" name="keyword" placeholder="编号/作品名称/作者姓名" autofocus="autofocus">
            </form>
            <span class='del'><i class="iconfont">&#xe61c;</i></span>
        </div>
    </nav>
    <div class='menu'>
        <div class='login'>
            <img src="{{asset('/mobile/img/nav_logo.png')}}" alt='Little Inventors'>
            @if(Session::has('user'))
                <div class='avatar'>
                    <div class='pic'><img src="{{$urls.(Session::get('user')->avatar?Session::get('user')->avatar:'/dream/img/avatar.jpg')}}"></div>
                    <div class='name'>{{Session::get('user')->username}}</div>
                </div>
            @else                
                <div class='login_btn'>
                    <a href="{{url('login')}}">立即登录</a>
                </div>
            @endif
        </div>
        <ul>
            <li class='{{$nav=='index'?'active':''}}'>
                <a href="{{url('index')}}">首页</a>
            </li>
            <li class='{{$nav=='idea'?'active':''}}'>
                <a href="{{url('inventions')}}">小发明</a>
            </li>
            <li class='{{$nav=='news'?'active':''}}'>
                <a href="{{url('news')}}">足迹</a>
            </li>
            <li class='{{$nav=='active'?'active':''}}'>
                <a href="{{url('introduction')}}">活动简介</a>
            </li>
        </ul>
    </div>
    <div class='wrap'>
    <div class='door'></div>