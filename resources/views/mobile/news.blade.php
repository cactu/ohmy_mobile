@include('mobile.header')
<div class='wrap1'>
	<div class='map'>
		<div class='title'></div>
		<div class='map_img'></div>
		<span class='map_left1'></span>
		<span class='map_left2'></span>
		<span class='map_left3'></span>
		<span class='map_right1'></span>
		<span class='map_right2'></span>
	</div>
	<div class='announce'>
		<div class='title'>
			<img src="{{asset('/mobile/img/announce_title.png')}}">
		</div>
		<img src="{{asset('/mobile/img/test11.png')}}">
		<img src="{{asset('/mobile/img/test11.png')}}">
	</div>
	<div class='news'>
		<div class='title'>
			<img src="{{asset('/mobile/img/news_title.png')}}">
		</div>
		<div class='newsList'>
			<ul>
				<li class='clearfix'>
					<a href="javascript:;" class='clearfix'>
						<img src="{{asset('/mobile/img/test12.jpg')}}">
						<span class='work_cate'>
							<img src="{{asset('/mobile/img/gongzuo.png')}}">
						</span>
						<span class='where'>上海长宁区育苗幼儿</span>
						<span class='time'>2016年11月29日 上午9:30-11:00</span>
					</a>
				</li>
				<li class='clearfix'>
					<a href="javascript:;" class='clearfix'>
						<img src="{{asset('/mobile/img/test12.jpg')}}">
						<span class='work_cate'>
							<img src="{{asset('/mobile/img/gongzuo.png')}}">
						</span>
						<span class='where'>上海长宁区育苗幼儿</span>
						<span class='time'>2016年11月29日 上午9:30-11:00</span>
					</a>
				</li>
				<li class='clearfix'>
					<a href="javascript:;" class='clearfix'>
						<img src="{{asset('/mobile/img/test12.jpg')}}">
						<span class='work_cate'>
							<img src="{{asset('/mobile/img/chuangyi.png')}}">
						</span>
						<span class='where'>上海长宁区育苗幼儿</span>
						<span class='time'>2016年11月29日 上午9:30-11:00</span>
					</a>
				</li>
				<li class='clearfix'>
					<a href="javascript:;" class='clearfix'>
						<img src="{{asset('/mobile/img/test12.jpg')}}">
						<span class='work_cate'>
							<img src="{{asset('/mobile/img/chuangyi.png')}}">
						</span>
						<span class='where'>上海长宁区育苗幼儿</span>
						<span class='time'>2016年11月29日 上午9:30-11:00</span>
					</a>
				</li>
			</ul>
		</div>
		<div class='more'>
			<a href="{{url('new-list')}}">查看更多</a>
		</div>
	</div>
	<div class='about'>
		<div class='title'>
			<img src="{{asset('/mobile/img/about_title.png')}}">
		</div>
		<div class='aboutList'>
			<ul>
				<li class='clearfix'>
					<a href="javascript:;">
						<img src="{{asset('/mobile/img/test13.png')}}">
						<span class='name'>Little Inventors 创意工作坊，用废纸变出一只会动的“小动物”</span>
						<p class='clearfix'>
							<span class='clock'></span>
							<span>发布时间:</span>
							<span class='time'>2016/11/30</span>
						</p>
					</a>
				</li>
				<li class='clearfix'>
					<a href="javascript:;">
						<img src="{{asset('/mobile/img/test13.png')}}">
						<span class='name'>Little Inventors 创意工作坊，用废纸变出一只会动的“小动物”</span>
						<p class='clearfix'>
							<span class='clock'></span>
							<span>发布时间:</span>
							<span class='time'>2016/11/30</span>
						</p>
					</a>
				</li>
				<li class='clearfix'>
					<a href="javascript:;">
						<img src="{{asset('/mobile/img/test13.png')}}">
						<span class='name'>Little Inventors 创意工作坊，用废纸变出一只会动的“小动物”</span>
						<p class='clearfix'>
							<span class='clock'></span>
							<span>发布时间:</span>
							<span class='time'>2016/11/30</span>
						</p>
					</a>
				</li>
			</ul>
		</div>
		<div class='more'>
			<span>查看更多</span>
		</div>
	</div>
</div>
<div class='returnTop'></div>
@include('mobile.footer')
<script type="text/javascript">
	/*活动相关查看更多*/
	if ('ontouchstart' in window) {
	    var click = 'touchstart';
	} else {
	    var click = 'click';
	}

	var $more = $('.about .more span')
	var count = 1;
	$more.on(click,function(){
		$.ajax({
			type:'post',
			data:{count:count},
			url:'{{url('mores')}}',
			beforeSend:function(){
				$more.css({'border':'none'}).empty();
				$more.html("<img src='{{asset('/mobile/img/loading.gif')}}' style='height:0.5rem;'>");
			},
			success:function(rs){
				console.log(rs);
			}
		})
	})
</script>