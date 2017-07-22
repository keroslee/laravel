@extends('layouts.atah-m')

@section('style')
<link rel="stylesheet" href="/css/jquery.fullPage.css">
@endsection

@section('script')
<script type="text/javascript">
//首屏默认先隐藏;最后一屏幕向下箭头删除
$(document).ready(function(){
    $("#fullpage .section:first .pt_title em").css("display","none");
    $("#fullpage .section:first .pt_text2 p").css("display","none");
    $("#fullpage .section:last .dn_lding").addClass("nots");
});
</script>
<script src="/js/jquery.fullPage.js" type="text/javascript"></script>
<script src="/js/m_fullPage_true.js" type="text/javascript"></script><!--手机滚屏参数【首页】，已预写20页;添加以div【class="section"】为一屏-->
@endsection

@section('content')

@include('partial.nav-m', ['home'=>'act', 'profile'=>'', 'works'=>'', 'media'=>'', 'events'=>'', 'jobs'=>''])

<div id="uptop">
	<a data-menuanchor="page1" class="active" id="totop" href="#page1">第一屏【作返回顶部】</a>
</div>
<div id="fullpage" class="allmian">
  <div class="section" style="background-image: url({{$homes->get(0)->path_mobile}});">
    <div class="pp_title">
      <i class="sp1" rel="-235,0,0,0"><div class="top_Atah top_Atah_p1" style="display:none;"><span>ATAH</span></div></i>
    </div>
    <div class="pp_cont box_cont1">
      <div class="tx_lt to_one">
        <div class="pos_rel ts1a ts_r" rel="750,0,0,0">
          <div class="pt_title pt_Rb2">
            <em><a href="{{$homes->get(0)->target}}">{{$homes->get(0)->name}}</a></em>
          </div>
          <div class="pt_title_bor pt_Rb2"></div>
        </div>
        <div class="pt_text2 pt_Rb2 pos_rel ts1b ts_r" rel="750,0,0,0">
            <p>{{$homes->get(0)->desc}}</p>
            <p>{{$homes->get(0)->addr}}</p>
        </div>
      </div>
      <div class="dn_lding" style="display:none;"><a data-menuanchor="page2" id="totop" href="#page2"><img src="/images/down_landing.png" /></a></div>
    </div>
  </div>
  <div class="section" style="background-image: url({{$homes->get(1)->path_mobile}});">
    <div class="pp_cont box_cont2">
      <div class="tx_rt to_one">
        <div class="pos_rel ts2a ts_l" rel="-750,0,0,0">
          <div class="pt_title pt_Lb1">
            <em><a href="{{$homes->get(1)->target}}">{{$homes->get(1)->name}}</a></em>
          </div>
          <div class="pt_title_bor pt_Lb1"></div>
        </div>
        <div class="pt_text2 pt_Lb1 pos_rel ts2b ts_l" rel="-750,0,0,0">
            <p>{{$homes->get(1)->desc}}</p>
            <p>{{$homes->get(1)->addr}}</p>
        </div>
      </div>
      <div class="dn_lding"><a data-menuanchor="page3" id="totop" href="#page3"><img src="/images/down_landing.png" /></a></div>
    </div>
  </div>
  <div class="section" style="background-image: url({{$homes->get(2)->path_mobile}});">
    <div class="pp_title">
      <i class="sp3" rel="235,0,0,0"><div class="top_Logo top_Logo_p1"><span><img src="/images/top_logo.png"></span></div></i>
    </div>
    <div class="pp_cont box_cont1">
      <div class="tx_lt to_one">
        <div class="pos_rel ts3a ts_r" rel="750,0,0,0">
          <div class="pt_title pt_Rb2">
            <em><a href="{{$homes->get(2)->target}}">{{$homes->get(2)->name}}</a></em>
          </div>
          <div class="pt_title_bor pt_Rb2"></div>
        </div>
        <div class="pt_text2 pt_Rb2 pos_rel ts3b ts_r" rel="750,0,0,0">
            <p>{{$homes->get(2)->desc}}</p>
            <p>{{$homes->get(2)->addr}}</p>
        </div>
      </div>
      <div class="dn_lding"><a data-menuanchor="page4" id="totop" href="#page4"><img src="/images/down_landing.png" /></a></div>
    </div>
  </div>
  <div class="section" style="background-image: url({{$homes->get(3)->path_mobile}});">
    <div class="pp_cont box_cont2">
      <div class="tx_rt to_one">
        <div class="pos_rel ts4a ts_l" rel="-750,0,0,0">
          <div class="pt_title pt_Lb1">
            <em><a href="{{$homes->get(3)->target}}">{{$homes->get(3)->name}}</a></em>
          </div>
          <div class="pt_title_bor pt_Lb1"></div>
        </div>
        <div class="pt_text2 pt_Lb1 pos_rel ts4b ts_l" rel="-750,0,0,0">
          <p>{{$homes->get(3)->desc}}</p>
          <p>{{$homes->get(3)->addr}}</p>
        </div>
      </div>
      <div class="dn_lding"><a data-menuanchor="page5" id="totop" href="#page5"><img src="/images/down_landing.png" /></a></div>
    </div>
  </div>
  <div class="section" style="background-image: url({{$homes->get(4)->path_mobile}});">
    <div class="pp_cont box_cont1">
      <div class="tx_lt to_one">
        <div class="pos_rel ts5a ts_r" rel="750,0,0,0">
          <div class="pt_title pt_Rb2">
            <em><a href="{{$homes->get(4)->target}}">{{$homes->get(4)->name}}</a></em>
          </div>
          <div class="pt_title_bor pt_Rb2"></div>
        </div>
        <div class="pt_text2 pt_Rb2 pos_rel ts5b ts_r" rel="750,0,0,0">
          <p>{{$homes->get(4)->desc}}</p>
          <p>{{$homes->get(4)->addr}}</p>
        </div>
      </div>
      <div class="dn_lding"><a data-menuanchor="page6" id="totop" href="#page6"><img src="/images/down_landing.png" /></a></div>
    </div>
  </div>
  <div class="section" style="background-image: url({{$homes->get(5)->path_mobile}});">
    <div class="pp_cont box_cont2">
      <div class="tx_rt to_one">
        <div class="pos_rel ts6a ts_l" rel="-750,0,0,0">
          <div class="pt_title pt_Lb1">
            <em><a href="{{$homes->get(5)->target}}">{{$homes->get(5)->name}}</a></em>
          </div>
          <div class="pt_title_bor pt_Lb1"></div>
        </div>
        <div class="pt_text2 pt_Lb1 pos_rel ts6b ts_l" rel="-750,0,0,0">
          <p>{{$homes->get(5)->desc}}</p>
          <p>{{$homes->get(5)->addr}}</p>
        </div>
      </div>
      <div class="dn_lding"><a data-menuanchor="page7" id="totop" href="#page7"><img src="/images/down_landing.png" /></a></div>
    </div>
  </div>
  <div class="section" style="background-image: url({{$homes->get(6)->path_mobile}});">
    <div class="pp_cont box_cont1">
      <div class="tx_lt to_one">
        <div class="pos_rel ts7a ts_r" rel="750,0,0,0">
          <div class="pt_title pt_Rb2">
            <em><a href="{{$homes->get(6)->target}}">{{$homes->get(6)->name}}</a></em>
          </div>
          <div class="pt_title_bor pt_Rb2"></div>
        </div>
        <div class="pt_text2 pt_Rb2 pos_rel ts7b ts_r" rel="750,0,0,0">
            <p>{{$homes->get(6)->desc}}</p>
            <p>{{$homes->get(6)->addr}}</p>
        </div>
      </div>
      <div class="dn_lding"><a data-menuanchor="page8" id="totop" href="#page8"><img src="/images/down_landing.png" /></a></div>
    </div>
  </div>
  <div class="section" style="background-image: url({{$homes->get(7)->path_mobile}});">
    <div class="pp_cont box_cont2">
      <div class="tx_rt to_one">
        <div class="pos_rel ts8a ts_l" rel="-750,0,0,0">
          <div class="pt_title pt_Lb1">
            <em><a href="{{$homes->get(7)->target}}">{{$homes->get(7)->name}}</a></em>
          </div>
          <div class="pt_title_bor pt_Lb1"></div>
        </div>
        <div class="pt_text2 pt_Lb1 pos_rel ts8b ts_l" rel="-750,0,0,0">
            <p>{{$homes->get(7)->desc}}</p>
            <p>{{$homes->get(7)->addr}}</p>
        </div>
      </div>
      <div class="dn_lding"><a data-menuanchor="page9" id="totop" href="#page9"><img src="/images/down_landing.png" /></a></div>
    </div>
  </div>
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
        $('.section').css ("min-width",winWidth);
        $('.pp_title').css ("min-width",winWidth);
        $('.pp_cont').css ("min-width",winWidth);
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
        $('.section').css ("height",winHeight);
        $('.pp_title').css ("height",winHeight);
        $('.pp_cont').css ("height",winHeight);
    }
    autodivsize();
</script>
@endsection