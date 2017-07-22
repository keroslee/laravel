@extends('layouts.atah-m')

@section('script')
<script type="text/javascript">  
//标签点击and滚条切换
$(function(){
	 $(window).scroll(function(){
		  //为页面添加页面滚动监听事件
		  var wst =  $(window).scrollTop() //滚动条距离顶端值
			for (i=1; i<5; i++){             //加循环
			  if($("#to"+ i).offset().top <= wst){
				 $('.scroller li').removeClass("cur");
				 $("#tp" +i).addClass("cur");
			   }
			}
			   
	})
	$(".scroller li").click(function() {
		$(this).siblings('li').removeClass('cur');  
		$(this).addClass('cur');   
	});
});
</script>  
@endsection

@section('content')
@include('partial.nav-m', ['home'=>'', 'profile'=>'act', 'works'=>'', 'media'=>'', 'events'=>'', 'jobs'=>''])

<div class="wrapper">
  <div class="scroller four_list">
    <ul class="clearfix">
      <li id="tp1" class="cur"><a href="#to1">{{trans('menu.practice')}}</a></li>
      <li id="tp2"><a href="#to2">{{trans('menu.people')}}</a></li>
      <li id="tp3"><a href="#to3">{{trans('menu.manifesto')}}</a></li>
      <li id="tp4"><a href="#to4">{{trans('menu.contact')}}</a></li>
    </ul>
  </div>
</div>

<div class="toF">
    <div id="to1" class="clearfix">
      <div class="section" style="background-image: url({{$profiles->get('practice')->path}});"></div>
    </div>
    <div id="to2" class="clearfix">
    <div class="section" style="background-image: url({{$profiles->get('people')->path}});"></div>
    </div>
    <div id="to3" class="clearfix">
    <div class="section" style="background-image: url({{$profiles->get('manifesto')->path}});"></div>
    </div>
    <div id="to4" class="clearfix">
    <div class="section" style="background-image: url({{$profiles->get('contact')->path}});"></div>
    </div>
</div>

<script type="text/javascript">
    window.onload=autodivsize;
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

		if (window.innerHeight){
            winHeight = window.innerHeight;
        } else {
            if ((document.body) && (document.body.clientHeight))
                winHeight = document.body.clientHeight;
        }
        if ((document.documentElement) && (document.documentElement.clientHeight))
            {winHeight = document.documentElement.clientHeight;}

        $('.L_menu .bar').css ("width",winWidth);
        $('.L_menu .bar').css ("left",-winWidth);
		$('.section').css ("height",winHeight);
	}
    autodivsize();
</script>
@endsection