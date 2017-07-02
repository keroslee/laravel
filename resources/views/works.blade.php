@extends('layouts.atah')

@section('content')
<script src="js/css3-mediaqueries.min.js"></script> 
<script type="text/javascript">
//只适应放大列表
$(function(){
	$(".setlist ul li .rsp").hide();
	$(".setlist ul li .text").hide();
	$(".setlist	 ul li").hover(function(){
		$(this).find(".rsp").stop().fadeTo(200,0.75)
		$(this).find(".text").stop().fadeTo(200,1)
		$(this).find(".photo img").addClass( "big");
		$(this).find(".photo img").removeClass( "small")
	},function(){
		$(this).find(".rsp").stop().fadeTo(200,0)
		$(this).find(".text").stop().fadeTo(200,0)
		$(this).find(".photo img").addClass( "small");
		$(this).find(".photo img").removeClass( "big")
	});
});

    window.onload=auto_boxs;
	function auto_boxs()
	{
        $('.scroller').css ('width',document.documentElement.clientWidth -76 +"px");
		$('.setlist li').css('width',document.documentElement.clientWidth *0.2499 +"px")
		$('.setlist li').css('height',(document.documentElement.clientWidth *0.2499) *0.671815 +"px")
	}
	auto_boxs();
	window.onresize=auto_boxs;
</script>
<script type="text/javascript">  
//标签点击切换
	$(function(){
		$(".wrapper li").click(function() {
			$(this).siblings('li').removeClass('cur');  
			$(this).addClass('cur');   
		});
	});           
</script>  

</head>
<body>

@include('partial.nav', ['home'=>'', 'profile'=>'', 'works'=>'act', 'media'=>'', 'events'=>'', 'jobs'=>''])

<div class="wrapper">
  <div class="scroller">
    <ul class="clearfix five_list">
      <li class="{{$tagCur?'':'cur'}}"><a href="/works">全部</a></li>
	  @foreach($tags as $tag)
      <li class="{{$tag->id==$tagCur?'cur':''}}"><a href="/works/{{$tag->id}}">{{$tag[$loc]}}</a></li>
	  @endforeach
    </ul>
  </div>
</div>
<div class="bk_bg2"></div>
<div class="setlist">
  <ul class="clearfix">
    @foreach($works as $work)
	  <li>
	    <a href="/wk_details/{{$work->id}}">
            <div class="photo"><img class="small"  data-original="{{$work->thumb}}" src="/images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>{{$work['name_'.$loc]}}</h1>
              <em>{{$work->time}}</em>
            </div>
        </a>
	  </li>
    @endforeach
	</ul>
	<div class="clear"></div>
</div>


<script src="js/jquery.lazyload.js?v=1.9.1"></script>
<script type="text/javascript" charset="utf-8">
//图片延迟加载
	jQuery(document).ready( 
	function($){ 
		$("img.small").lazyload({ 
			placeholder : "/images/grey.gif", 
			effect      : "fadeIn",
			threshold : 50
		}); 
	}); 
</script>
@endsection