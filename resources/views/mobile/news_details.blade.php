@include('mobile.header')
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
			<a href="{{url('comment')}}">
				<input type="text" disabled="disabled" placeholder="评论...">				
			</a>
		</div>
		<div class='details_tab'>
			<div class='footer_commenticon clearfix'>
				<a href="{{url('comment')}}">
					<span class='icon'></span>
					<span class='num'>11</span>
					<!-- <span class='num'>•••</span> -->
				</a>			
			</div>
			<div class='like clearfix' data-id=" ">
			<!-- <span class='num'>•••</span> -->
				<span class='num'>0</span>
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
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('/mobile/js/common.js')}}"></script>
</body>
</html>