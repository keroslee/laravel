@extends('layouts.atah')

@section('content')
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

</head>
<body>

@include('partial.nav', ['home'=>'', 'profile'=>'', 'works'=>'', 'media'=>'act', 'events'=>'', 'jobs'=>''])

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
    <div id="to1" class="clearfix">
    <div class="bk_bg"></div>
    <div class="pheight">
      <div class="ewm_img"><img id="ewm" src="/images/atah_ewm.jpg" /></div>
    </div>
    </div>
    <div id="to2" class="clearfix">
    <div class="bk_bg"></div>
    <div style="height:100%">
      @foreach($media as $m)
      <img src="{{$m->path}}" style="width:100%;padding-top:1em">
	  @endforeach
    </div>
    </div>
    <div id="to3" class="clearfix">
    <div class="bk_bg"></div>
    <div class="pheight">
      <div class="text_fn"><strong id="txt">{{trans('media.comingSoon')}}</strong></div>
    </div>
    </div>
</div>

<script type="text/javascript">
window.onload = function(){
	  auto_boxs()
	};
window.onresize = function(){
	  auto_boxs()
	};
	function auto_boxs()
	{
        $('.scroller').css ('width',document.documentElement.clientWidth -76 +"px");
        $('.ewm_img').css ('paddingTop',document.documentElement.clientHeight / 2 - document.getElementById('ewm').offsetHeight / 2 +"px");
		$('.pheight').css ('height',document.documentElement.clientHeight -50 +"px");
        $('.text_fn').css ('paddingTop',document.documentElement.clientHeight / 2 - document.getElementById('txt').offsetHeight / 2 +"px");
	}
	auto_boxs();
</script>
@endsection