@include('mobile.header')
<div class='wrap1'>
	<div class="swiper-container inventions_swiper">
	    <div class="swiper-wrapper">            
	        <div class="swiper-slide">
	            <a href="javascript:;" target="_blank">
	            <img src="{{asset('/mobile/img/test4.jpg')}}">
	            </a>
	        </div>
	        <div class="swiper-slide">
	            <a href="javascript:;" target="_blank">
	            <img src="{{asset('/mobile/img/test4.jpg')}}">
	            </a>
	        </div>
	        <div class="swiper-slide">
	            <a href="javascript:;" target="_blank">
	            <img src="{{asset('/mobile/img/test5.jpg')}}">
	            </a>
	        </div>
	        <div class="swiper-slide">
	            <a href="javascript:;" target="_blank">
	            <img src="{{asset('/mobile/img/test4.jpg')}}">
	            </a>
	        </div>
	        <div class="swiper-slide">
	            <a href="javascript:;" target="_blank">
	            <img src="{{asset('/mobile/img/test5.jpg')}}">
	            </a>
	        </div>
	    </div>
	    <!-- Add Pagination -->
	    <div class="swiper-pagination"></div>
	    <!-- Add Arrows  --> 
	    <div class="swiper-button-next"></div>
	    <div class="swiper-button-prev"></div>  
	</div>

	<div class="cate clearfix">
	    <ul class='clearfix'>
	        <li class="shixian active">
				<a href="javascript:;">
					<span></span><p>实现</p></a></li>
	        <li class='tuijian'>
				<a href="javascript:;">
					<span></span><p>推荐</p></a></li>
	    	<li class='zuixin'>
				<a href="javascript:;">
					<span></span><p>最新</p></a></li>
	    </ul>
	</div>
	<div class='cards_list'>
		<ul>
			<li class='clearfix'>
				<a href="{{url('invention_detail')}}" target='_blank'>
					<div class='img_holder'>
						<img src="{{asset('/mobile/img/test.jpg')}}">
						<span class='num'>4444</span>
						<span class='recommend'>
							<img src="{{asset('/mobile/img/recommend.png')}}">
						</span>							
					</div>
					<div class='title'>哈哈哈哈哈哈哈哈哈哈哈哈</div>
					<div class='name'>李小明&nbsp;&nbsp;8岁</div>
					<div class='involved clearfix'>
						<!-- <img src="{{asset('/mobile/img/nobody.png')}}">
						<span class='none'>等待热心设计师加入</span> -->
						<ul class='clearfix'>
							<li class='inven'>创意实现:</li>
							<li class='clearfix'>
								<img src="{{asset('/mobile/img/test1.png')}}">
							</li>
							<li class="more">•••</li>
						</ul>
					</div>
				</a>
			</li>
			<li class='clearfix'>
				<a href="{{url('invention_detail')}}" target='_blank'>
					<div class='img_holder'>
						<img src="{{asset('/mobile/img/test.jpg')}}">
						<span class='num'>4444</span>
						<span class='recommend'>
							<img src="{{asset('/mobile/img/recommend.png')}}">
						</span>							
					</div>
					<div class='title'>哈哈哈哈哈哈哈哈哈哈哈哈</div>
					<div class='name'>李小明&nbsp;&nbsp;8岁</div>
					<div class='involved clearfix'>
						<!-- <img src="{{asset('/mobile/img/nobody.png')}}">
						<span class='none'>等待热心设计师加入</span> -->
						<ul class='clearfix'>
							<li class='inven'>创意实现:</li>
							<li class='clearfix'>
								<img src="{{asset('/mobile/img/test1.png')}}">
							</li>
							<li class="more">•••</li>
						</ul>
					</div>
				</a>
			</li>
			<li class='clearfix'>
				<a href="{{url('invention_detail')}}" target='_blank'>
					<div class='img_holder'>
						<img src="{{asset('/mobile/img/test.jpg')}}">
						<span class='num'>4444</span>
						<span class='recommend'>
							<img src="{{asset('/mobile/img/recommend.png')}}">
						</span>							
					</div>
					<div class='title'>哈哈哈哈哈哈哈哈哈哈哈哈</div>
					<div class='name'>李小明&nbsp;&nbsp;8岁</div>
					<div class='involved clearfix'>
						<img src="{{asset('/mobile/img/nobody.png')}}">
						<span class='none'>等待热心设计师加入</span>
						<!-- <ul class='clearfix'>
							<li class='inven'>创意实现:</li>
							<li class='clearfix'>
								<img src="{{asset('/mobile/img/test1.png')}}">
							</li>
							<li class="more">•••</li>
						</ul> -->
					</div>
				</a>
			</li>
			<li class='clearfix'>
				<a href="{{url('invention_detail')}}" target='_blank'>
					<div class='img_holder'>
						<img src="{{asset('/mobile/img/test.jpg')}}">
						<span class='num'>4444</span>
						<span class='recommend'>
							<img src="{{asset('/mobile/img/recommend.png')}}">
						</span>							
					</div>
					<div class='title'>哈哈哈哈哈哈哈哈哈哈哈哈</div>
					<div class='name'>李小明&nbsp;&nbsp;8岁</div>
					<div class='involved clearfix'>
						<!-- <img src="{{asset('/mobile/img/nobody.png')}}">
						<span class='none'>等待热心设计师加入</span> -->
						<ul class='clearfix'>
							<li class='inven'>创意实现:</li>
							<li class='clearfix'>
								<img src="{{asset('/mobile/img/test1.png')}}">
							</li>
							<li class="more">•••</li>
						</ul>
					</div>
				</a>
			</li>
			<li class='clearfix'>
				<a href="{{url('invention_detail')}}" target='_blank'>
					<div class='img_holder'>
						<img src="{{asset('/mobile/img/test.jpg')}}">
						<span class='num'>4444</span>
						<span class='recommend'>
							<img src="{{asset('/mobile/img/recommend.png')}}">
						</span>							
					</div>
					<div class='title'>哈哈哈哈哈哈哈哈哈哈哈哈</div>
					<div class='name'>李小明&nbsp;&nbsp;8岁</div>
					<div class='involved clearfix'>
						<!-- <img src="{{asset('/mobile/img/nobody.png')}}">
						<span class='none'>等待热心设计师加入</span> -->
						<ul class='clearfix'>
							<li class='inven'>创意实现:</li>
							<li class='clearfix'>
								<img src="{{asset('/mobile/img/test1.png')}}">
							</li>
							<li class="more">•••</li>
						</ul>
					</div>
				</a>
			</li>
			<li class='clearfix'>
				<a href="{{url('invention_detail')}}" target='_blank'>
					<div class='img_holder'>
						<img src="{{asset('/mobile/img/test.jpg')}}">
						<span class='num'>4444</span>
						<span class='recommend'>
							<img src="{{asset('/mobile/img/recommend.png')}}">
						</span>							
					</div>
					<div class='title'>哈哈哈哈哈哈哈哈哈哈哈哈</div>
					<div class='name'>李小明&nbsp;&nbsp;8岁</div>
					<div class='involved clearfix'>
						<!-- <img src="{{asset('/mobile/img/nobody.png')}}">
						<span class='none'>等待热心设计师加入</span> -->
						<ul class='clearfix'>
							<li class='inven'>创意实现:</li>
							<li class='clearfix'>
								<img src="{{asset('/mobile/img/test1.png')}}">
							</li>
							<li class="more">•••</li>
						</ul>
					</div>
				</a>
			</li>
			<li class='clearfix'>
				<a href="{{url('invention_detail')}}" target='_blank'>
					<div class='img_holder'>
						<img src="{{asset('/mobile/img/test.jpg')}}">
						<span class='num'>4444</span>
						<span class='recommend'>
							<img src="{{asset('/mobile/img/recommend.png')}}">
						</span>							
					</div>
					<div class='title'>哈哈哈哈哈哈哈哈哈哈哈哈</div>
					<div class='name'>李小明&nbsp;&nbsp;8岁</div>
					<div class='involved clearfix'>
						<!-- <img src="{{asset('/mobile/img/nobody.png')}}">
						<span class='none'>等待热心设计师加入</span> -->
						<ul class='clearfix'>
							<li class='inven'>创意实现:</li>
							<li class='clearfix'>
								<img src="{{asset('/mobile/img/test1.png')}}">
							</li>
							<li class="more">•••</li>
						</ul>
					</div>
				</a>
			</li>
		</ul>
	</div>
	<div class='more_inventions'>
		<span>查看更多</span>
	</div>
</div>

@include('mobile.footer')
<script type="text/javascript" src="//cdn.bootcss.com/Swiper/3.1.2/js/swiper.min.js"></script>
<script>
/*轮播图配置*/
$(document).ready(function(){
	var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        loop: true,
        autoplay: 3000,
        autoplayDisableOnInteraction : false	
    });
})

/*查看更多*/

if ('ontouchstart' in window) {
    var click = 'touchstart';
} else {
    var click = 'click';
}

var $more = $('.more_inventions');
$more.on(click,function(){
	console.log(111);
	$more.find('span').css({'border':'none'}).empty();
	$more.find('span').html("<img src='{{asset('/mobile/img/loading.gif')}}' style='height:0.5rem;'>");
})
</script>

