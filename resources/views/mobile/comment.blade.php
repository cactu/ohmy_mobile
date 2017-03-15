@include('mobile.header')
<div class='wrap1 comment'>
	<div class='title'>评论</div>	
	<div class='hide_bg'></div>
	<ul>
		@foreach($comments as $v)
		<li class='comment_item clearfix'>
			<div class='people clearfix'>
				<div class="avatar">
					<!--用户头像，如果没有就设置为默认头像-->
					<img src="{{$urls.($v->user->avatar?$v->user->avatar:'/dream/img/avatar.jpg')}}" width="100%">
				</div>
				<span class='name'>{{$v->user->username or ''}}</span>
				<span class='time'>{{$v->created_at}}</span>
			</div>
			<div class='voice'>
				<p>
					@if($v->reply)
						@ {{ $v->reply->username or ''}} :
					@endif
					{{$v->contents}}
				</p>
				<div class='reply clearfix'><i class="iconfont">&#xe618;</i><span>回复</span></div>
				<form id="replyForm" method="post" action="{{url('comment-save')}}">
					<textarea autofocus="autofocus" name="contents" style="resize:none;" placeholder="写评论" class="text"></textarea>
					<input type="hidden" name="work_id" value="{{$v->work_id}}" />
					<input type="hidden" name="pid" value="{{$v->user_id}}" />
					<div class="sub_reply" id="btnReply">回复</div>
				</form>
			</div>
		</li>
		@endforeach
	</ul>
	<div class="reply_content">
		<form id="commentForm" method="post" action="{{url('comment-save')}}">
			<textarea name="contents" style="resize:none;" placeholder="写评论" class="text"></textarea>
			<input type="hidden" name="work_id" value="{{$v->work_id}}" />
			<div class="sub_comment">发送</div>
		</form>
		<!-- <div class='login_text'>
			别默默的看了，快<span><a href="{{url('login')}}">登录</a></span>帮我点评一下吧！
		</div> -->
	</div>
</div>
</div>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('/mobile/js/common.js')}}"></script>
</body>
</html>