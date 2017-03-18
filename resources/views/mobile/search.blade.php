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
	@endif

	@if($num > 8)
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
<div class='returnTop'></div>
@include('mobile.footer')
<script type="text/javascript">
	//判断移动端还是pc端点击事件
    if ('ontouchend' in window) {
        var click = 'touchend';
    } else {
        var click = 'click';
    }

    var count = 0;
    var $more = $('.more_inventions span');    
    $more.on(click,function(){
    	var keyword = $('.search_title span').html()
    	
    	count += 1;
    	//console.log(keyword+' '+count)
    	$.ajax({
			type:'post',
			data:{count:count,keyword:keyword},
			url:'{{url('much')}}',
			beforeSend:function(){
				$more.css({'border':'none'}).empty();
				$more.html("<img src='{{asset('/mobile/img/loading.gif')}}' style='height:0.5rem;'>");
			},
			success:function(rs){
				//console.log(rs);				
				if(rs.status == 1){
					$more.css({'border':'1px solid #aaa9aa'}).html('查看更多');
					$.each(rs.data,function(index,item){
						var img1 = $('<img>').attr('src',item.urls+item.thumb);
						var num = $('<span>').attr('class','num').html(item.id);					
						var img2 = $('<img>').attr('src','{{asset('/mobile/img/recommend.png')}}');
						var recommend = $('<span>').attr('class','recommend').append(img2);
						var img_holder = $('<div>').attr('class','img_holder');
						img_holder.append(img1).append(num).append(recommend);

						var title = $('<div>').attr('class','title').html(item.title);

						var name = $('<div>').attr('class','name');
						if(item.age == 0){
							name.html(item.author + '&nbsp;&nbsp;' + '保密')
						}else{
							name.html(item.author + '&nbsp;&nbsp;' + item.age + '岁')
						}

						var involved = $('<div>').attr('class','involved clearfix');
						if(item.count == 0){
							var img3 = $('<img>').attr('src','{{asset('/mobile/img/nobody.png')}}');
							var none = $('<span>').attr('class','none').html('等待热心设计师加入');
							involved.append(img3).append(none);
						}else if(item.count > 0){
							var involved_ul = $('<ul>').attr('class','clearfix')
							var inven = $('<li>').attr('class','inven').html('创意实现:');
							involved_ul.append(inven);
							var img4 = $('<img>').attr('src',item.urls+item.avatar);
							var avatar = $('<li>').attr('class','clearfix').append(img4);
							involved_ul.append(avatar);
							if(item.count > 1){
								var  more = $('<li>').attr('class','more').html('•••');
								involved_ul.append(more);
								involved.append(involved_ul);
							}else if(item.count == 1){
								involved.append(involved_ul)
							}
						}
						var work_a = $('<a>').attr('href','invention-detail/'+item.id);
						work_a.append(img_holder).append(title).append(name).append(involved);
						var _li = $('<li>').append(work_a);
						$('.cards_list>ul').append(_li);
					})
				}else if(rs.status == 2){
					$more.css({'display':'none'});
					return;
				}
			}
		})
    })
</script>