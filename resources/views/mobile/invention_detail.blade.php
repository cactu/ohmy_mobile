@include('mobile.header')
<div class='wrap1'>
	<div class='painting'>
		<img src="{{$urls.$data->thumb}}">
		<span class='num'>{{$data->id}}</span>
		@if($data->isrec)
		<span class='recommend'></span>
		@endif
	</div>
	<div class='painting_author'>
		<img src="{{$urls.$data->pic}}">
		<p class='work'>{{$data->title}}</p>
		<div class='author clearfix'>
			<p class='name'>{{$data->author}} &nbsp;
				@if($data->age == 0)
					保密
				@else
					{{$data->age}}岁
				@endif
			</p>
			<p class='cate clearfix'>
				<img src="{{$urls.$data->cate->pic}}">
				<span>{{$data->cate->name}}</span>
			</p>
		</div>
	</div>
	@foreach($part as $v)
	<div class='painting_join clearfix'>
		<span>创意征集</span>
		<p class='clearfix'>
			<img src="{{$urls.$v->user->avatar}}">
		</p>
		<!-- <span>等待热心设计师加入</span> -->
	</div>
	@endforeach
	<div class='painting_details'>
		{!!$data->contents!!}
	</div>
	<div class='painting_more'>
		<p>更多发明</p>
		<div class='cards_list'>
			<ul>
				@foreach($more as $v)
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
							@endif</div>
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
	</div>
	<div class='painting_footer'>
		
	</div>
</div>
</div>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('/mobile/js/common.js')}}"></script>
</body>
</html>