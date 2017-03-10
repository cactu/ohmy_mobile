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
		@foreach($preview as $v)
		<img src="{{$urls.$v->pic}}">
		@endforeach
	</div>
	<div class='news'>
		<div class='title'>
			<img src="{{asset('/mobile/img/news_title.png')}}">
		</div>
		<div class='newsList'>
			<ul>
				@foreach($report as $v)
				<li class='clearfix'>
					<a href="{{url('news-detail',$v->id)}}" class='clearfix'>
						<img src="{{$urls.$v->pic}}">
						<span class='work_cate'>
							@if($v->cate_id == 2)
							<img src="{{asset('/mobile/img/gongzuo.png')}}">
							@elseif($v->cate_id == 3)
							<img src="{{asset('/mobile/img/chuangyi.png')}}">
							@endif
						</span>
						<span class='where'>{{$v->place}}</span>
						<span class='time'>{{$v->time}}</span>
					</a>
				</li>
				@endforeach
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
				@foreach($article as $v)
				<li class='clearfix'>
					<a href="{{url('news-detail',$v->id)}}">
						<img src="{{$urls.$v->pic}}">
						<span class='name'>{{$v->title}}</span>
						<p class='clearfix'>
							<span class='clock'></span>
							<span>发布时间:</span>
							<span class='time'>{{$v->created_at}}</span>
						</p>
					</a>
				</li>
				@endforeach
			</ul>
		</div>
		<div class='more'>
			<span>查看更多</span>
		</div>
	</div>
</div>
<div class='returnTop'></div>
@include('mobile.footer')