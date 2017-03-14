@include('mobile.header')
<div class='wrap1 searchDiv'>
	<p class='search_title'>关于“<span>{{$keyword}}</span>”的搜索结果</p>
	@if($list->count() > 0)
	<div class='cards_list'>
		<ul>
			@foreach($list as $v)
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
						<ul class='clearfix'>
							<li class='inven'>创意实现:</li>
							@foreach($v->partin->take(1) as $h)
							<li class='clearfix'>
								<img src="{{$urls.$h->user->avatar}}">
							</li>
							@endforeach
							<li class="more">•••</li>
						</ul>
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
	@endif

	@if($list->count() == 0)
	<p class='search_none'>哎呀~没有找到你想要的发明~可以看看其他发明哟</p>
	<div class='painting_more'>
		<p>更多发明</p>
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
								<ul class='clearfix'>
									<li class='inven'>创意实现:</li>
									@foreach($v->partin->take(1) as $h)
									<li class='clearfix'>
										<img src="{{$urls.$h->user->avatar}}">
									</li>
									@endforeach
									<li class="more">•••</li>
								</ul>
							@endif
						</div>
					</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	@endif
</div>
@include('mobile.footer')