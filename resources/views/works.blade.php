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
      <li class="cur"><a href="javascript:void(0)">All</a></li>
      <li><a href="javascript:void(0)">S</a></li>
      <li><a href="javascript:void(0)">M</a></li>
      <li><a href="javascript:void(0)">L</a></li>
      <li><a href="javascript:void(0)">XL</a></li>
      <li><a href="javascript:void(0)">Culture &amp; Hotel</a></li>
      <li><a href="javascript:void(0)">Commercial &amp; Sport</a></li>
      <li><a href="javascript:void(0)">Office</a></li>
      <li><a href="javascript:void(0)">House &amp; Interior</a></li>
      <li><a href="javascript:void(0)">Planning &amp; Landscape</a></li>
    </ul>
  </div>
</div>
<div class="bk_bg2"></div>
<div class="setlist">
  <ul class="clearfix">
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/001.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/002.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/003.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/004.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/005.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/006.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/007.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/008.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/009.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/001.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/002.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/003.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/004.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/005.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/006.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/007.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/008.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" src="../storage/list_img/009.jpg"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/001.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/002.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/003.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/004.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/005.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/006.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/007.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/008.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/009.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/001.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/002.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/003.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/004.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/005.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/006.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/007.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/008.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/009.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/001.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/002.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/003.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/004.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/005.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/006.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/007.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/008.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	  <li>
	    <a href="wk_details">
            <div class="photo"><img class="small" data-original="../storage/list_img/009.jpg" src="images/grey.gif"></div>
			<div class="rsp" style="display: none;"></div>
			<div class="text" style="display: none;"><h1>介介景景介介景景介介景景</h1>
              <em>09/12/21</em>
            </div>
        </a>
	  </li>
	</ul>
	<div class="clear"></div>
</div>


<script src="js/jquery.lazyload.js?v=1.9.1"></script>
<script type="text/javascript" charset="utf-8">
//图片延迟加载
	jQuery(document).ready( 
	function($){ 
		$("img.small").lazyload({ 
			placeholder : "images/grey.gif", 
			effect      : "fadeIn",
			threshold : 50
		}); 
	}); 
</script>
</body>
</html>