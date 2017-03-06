@include('mobile.header')
<div class='wrap1'>
	<div class='painting'>
		<img src="{{asset('/mobile/img/test.jpg')}}">
		<span class='num'>4444</span>
		<span class='recommend'></span>
	</div>
	<div class='painting_author'>
		<img src="{{asset('/mobile/img/test6.jpg')}}">
		<p class='work'>啊哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈</p>
		<div class='author clearfix'>
			<p class='name'>李小明 &nbsp;8岁 </p>
			<p class='cate clearfix'>
				<img src="{{asset('/mobile/img/test7.png')}}">
				<span>家居</span>
			</p>
		</div>
	</div>
	<div class='painting_join clearfix'>
		<span>创意征集</span>
		<p class='clearfix'>
			<img src="{{asset('/mobile/img/test8.png')}}">
			<img src="{{asset('/mobile/img/test9.png')}}">
			<img src="{{asset('/mobile/img/test10.png')}}">
		</p>
	</div>
	<div class='painting_details'>
		它是一个多功能雨伞，顶上的红白部分是指南针，如果迷失方向，手表上会显示东、南、西、北。黑色部分可以收缩，让雨伞变得可以给一至四人使用。蓝色的部分可以遮挡斜雨或风。即使戴在身上，人也不会觉得这把伞重。
	</div>
	<div class='painting_more'>
		<p>更多发明</p>
		<div class='cards_list'>
			<ul>
				<li class='clearfix'>
					<a href="javascript:;">
						<div class='img_holder'>
							<img src="{{asset('/mobile/img/test.jpg')}}">
							<span class='num'>4444</span>
							<span class='recommend'>
								<img src="{{asset('/mobile/img/recommend.png')}}">
							</span>							
						</div>
						<div class='title'>哈哈哈哈哈哈哈哈哈哈哈哈</div>
						<div class='name'>李小明&nbsp;&nbsp;8岁</div>
						<div class='involved clearfix'>
							<!-- <img src="{{asset('/mobile/img/nobody.png')}}">
							<span class='none'>等待热心设计师加入</span> -->
							<ul class='clearfix'>
								<li class='inven'>创意实现:</li>
								<li class='clearfix'>
									<img src="{{asset('/mobile/img/test1.png')}}">
								</li>
								<li class="more">•••</li>
							</ul>
						</div>
					</a>
				</li>
				<li class='clearfix'>
					<a href="javascript:;">
						<div class='img_holder'>
							<img src="{{asset('/mobile/img/test.jpg')}}">
							<span class='num'>4444</span>
							<span class='recommend'>
								<img src="{{asset('/mobile/img/recommend.png')}}">
							</span>							
						</div>
						<div class='title'>哈哈哈哈哈哈哈哈哈哈哈哈</div>
						<div class='name'>李小明&nbsp;&nbsp;8岁</div>
						<div class='involved clearfix'>
							<!-- <img src="{{asset('/mobile/img/nobody.png')}}">
							<span class='none'>等待热心设计师加入</span> -->
							<ul class='clearfix'>
								<li class='inven'>创意实现:</li>
								<li class='clearfix'>
									<img src="{{asset('/mobile/img/test1.png')}}">
								</li>
								<li class="more">•••</li>
							</ul>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class='painting_footer'>
		
	</div>
</div>
</div>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('/mobile/js/common.js')}}"></script>
</body>
</html>