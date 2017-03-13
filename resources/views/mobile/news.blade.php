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
		<!-- <img src="{{asset('/mobile/img/less.png')}}"> -->
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
			<span>
				<a href="{{url('new-list')}}">查看更多</a>
			</span>
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
<script type="text/javascript">
	/*活动相关查看更多*/
	if ('ontouchstart' in window) {
	    var click = 'touchstart';
	} else {
	    var click = 'click';
	}

	var $more = $('.about .more span')
	var count = 0;
	$more.on(click,function(){
		count += 1;
		//console.log(count)
		$.ajax({
			type:'post',
			data:{count:count},
			url:'{{url('mores')}}',
			beforeSend:function(){
				$more.css({'border':'none'}).empty();
				$more.html("<img src='{{asset('/mobile/img/loading.gif')}}' style='height:0.5rem;'>");
			},
			success:function(rs){
				//console.log(rs);
				$more.css({'border':'1px solid #aaa9aa'}).html('查看更多');
				if(rs.status == 1){
					$.each(rs.data,function(index,item){
						//console.log(item.id)
						var img1 = $('<img>').attr('src',rs.urls+item.pic);
						var name = $('<span>').attr('class','name').html(item.title)

						var clock = $('<span>').attr('class','clock');
						var span1 = $('<span>').html('发布时间:');
						var time = $('<span>').attr('class','time').html(item.created_at);
						var p = $('<p>').attr('class','clearfix').append(clock).append(span1).append(time);

						var li = $('<li>').attr('class','clearfix').append(img1).append(name).append(p);
						li.on(click,function(){
							window.location.href = 'news-detail/'+item.id;
						})
						$('.aboutList ul').append(li);
					})
				}else if(rs.status == 2){
					$more.css({'display':'none'});
					return;
				}
			}
		})
	})
</script>