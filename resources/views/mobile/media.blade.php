@extends('layouts.atah-m')

@section('script')
<script type="text/javascript">
//标签点击and滚条切换
$(function(){
	 $(window).scroll(function(){
		  //为页面添加页面滚动监听事件
		  var wst =  $(window).scrollTop() //滚动条距离顶端值
			for (i=1; i<4; i++){             //加循环
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
@include('partial.nav-m', ['home'=>'', 'profile'=>'', 'works'=>'', 'media'=>'act', 'events'=>'', 'jobs'=>''])

<div class="wrapper">
  <div class="scroller three_list">
    <ul class="clearfix">
      <li id="tp1" class="cur"><a href="#to1">{{trans('media.wechat')}}</a></li>
      <li id="tp2"><a href="#to2">{{trans('media.ins')}}</a></li>
      <li id="tp3"><a href="#to3">{{trans('media.video')}}</a></li>
    </ul>
  </div>
</div>

<div class="toF">
    <div id="to1" class="clearfix" style="height:1200px;">
      <div class="bk_bg2"></div>
      <div class="ewm_img"><img id="ewm" src="/images/atah_ewm.jpg" /></div>
    </div>
    <div id="to2" class="clearfix" style="height:1200px;">
    <div class="bk_bg2"></div>
    <strong>{{trans('media.comingSoon')}}</strong>
    </div>
    <div id="to3" class="clearfix" style="height:1200px;">
    <div class="bk_bg2"></div>
    <strong>{{trans('media.comingSoon')}}</strong>
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
        $('.L_menu .bar').css ("width",winWidth);
        $('.L_menu .bar').css ("left",-winWidth);
		$('.ewm_img').css ('paddingTop',document.documentElement.clientHeight / 2 - document.getElementById('ewm').offsetHeight / 2 - 110 +"px");

    }
    autodivsize();
</script>
@endsection