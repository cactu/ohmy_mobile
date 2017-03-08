@include('mobile.header')
<div class='wrap1'>
	<div class="swiper-container inventions_swiper">
	    <div class="swiper-wrapper">
			@foreach($news as $v)
	        <div class="swiper-slide">
	            <a href="javascript:;" target="_blank">
	            <img src="{{$urls.$v->banner}}">
	            </a>
	        </div>
			@endforeach
	    </div>
	    <!-- Add Pagination -->
	    <div class="swiper-pagination"></div> 
	</div>

	<div class="cate clearfix">
	    <ul class='clearfix'>
	        <li class="shixian {{$order=='plan'?'active':''}}">
				<a href="{{url('inventions'.'?order=plan')}}">
					<span></span><p>实现</p>
				</a>
			</li>
	        <li class="tuijian {{$order=='isrec'?'active':''}}">
				<a href="{{url('inventions'.'?order=isrec')}}">
					<span></span><p>推荐</p>
				</a>
			</li>
	    	<li class="zuixin {{$order=='new'?'active':''}}">
				<a href="{{url('inventions'.'?order=new')}}">
					<span></span><p>最新</p>
				</a>
			</li>
	    </ul>
	</div>
	<div class='cards_list'>
		<ul>
			@foreach($work as $v)
			<li class='clearfix'>
				<a href="{{url('invention-detail',$v->id)}}">
					<div class='img_holder'>
						<img src="{{$urls.$v->thumb}}">
						<span class='num'>{{$v->id}}</span>
						@if($v->isrec)
						<span class='recommend'>
							<img src="{{asset('/mobile/img/recommend.png')}}">
						</span>
						@endif
					</div>
					<div class='title'>{{$v->title}}</div>
					<div class='name'>{{$v->author}}&nbsp;&nbsp;
						@if($v->age == 0)
							保密
						@else
							{{$v->age}}岁
						@endif
					</div>
					<div class='involved clearfix'>
						@if($v->partin->count()==0)
						<img src="{{asset('/mobile/img/nobody.png')}}">
						<span class='none'>等待热心设计师加入</span>
						@else
							@foreach($v->partin->take(1) as $h)
							<ul class='clearfix'>
								<li class='inven'>创意实现:</li>
								<li class='clearfix'>
									<img src="{{$urls.$h->avatar}}">
								</li>
								<li class="more">•••</li>
							</ul>
							@endforeach
						@endif
					</div>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
	<div class='more_inventions'>
		<span>查看更多</span>
	</div>
</div>
<div class='returnTop'></div>
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

