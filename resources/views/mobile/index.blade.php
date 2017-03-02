@include('mobile.header')
	<div class='index_bg'></div>
	<div class='featured'>
		<img src="{{asset('/mobile/img/featured.png')}}">
		<div class='featured_left1'></div>
		<div class='featured_left2'></div>
		<div class='featured_left3'></div>
		<div class='featured_right1'></div>
		<div class='featured_right2'></div>
		<div class='cards_list'>
			<ul>
				@foreach($work as $v)
				<li class='clearfix'>
					<a href="{{url('invention-detail')}}">
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
						<div class='name'>{{$v->author}}&nbsp;&nbsp;{{$v->age}}岁</div>
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
		<span class='other'>换一批</span>
	</div>
	<div class='activity'>
		<img src="{{asset('/mobile/img/activity.png')}}">
		<span class='intro'>通过丰富的活动开发孩子们有趣而又大胆的想象力</span>
		<span class='intro'>并激发他们对“发明”这一概念的好奇心</span>
		<div class='clearfix'>
			<img src="{{asset('/mobile/img/activity1.png')}}">
			<img src="{{asset('/mobile/img/activity2.png')}}">
			<img src="{{asset('/mobile/img/activity3.png')}}">
		</div>
		<span class='trip'>
			<a href="javascript:;">足迹</a>
		</span>
		<span class='activity_left1'></span>
		<span class='activity_left2'></span>
		<span class='activity_left3'></span>
		<span class='activity_right1'></span>
		<span class='activity_right2'></span>
	</div>
	<div class='designer'>
		<img src="{{asset('/mobile/img/designer.png')}}">
		<div id="lista1" class="als-container">
			<span class="als-prev"><img src="{{asset('/mobile/img/designer_left.png')}}"></span>
			<span class="als-next"><img src="{{asset('/mobile/img/designer_right.png')}}"></span>
			<div class="d_comments als-viewport">		    	
		        <ul class="clearfix als-wrapper">
					@foreach($designers as $v)
		            <li class="als-item">
			            <div class='als_div'>
							<img class='avatar' src="{{asset('/mobile/img/avatar_bg.png')}}">
		                    <p>
		                    	<img src="{{$urls.$v->avatar}}" width="100%">
		                    </p>		                
			                <div class="name">{{$v->designer->truename}}</div>
			                <div class="company">{{$v->designer->company}}</div>
			                <div class="position">{{$v->designer->job}}</div>
			            </div>		                	                    
		            </li>
					@endforeach
		        </ul>		        		       				
		    </div>
		</div>
	</div>
	<div class='support_bg'></div>
	<div class='support'>
		<img src="{{asset('/mobile/img/support.png')}}">
		<div class='intro'>
			<span>30余家设计师及创客组织、教育机构和社会团体已经加入我们</span>
			<span>共同为实现孩子们的梦想而努力</span>
		</div>
		<div class='des'>
			<div class='title'>设计师与创客组织</div>
			<ul class='clearfix'>
				@foreach($links[0] as $v)
					<li><img src="{{$urls.$v->logo}}"></li>
				@endforeach
			</ul>
		</div>
		<div class='edu'>
			<div class='title'>教育机构</div>
			<ul class='clearfix'>
				@foreach($links[1] as $v)
					<li><img src="{{$urls.$v->logo}}"></li>
				@endforeach
			</ul>
		</div>
		<div class='soc'>
			<div class='title'>社会团体</div>
			<ul class='clearfix'>
				@foreach($links[2] as $v)
					<li><img src="{{$urls.$v->logo}}"></li>
				@endforeach
			</ul>
		</div>
	</div>

<script type="text/javascript" src="{{asset('/mobile/js/jquery.als-1.7.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/mobile/js/index.js')}}"></script>
@include('mobile.footer')
