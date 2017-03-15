@include('mobile.header')
<style type="text/css">
.jiathis_style_32x32 .jtico_qzone{
	background:url('{{asset('/mobile/img/qzone.png')}}') no-repeat left;
	background-size:32px 32px;
}
.jiathis_style_32x32 .jtico_tsina{
	background:url('{{asset('/mobile/img/weibo.png')}}') no-repeat left;
	background-size:32px 32px;
}
.jiathis_style_32x32 .jtico_cqq{
	background:url('{{asset('/mobile/img/qq.png')}}') no-repeat left;
	background-size:32px 32px;
}
</style>
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
	<div class='painting_join clearfix'>
	@if($part->count())
		@foreach($part as $v)
		<span>创意征集</span>
		<p class='clearfix'>
			<img src="{{$urls.$v->user->avatar}}">
		</p>
		@endforeach
	@else
		<span>等待热心设计师加入</span>
	@endif
	</div>

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
										<img src="{{$urls.$h->user->avatar}}">
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
	<div class='details_footer clearfix'>
		<div class='footer_comment clearfix'>
			<a href="{{url('comment',$data->id)}}">
				<input type="text" disabled="disabled" placeholder="评论...">				
			</a>
		</div>
		<div class='details_tab'>
			<div class='footer_commenticon clearfix'>
				<a href="{{url('comment')}}">
					<span class='icon'></span>
					<span class='num'>
						@if($data->comment->count() > 99)
							•••
						@else
							{{$data->comment->count()}}
						@endif
					</span>
				</a>			
			</div>
			<div class='like clearfix'>
				<span class='num'>
					@if($data->likes > 99)
						•••
					@else
						{{$data->likes}}
					@endif
				</span>
			</div>
			<div class='share'>
				<span class='share_tab'></span>
			</div>
		</div>
		<div class='share_div'>
			<!-- JiaThis Button BEGIN -->
			<div class="jiathis_style_32x32 tab">
				<a class="jiathis_button_qzone"></a>
				<a class="jiathis_button_tsina"></a>
				<a class="jiathis_button_cqq"></a>
			</div>
			<div class='del'>
				<span>取消</span>
			</div>
		</div>			
		<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
		<!-- JiaThis Button END -->
	</div>
</div>
</div>
<div class='returnTop'></div>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('/mobile/js/common.js')}}"></script>
</body>
</html>