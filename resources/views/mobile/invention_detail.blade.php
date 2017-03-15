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
				<a href="{{url('comment',$data->id)}}">
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
			<div class='like clearfix' data-id="{{$data->id}}">
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
<input name="user_id" id="user_id" type="hidden" value="{{Session::has('user')?Session::get('user')->id:''}}" />
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('/mobile/js/common.js')}}"></script>
<script type="text/javascript">
	//判断移动端还是pc端点击事件
    if ('ontouchstart' in window) {
        var click = 'touchstart';
    } else {
        var click = 'click';
    }
	/*点赞*/
	$(document).ready(function(){
		if(!checklogin()){
			var id = $(".like").data('id');
			if(localStorage.getItem(id)){
				$(".like").addClass('active');    	            
			}
		}
	})

	$('.details_tab .like').on(click,function(){
		var id     = $(this).data('id');
        var url    = '{{url('savezan')}}';
		if(checklogin()){			            
            $.get(url,{id:id},function(rs){
            	//点赞
                if(rs.status==1)
                {
                    $('.like .num').html(rs.data);
                    
                    $(".like").addClass('active');    
                
                //取消点赞
                }else if(rs.status==2){
            		
            		$('.like .num').html(rs.data);
            		
                    $(".like").removeClass('active');    
                    
            	}
            });
		}else{
        	/*判断如果作品id存在于localstorage中，那么就表示已经点赞了，否则就进入另外一条路径*/
        	if(localStorage.getItem(id)){
        		return;
        	}else{       		                    
                localStorage.setItem(id,id);
        		//如果未点赞，则需要将数据传到后台,
        		$.get(url,{id:id},function(rs){
	                if(rs.status==1)
	                {
	                    $('.like .num').html(rs.data);
	                    $(".like").addClass('active');
	                }
	            });
        	}
		}
	})

	/*判断是否登录状态*/
	function checklogin() {
		if($("#user_id").val() == '') {
			return false;
		} else {
			return true;
		}
	}
</script>
</body>
</html>