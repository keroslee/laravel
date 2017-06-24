<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> ATAH</title>
<link href="images/atah_logo.ico" rel="shortcut icon">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
<!--[if lt IE 9]>
  <script src="../js/html5shiv.min.js"></script>
<![endif]-->
<script src="js/sidebar.js" type="text/javascript"></script>
<script type="text/javascript">
//首屏默认先隐藏;最后一屏幕向下箭头删除
$(document).ready(function(){
    $("#fullpage .section:first .pt_title em").css("display","none");
    $("#fullpage .section:first .pt_text2 p").css("display","none");
    $("#fullpage .section:last .dn_lding").addClass("nots");
});
</script>
<script src="js/jquery.fullPage.js" type="text/javascript"></script>
<script type="text/javascript" src="js/fullPage_true.js"></script><!--PC滚屏参数【首页】，已预写20页;添加以div【class="section"】为一屏-->
</head>
<body style="overflow:hidden;">

@include('partial.nav', ['home'=>'act', 'profile'=>'', 'works'=>'', 'media'=>'', 'events'=>'', 'jobs'=>''])

<div id="uptop">
	<a data-menuanchor="page1" class="active" id="totop" href="#page1">第一屏【作返回顶部】</a>
</div>
<div id="fullpage" class="allmian">
  <div class="section" style="background-image: url(../storage/home_img/index_bg1.jpg);">
    <div class="pp_title">
      <i class="sp1" rel="-235,0,0,0"><div class="top_Atah top_Atah_p1" style="display:none;"><span>ATAH</span></div></i>
    </div>
    <div class="pp_cont box_cont1">
      <div class="tx_lt to_one">
        <div class="pos_rel ts1a ts_r" rel="750,0,0,0">
          <div class="pt_title pt_Rb2">
            <em><a href="wk_details.html">中纺艺展中心</a></em>
          </div>
          <div class="pt_title_bor pt_Rb2"></div>
        </div>
        <div class="pt_text2 pt_Rb2 pos_rel ts1b ts_r" rel="750,0,0,0">
            <p>空间与结构的旋钮之力</p>
            <p>浙江 · 绍兴</p>
        </div>
      </div>
      <div class="dn_lding" style="display:none;"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg2.jpg);">
    <div class="pp_cont box_cont2">
      <div class="tx_rt to_one">
        <div class="pos_rel ts2a ts_l" rel="-750,0,0,0">
          <div class="pt_title pt_Lb1">
            <em><a href="wk_details.html">中纺国际时尚中心</a></em>
          </div>
          <div class="pt_title_bor pt_Lb1"></div>
        </div>
        <div class="pt_text2 pt_Lb1 pos_rel ts2b ts_l" rel="-750,0,0,0">
            <p>艺术介入商业的体验聚场</p>
            <p>浙江 · 绍兴</p>
        </div>
      </div>
      <div class="dn_lding"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg3.jpg);">
    <div class="pp_title">
      <i class="sp3" rel="235,0,0,0"><div class="top_Logo top_Logo_p1"><span><img src="images/top_logo.png"></span></div></i>
    </div>
    <div class="pp_cont box_cont1">
      <div class="tx_lt to_one">
        <div class="pos_rel ts3a ts_r" rel="750,0,0,0">
          <div class="pt_title pt_Rb2">
            <em><a href="wk_details.html">旱雪滑雪中心</a></em>
          </div>
          <div class="pt_title_bor pt_Rb2"></div>
        </div>
        <div class="pt_text2 pt_Rb2 pos_rel ts3b ts_r" rel="750,0,0,0">
            <p>大马山剪影的惊鸿一瞥</p>
            <p>山东 · 青州</p>
        </div>
      </div>
      <div class="dn_lding"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg4.jpg);">
    <div class="pp_cont box_cont2">
      <div class="tx_rt to_one">
        <div class="pos_rel ts4a ts_l" rel="-750,0,0,0">
          <div class="pt_title pt_Lb1">
            <em><a href="wk_details.html">金领谷园区办公</a></em>
          </div>
          <div class="pt_title_bor pt_Lb1"></div>
        </div>
        <div class="pt_text2 pt_Lb1 pos_rel ts4b ts_l" rel="-750,0,0,0">
          <p>微缩城市的秩序之美</p>
          <p>上海 · 吴泾</p>
        </div>
      </div>
      <div class="dn_lding"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg5.jpg);">
    <div class="pp_cont box_cont1">
      <div class="tx_lt to_one">
        <div class="pos_rel ts5a ts_r" rel="750,0,0,0">
          <div class="pt_title pt_Rb2">
            <em><a href="wk_details.html">老城文化艺术中心</a></em>
          </div>
          <div class="pt_title_bor pt_Rb2"></div>
        </div>
        <div class="pt_text2 pt_Rb2 pos_rel ts5b ts_r" rel="750,0,0,0">
          <p>四水归堂的现代演绎</p>
          <p>江苏 · 盐城</p>
        </div>
      </div>
      <div class="dn_lding"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg6.jpg);">
    <div class="pp_cont box_cont2">
      <div class="tx_rt to_one">
        <div class="pos_rel ts6a ts_l" rel="-750,0,0,0">
          <div class="pt_title pt_Lb1">
            <em><a href="wk_details.html">莲花社区商业改造</a></em>
          </div>
          <div class="pt_title_bor pt_Lb1"></div>
        </div>
        <div class="pt_text2 pt_Lb1 pos_rel ts6b ts_l" rel="-750,0,0,0">
          <p>缝合混合商业的城市更新</p>
          <p>上海 · 浦东</p>
        </div>
      </div>
      <div class="dn_lding"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg1.jpg);">
    <div class="pp_cont box_cont1">
      <div class="tx_lt to_one">
        <div class="pos_rel ts7a ts_r" rel="750,0,0,0">
          <div class="pt_title pt_Rb2">
            <em><a href="wk_details.html">中纺艺展中心</a></em>
          </div>
          <div class="pt_title_bor pt_Rb2"></div>
        </div>
        <div class="pt_text2 pt_Rb2 pos_rel ts7b ts_r" rel="750,0,0,0">
            <p>空间与结构的旋钮之力</p>
            <p>浙江 · 绍兴</p>
        </div>
      </div>
      <div class="dn_lding" style="display:none;"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg2.jpg);">
    <div class="pp_cont box_cont2">
      <div class="tx_rt to_one">
        <div class="pos_rel ts8a ts_l" rel="-750,0,0,0">
          <div class="pt_title pt_Lb1">
            <em><a href="wk_details.html">中纺国际时尚中心</a></em>
          </div>
          <div class="pt_title_bor pt_Lb1"></div>
        </div>
        <div class="pt_text2 pt_Lb1 pos_rel ts8b ts_l" rel="-750,0,0,0">
            <p>艺术介入商业的体验聚场</p>
            <p>浙江 · 绍兴</p>
        </div>
      </div>
      <div class="dn_lding"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg3.jpg);">
    <div class="pp_cont box_cont1">
      <div class="tx_lt to_one">
        <div class="pos_rel ts9a ts_r" rel="750,0,0,0">
          <div class="pt_title pt_Rb2">
            <em><a href="wk_details.html">旱雪滑雪中心</a></em>
          </div>
          <div class="pt_title_bor pt_Rb2"></div>
        </div>
        <div class="pt_text2 pt_Rb2 pos_rel ts9b ts_r" rel="750,0,0,0">
            <p>大马山剪影的惊鸿一瞥</p>
            <p>山东 · 青州</p>
        </div>
      </div>
      <div class="dn_lding"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg4.jpg);">
    <div class="pp_cont box_cont2">
      <div class="tx_rt to_one">
        <div class="pos_rel ts10a ts_l" rel="-750,0,0,0">
          <div class="pt_title pt_Lb1">
            <em><a href="wk_details.html">金领谷园区办公</a></em>
          </div>
          <div class="pt_title_bor pt_Lb1"></div>
        </div>
        <div class="pt_text2 pt_Lb1 pos_rel ts10b ts_l" rel="-750,0,0,0">
          <p>微缩城市的秩序之美</p>
          <p>上海 · 吴泾</p>
        </div>
      </div>
      <div class="dn_lding"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg5.jpg);">
    <div class="pp_cont box_cont1">
      <div class="tx_lt to_one">
        <div class="pos_rel ts11a ts_r" rel="750,0,0,0">
          <div class="pt_title pt_Rb2">
            <em><a href="wk_details.html">老城文化艺术中心</a></em>
          </div>
          <div class="pt_title_bor pt_Rb2"></div>
        </div>
        <div class="pt_text2 pt_Rb2 pos_rel ts11b ts_r" rel="750,0,0,0">
          <p>四水归堂的现代演绎</p>
          <p>江苏 · 盐城</p>
        </div>
      </div>
      <div class="dn_lding"><img src="images/down_landing.png" /></div>
    </div>
  </div>
  <div class="section" style="background-image: url(../storage/home_img/index_bg6.jpg);">
    <div class="pp_cont box_cont2">
      <div class="tx_rt to_one">
        <div class="pos_rel ts12a ts_l" rel="-750,0,0,0">
          <div class="pt_title pt_Lb1">
            <em><a href="wk_details.html">莲花社区商业改造</a></em>
          </div>
          <div class="pt_title_bor pt_Lb1"></div>
        </div>
        <div class="pt_text2 pt_Lb1 pos_rel ts12b ts_l" rel="-750,0,0,0">
          <p>缝合混合商业的城市更新</p>
          <p>上海 · 浦东</p>
        </div>
      </div>
      <div class="dn_lding"><img src="images/down_landing.png" /></div>
    </div>
  </div>
</div>

<script type="text/javascript">
//浏览器窗口发生变化时同时变化DIV
window.onload = function(){
	  autodivsize()
	};
window.onresize = function(){
	  autodivsize()
	};

    function autodivsize(){ //函数：获取尺寸
        var winWidth=0;
        var winHeight=0;

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

<script src="js/jquery.lazyload.js?v=1.9.1"></script>
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
</body>
</html>