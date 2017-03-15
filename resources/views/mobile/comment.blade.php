@include('mobile.header')
<div class='wrap1 comment'>
	<div class='title'>评论</div>	
	<div class='hide_bg'></div>
	<ul>
		<li class='comment_item clearfix'>
			<div class='people clearfix'>
				<div class="avatar">
					<!--用户头像，如果没有就设置为默认头像-->
					<img src="{{asset('/mobile/img/test14.jpg')}}" width="100%">
				</div>
				<span class='name'>洋葱zzz</span>
				<span class='time'>2017年10月13日</span>
			</div>
			<div class='voice'>
				<p>用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像</p>
				<div class='reply clearfix'><i class="iconfont">&#xe618;</i><span>回复</span></div>
				<form id="replyForm" method="post" action="">
					<textarea autofocus="autofocus" name="contents" style="resize:none;" placeholder="写评论" class="text"></textarea>
					<input type="hidden" name="work_id" value="" />
					<input type="hidden" name="_token" value="" />
					<div class="sub_reply" id="btnReply">回复</div>
				</form>
			</div>
		</li>
		<li class='comment_item clearfix'>
			<div class='people clearfix'>
				<div class="avatar">
					<!--用户头像，如果没有就设置为默认头像-->
					<img src="{{asset('/mobile/img/test14.jpg')}}" width="100%">
				</div>
				<span class='name'>洋葱zzz</span>
				<span class='time'>2017年10月13日</span>
			</div>
			<div class='voice'>
				<p>用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像</p>
				<div class='reply clearfix'><i class="iconfont">&#xe618;</i><span>回复</span></div>
				<form id="replyForm" method="post" action="">
					<textarea autofocus="autofocus" name="contents" style="resize:none;" placeholder="写评论" class="text"></textarea>
					<input type="hidden" name="work_id" value="" />
					<input type="hidden" name="_token" value="" />
					<div class="sub_reply" id="btnReply">回复</div>
				</form>
			</div>
		</li>
		<li class='comment_item clearfix'>
			<div class='people clearfix'>
				<div class="avatar">
					<!--用户头像，如果没有就设置为默认头像-->
					<img src="{{asset('/mobile/img/test14.jpg')}}" width="100%">
				</div>
				<span class='name'>洋葱zzz</span>
				<span class='time'>2017年10月13日</span>
			</div>
			<div class='voice'>
				<p>用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像用户头像，如果没有就设置为默认头像</p>
				<div class='reply clearfix'><i class="iconfont">&#xe618;</i><span>回复</span></div>
				<form id="replyForm" method="post" action="">
					<textarea autofocus="autofocus" name="contents" style="resize:none;" placeholder="写评论" class="text"></textarea>
					<input type="hidden" name="work_id" value="" />
					<input type="hidden" name="_token" value="" />
					<div class="sub_reply" id="btnReply">回复</div>
				</form>
			</div>
		</li>
	</ul>
	<div class="reply_content">
		<form id="commentForm" method="post" action="">
			<textarea name="contents" style="resize:none;" placeholder="写评论" class="text"></textarea>
			<input type="hidden" name="work_id" value="" />
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