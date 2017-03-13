@include('mobile.header')
<div class='wrap1'>
	<div class='news list'>
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
			<span>查看更多</span>
		</div>
	</div>
</div>
<div class='returnTop'></div>
@include('mobile.footer')
<script type="text/javascript">
	/*活动报道查看更多*/
	if ('ontouchstart' in window) {
	    var click = 'touchstart';
	} else {
	    var click = 'click';
	}

	var $more = $('.list .more span');
	var count = 0 ;
	$more.on(click,function(){
		count += 1;
		$.ajax({
			type:'post',
			data:{count:count},
			url:'{{url('lots')}}',
			beforeSend:function(){
				$more.css({'border':'none'}).empty();
				$more.html("<img src='{{asset('/mobile/img/loading.gif')}}' style='height:0.5rem;'>");
			},
			success:function(rs){
				$more.css({'border':'1px solid #aaa9aa'}).html('查看更多');
				console.log(rs);
				if( rs.status == 1){
					$.each(rs.data,function(index,item){
						var img1 = $('<img>').attr('src',rs.urls+item.pic);
						var work_cate = $('<span>').attr('class','work_cate')
						if(item.cate_id == 2){
							var img2 = $('<img>').attr('src',"{{asset('/mobile/img/gongzuo.png')}}");
						}else if(item.cate_id == 3){
							var img2 = $('<img>').attr('src',"{{asset('/mobile/img/chuangyi.png')}}");
						}
						work_cate.append(img2);
						var where = $('<span>').attr('class','where').html(item.place);
						var time = $('<span>').attr('class','time').html(item.time);

						var li = $('<li>').attr('class','clearfix').append(img1).append(work_cate).append(where).append(time);
						li.on(click,function(){
							window.location.href = 'news-detail/'+item.id;
						})

						$('.list .newsList ul').append(li);
					})
				}else{
					$more.css({'display':'none'});
					return;
				}
				
			}
		})
	})
</script>