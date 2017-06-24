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
<script src="js/slides-1.1.1-min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('#sildes').olvSlides(
		{
			thumb:true,
			thumbPage:false,
			thumbDirection:"Y",
			effect:'slide',
			slideSpeed:450,
			play:5000000,
			pause:5000000,

		}
	);
})

window.onload = function(){
	  auto_height()
	};
window.onresize = function(){
	  auto_height()
	};
	function auto_height()
	{
	  window.onload = function(){
		var allH = document.documentElement.clientHeight;
		var sildesH = document.getElementById("sildes").clientHeight;
        $('.wrap').css ('height',allH +"px");
        $('#sildes').css ('top',(allH - sildesH ) / 2 +"px");

	  };
	}
	auto_height();

</script>
</head>
<body>

@include('partial.nav', ['home'=>'', 'profile'=>'', 'works'=>'', 'media'=>'', 'events'=>'act', 'jobs'=>''])

<div class="wrap">
  <div id="sildes">
    <div class="control">
      <!--轮播大图ui>li自动生成-->
      <ul class="change">
      </ul>
    </div>
    <!--以下ui>li小图区域，写入生成大图效果-->
    <div class="thumbWrap">
      <div class="thumbCont">
        <ul id="sdul">
          <!--img属性：src=小图, bigimg=大图, alt=标题-->
          <li><div class="imgSmall"><img src="../storage/details_img/details_01.jpg" bigImg="../storage/details_img/details_01.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_02.jpg" bigImg="../storage/details_img/details_02.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_03.jpg" bigImg="../storage/details_img/details_03.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_04.jpg" bigImg="../storage/details_img/details_04.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_05.jpg" bigImg="../storage/details_img/details_05.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_06.jpg" bigImg="../storage/details_img/details_06.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_01.jpg" bigImg="../storage/details_img/details_01.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_02.jpg" bigImg="../storage/details_img/details_02.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_03.jpg" bigImg="../storage/details_img/details_03.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_04.jpg" bigImg="../storage/details_img/details_04.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_05.jpg" bigImg="../storage/details_img/details_05.jpg" title="" /></div><div class="ss_bg"></div></li>
          <li><div class="imgSmall"><img src="../storage/details_img/details_06.jpg" bigImg="../storage/details_img/details_06.jpg" title="" /></div><div class="ss_bg"></div></li>
        </ul>
      </div>
    </div>
  </div>
</div>

</body>
</html>