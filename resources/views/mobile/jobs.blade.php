@extends('layouts.atah-m')

@section('script')
<script type="text/javascript">  
//标签点击切换
	$(function(){
		$(".scroller li").click(function() {
			$(this).siblings('li').removeClass('cur');  
			$(this).addClass('cur');   
		});
	});           
</script>  
@endsection

@section('content')
@include('partial.nav-m', ['home'=>'', 'profile'=>'', 'works'=>'', 'media'=>'', 'events'=>'', 'jobs'=>'act'])

<div class="toF">
    <div class="clearfix">
      <div class="dl_img">
		<img src="{{$job->path}}"/>
	  </div>
    </div>
</div>

<script type="text/javascript">
    window.onresize=autodivsize; //浏览器窗口发生变化时同时变化DIV
    function autodivsize(){ //函数：获取尺寸
        var winHeight=0;
        var winWidth=0;
        if (window.innerWidth){
            winWidth = window.innerWidth;
        } else {
            if ((document.body) && (document.body.clientWidth))
                winWidth = document.body.clientWidth;
        }
        if ((document.documentElement) && (document.documentElement.clientWidth))
            {winWidth = document.documentElement.clientWidth;}
        $('.L_menu .bar').css ("width",winWidth);
        $('.L_menu .bar').css ("left",-winWidth);
		

    }
    autodivsize();
</script>
@endsection