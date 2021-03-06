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
	<div class='news_banner'>
		<img src="{{$urls.$detail->banner}}">
	</div>
	<div class='news_content'>
		<div class='title'>
			<p>{{$detail->title}}</p>
			<span>时间：{{$detail->created_at}}</span>
		</div>
		<div class='content'>
			{!! $detail->contents !!}
		</div>
	</div>
	<div class='details_footer clearfix'>
		<div class='footer_comment clearfix'>
			<a href="{{url('comment-article',$detail->id)}}">
				<input type="text" disabled="disabled" placeholder="评论...">				
			</a>
		</div>
		<div class='details_tab'>
			<div class='footer_commenticon clearfix'>
				<a href="{{url('comment-article',$detail->id)}}">
					<span class='icon'></span>
					<span class='num'>
						@if($comments->count() > 99)
							•••
						@else
							{{$comments->count()}}
						@endif
					</span>
				</a>			
			</div>
			<div class='like clearfix' data-id="{{$detail->id}}">
				<span class='num'>
					@if($detail->zan > 99)
						•••
					@else
						{{$detail->zan}}
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
<!-- <div class='returnTop'></div> -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('/mobile/js/common.js')}}"></script>
<input name="user_id" id="user_id" type="hidden" value="{{Session::has('user')?Session::get('user')->id:''}}" />
<script type="text/javascript">
	//判断移动端还是pc端点击事件
    if ('ontouchend' in window) {
        var click = 'touchend';
    } else {
        var click = 'click';
    }
	/*点赞*/
	$(document).ready(function(){
		if(!checklogin()){
			var id = $(".like").data('id');
			if(localStorage.getItem('news'+id)){
				$(".like").addClass('active');    	            
			}
		}
	})

	$('.details_tab .like').on(click,function(){
			var id     = $(this).data('id');
            var url    = '{{url('savezan')}}';
            //console.log(id)
		if(checklogin()){
            //console.log(id)
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
        	if(localStorage.getItem('news'+id)){
        		return;
        	}else{     		                    
                localStorage.setItem('news'+id,id);
                //console.log(id)
        		//如果未点赞，则需要将数据传到后台,
        		$.get(url,{id:id},function(rs){
        			//console.log(rs)
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