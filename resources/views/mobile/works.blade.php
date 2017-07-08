@extends('layouts.atah-m')

@section('script')
<script type="text/javascript">
//列表适应大小
window.onload = function(){
	  autodivsize(), auto_boxs()
	};

	function auto_boxs()
	{
		$('.setlist li').css('width',document.documentElement.clientWidth *0.5 +"px")
		$('.setlist li').css('height',(document.documentElement.clientWidth *0.5) *0.671815 +"px")
	}
	auto_boxs();
	onresize=auto_boxs;

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
@include('partial.nav-m', ['home'=>'', 'profile'=>'', 'works'=>'act', 'media'=>'', 'events'=>'', 'jobs'=>''])

<script type="text/javascript">
//    window.onload=autodivsize;
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
		

        if (window.innerHeight){
            winHeight = window.innerHeight;
        } else {
            if ((document.body) && (document.body.clientHeight))
                winHeight = document.body.clientHeight;
        }
        if ((document.documentElement) && (document.documentElement.clientHeight))
            {winHeight = document.documentElement.clientHeight;}
    }
    autodivsize();
</script>

<div class="wrapper wrap2" id="wrapper02">
  <div class="scroller ten_list">
    <ul class="clearfix">
      <li ><a href="/works">全部</a></li>
	  @foreach($tags as $tag)
	  <li class="{{strlen($tag[$loc])>4?'bb':''}}"><a href="/works/{{$tag->id}}">{{$tag[$loc]}}</a></li>
	  @endforeach
    </ul>
  </div>
</div>
<!----------------------------------------------------------------------------------------------------->

<div class="bk_bg2" style="background:#121212;"></div>
<div class="setlist">
	<ul class="clearfix">
	@foreach($works as $work)
	  <li>
	    <a href="/wk_details/{{$work->id}}">
            <div class="photo">
			@if ($loop->index<10)
				<img class="small" src="{{$work->thumb}}">
			@else
				<img class="small" data-original="{{$work->thumb}}" src="../images/grey.gif">
			@endif
			</div>
			<div class="text">
              <h1>{{$work['name_'.$loc]}}</h1>
              <em>{{$work->time}}</em>
			  <div class="rsp"></div>
            </div>
        </a>
	  </li>
	@endforeach
	</ul>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	$(function(){
		$('.wrap2').navbarscroll({"defaultSelect":{{$tagCur?$tagCur:0}}});
	});
</script>

<script src="../js/jquery.lazyload.js?v=1.9.1"></script>
<script type="text/javascript" charset="utf-8">
//图片延迟加载
	jQuery(document).ready( 
	function($){ 
		$("img.small").lazyload({ 
			placeholder : "../images/grey.gif", 
			effect      : "fadeIn",
			threshold : 50
		}); 
	}); 
</script>
@endsection