@extends('layouts.atah-m')

@section('content')

@include('partial.nav-m', ['home'=>'', 'profile'=>'', 'works'=>'', 'media'=>'', 'events'=>'act', 'jobs'=>''])

<div class="dl_img">
@foreach($events as $event)
	<img src="{{$event->path}}"/>
@endforeach
</div>



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
		
    }
    autodivsize();
</script>
@endsection