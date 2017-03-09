@include('mobile.header')
<div class='wrap1'>
	<div class="swiper-container inventions_swiper">
	    <div class="swiper-wrapper">
			@foreach($news as $v)
	        <div class="swiper-slide">
	            <a href="javascript:;" target="_blank">
	            <img src="{{$urls.$v->banner}}">
	            </a>
	        </div>
			@endforeach
	    </div>
	    <!-- Add Pagination -->
	    <div class="swiper-pagination"></div> 
	</div>

	<div class="cate clearfix">
	    <ul class='clearfix'>
	        <li class="shixian {{$order=='plan'?'active':''}}" data-order = 'plan'>
				<a href="{{url('inventions'.'?order=plan')}}">
					<span></span><p>实现</p>
				</a>
			</li>
	        <li class="tuijian {{$order=='isrec'?'active':''}}" data-order = 'isrec'>
				<a href="{{url('inventions'.'?order=isrec')}}">
					<span></span><p>推荐</p>
				</a>
			</li>
	    	<li class="zuixin {{$order=='new'?'active':''}}" data-order = 'new'>
				<a href="{{url('inventions'.'?order=new')}}">
					<span></span><p>最新</p>
				</a>
			</li>
	    </ul>
	</div>
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
	<div class='more_inventions'>
		<span>查看更多</span>
	</div>
</div>
<div class='returnTop'></div>
@include('mobile.footer')
<script type="text/javascript" src="//cdn.bootcss.com/Swiper/3.1.2/js/swiper.min.js"></script>
<script>
	/*轮播图配置*/
	$(document).ready(function(){
		var swiper = new Swiper('.swiper-container', {
	        pagination: '.swiper-pagination',
	        paginationClickable: true,
	        nextButton: '.swiper-button-next',
	        prevButton: '.swiper-button-prev',
	        loop: true,
	        autoplay: 3000,
	        autoplayDisableOnInteraction : false	
	    });
	})

	/*查看更多*/
	if ('ontouchstart' in window) {
	    var click = 'touchstart';
	} else {
	    var click = 'click';
	}
	var $more = $('.more_inventions');
	var $cate = $('.cate');
	var plan_count = 0;
	var isrec_count = 0;
	var new_count = 0;
	var count;
	$more.on(click,function(){
		var order = $cate.find('li.active').attr( 'data-order' )
		//console.log(order);
		if(order == 'plan'){
			plan_count += 1;
			count = plan_count;
		}else if(order == 'isrec'){
			isrec_count += 1;
			count = isrec_count;
		}else if(order == 'new' ){
			new_count += 1;
			count = new_count;
		}
		console.log(count);
		$.ajax({
			type:'post',
			data:{count:count,order:order},
			url:'{{url('many')}}',
			beforeSend:function(){
				$more.find('span').css({'border':'none'}).empty();
				$more.find('span').html("<img src='{{asset('/mobile/img/loading.gif')}}' style='height:0.5rem;'>");
			},
			success:function(rs){
				console.log(rs);
				$more.find('span').css({'border':'1px solid #aaa9aa'}).html('查看更多');
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
							$.each(item.partin,function(index,rst){
								var li_avatar = $('<li>');
								var img4 = $('<img>').attr('src',item.urls+rst.avatar);
								li_avatar.append(img4);
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

