@include('mobile.header')
<div class='news'>
	<div class='title'>
		<img src="{{asset('/mobile/img/news_title.png')}}">
	</div>
	<div class='newsList'>
		<ul>
			@foreach($article as $v)
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
		<a href="javascript:;">查看更多</a>
	</div>
</div>
<div class='returnTop'></div>
@include('mobile.footer')