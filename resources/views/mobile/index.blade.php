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
<script type="text/javascript">

if ('ontouchstart' in window) {
    var click = 'touchstart';
} else {
    var click = 'click';
}

$('.featured .other').on(click,function(){
	//console.log(111)
	$.ajax({
		type:'post',
		url:"{{url('others')}}",
		success:function(rs){
			//console.log(rs)
			$('.cards_list>ul').empty();
			if(rs.status == 1){
				$.each(rs.data,function(index,item){
					//console.log(item)
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
						$.each(item.part,function(index,rst){
							var li_avatar = $('<li>');
							var img4 = $('<img>').attr('src',item.urls+rst.avatar);
							li_avatar.append(img5);
							involved_ul.append(li_avatar);
						})
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
			}
		}
	})
})
</script>