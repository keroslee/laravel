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

</body>
</html>