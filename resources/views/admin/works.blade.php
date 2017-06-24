<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ATAH-后台编辑</title>
<link href="/images/atah_logo.ico" rel="shortcut icon">
<link rel="stylesheet" href="/css/style-admin.css">
<script src="/js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
//list、图片等计算的尺寸
window.onload = function(){
	  auto_boxs(),delt()
	};
window.onresize = function(){
	  auto_boxs()
	};
	function auto_boxs()
	{
		$('.pic_list li .p_img').css('width',((((document.documentElement.clientWidth)-178) *0.25) *0.94) -12 +"px");
		$('.pic_list li .p_img').css('height',(((((document.documentElement.clientWidth)-178) *0.25) *0.94) -12) *0.6718 +"px");
	}
	auto_boxs();
</script>
<script type="text/javascript"> 
//删除弹窗
	function delt(){
		$(".delt").click(function() {
			if(!confirm("确认要删除？")){ 
			window.event.returnValue = false; 
			}
			$(this).closest('li').remove();
		});
	};
	delt()
</script>

<script type="text/javascript"> 
//
  $(function(){
	  $('#addtoli').click(function(){
		  $('.sortable').append("<li><div class=\'mar_ls\'><div class=\'bor_white\'><div class=\'p_img\'><img src=\'/images/notpic.gif\' /></div></div><div class=\'inpull\'><div class=\'ktext\'><em title=\'建筑项目名称\'>建筑项目名称</em><p title=\'建成时间\'>--/--/--</p></div><div><a href=\'works_edit.html\'><button type=\'button\'>编辑</button></a><button type=\'button\' class=\'delt\'>删除</button><div class=\'classify\' title=\'建筑分类\'>建筑分类</div></div><div class=\'clearfix\'></div></div></div></li>");
  		$('.pic_list li .p_img').css('width',((((document.documentElement.clientWidth)-178) *0.25) *0.94) -12 +"px");
		$('.pic_list li .p_img').css('height',(((((document.documentElement.clientWidth)-178) *0.25) *0.94) -12) *0.6718 +"px");

		$(".delt").click(function() {
			if(!confirm("确认要删除？")){ 
			window.event.returnValue = false; 
			}
			$(this).closest('li').remove();
		});
  	  });
  })
</script>
<script type="text/javascript">  
//标签点击切换
	$(function(){
		$(".top_list li").click(function() {
			$(this).siblings('li').removeClass('cur');  
			$(this).addClass('cur');   
		});
	});           
</script>  
</head> 
<body style="overflow-y:scroll; overflow-x:hidden">

@include('admin.nav', ['home'=>'', 'profile'=>'', 'works'=>'cur', 'media'=>'', 'events'=>'', 'jobs'=>''])

<div class="adcent clearfix">
  <div class="b_title">
    <h1>项目列表</h1>
    <!--<div class="release"><button type="button">发布</button></div>-->
  </div>
  <div class="top_list clearfix">
    <ul>
      <li class="cur"><a href="javascript:void(0)">全部</a></li>
      <li><a href="javascript:void(0)">小</a></li>
      <li><a href="javascript:void(0)">中</a></li>
      <li><a href="javascript:void(0)">大</a></li>
      <li><a href="javascript:void(0)">超大</a></li>
      <li><a href="javascript:void(0)">文化 &amp; 酒店</a></li>
      <li><a href="javascript:void(0)">商业 &amp; 体育</a></li>
      <li><a href="javascript:void(0)">办公</a></li>
      <li><a href="javascript:void(0)">场所 &amp; 室内</a></li>
      <li><a href="javascript:void(0)">规划 &amp; 景观</a></li>
    </ul>
  </div>
  <div class="pic_list clearfix">
    <ul class="sortable">
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="../storage/list_img/001.jpg"/></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="中纺国际时尚中心">中纺国际时尚中心</em>
              <p title="09/05/12">09/05/12</p>
            </div>
            <div>
            <a href="works_edit.html"><button type="button">编辑</button></a>
            <button type="button" class="delt">删除</button>
            <div class="classify" title="建筑分类">场所 & 室内</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="建筑项目名称">建筑项目名称</em>
              <p title="建成时间">--/--/--</p>
            </div>
            <div>
            <a href="works_edit.html"><button type="button">编辑</button></a>
            <button type="button" class="delt">删除</button>
            <div class="classify" title="建筑分类">建筑分类</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
  	</ul>
  </div>
    <div class=""><button  id="addtoli" type="button">添加</button></div>
</div>

</body>
</html>