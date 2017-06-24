@extends('layouts.atah')

@section('content')
<script type="text/javascript">

    window.onload=auto_boxs;
	function auto_boxs()
	{
        $('.scroller').css ('width',document.documentElement.clientWidth -76 +"px");
	}
	auto_boxs();
	onresize=auto_boxs;
</script>
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

</head>
<body>

@include('partial.nav', ['home'=>'', 'profile'=>'act', 'works'=>'', 'media'=>'', 'events'=>'', 'jobs'=>''])

<div class="wrapper">
  <div class="scroller four_list">
    <ul class="clearfix">
      <li id="tp1" class="cur"><a href="#to1">Practice</a></li>
      <li id="tp2"><a href="#to2">People</a></li>
      <li id="tp3"><a href="#to3">Manifesto</a></li>
      <li id="tp4"><a href="#to4">Contact</a></li>
    </ul>
  </div>
</div>
<div class="toF">
    <div id="to1" class="imgsbox clearfix" style="min-height:1200px; background:#09F">
      <div class="bk_bg"></div>
      <strong>Practice</strong><!--去除上面style，该行替换图图片-->
    </div>
    <div id="to2" class="imgsbox clearfix" style="min-height:1200px; background:#F90">
    <div class="bk_bg"></div>
    <strong>People</strong><!--去除上面style，该行替换图图片-->
    </div>
    <div id="to3" class="imgsbox clearfix" style="min-height:1200px; background:#09F">
    <div class="bk_bg"></div>
    <strong>Manifesto</strong><!--去除上面style，该行替换图图片-->
    </div>
    <div id="to4" class="imgsbox clearfix" style="min-height:1200px; background:#F90">
    <div class="bk_bg"></div>
    <strong>Contact</strong><!--去除上面style，该行替换图图片-->
    </div>
</div>
@endsection