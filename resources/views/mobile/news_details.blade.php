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
</div>
<div class='returnTop'></div>
@include('mobile.footer')