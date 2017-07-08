// JavaScript Document

//判断手机与浏览器的显示
/*try {
	var urlhash = window.location.hash;
	  if (!urlhash.match("fromapp"))
	  {
		if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i)))
		{window.location="web-zx/m_index.html";}
	  }
	}
	catch(err){}
*/
/*---------------------------------------------*/
//侧边弹窗
$(function(){
$('.L_menu').css('left','-199px');
var expanded = true;
$('.ic_tt').click(function(){
	if (expanded) {
		$('.L_menu').animate({left:'0'},300);
		$('.ic_bb .ic_tt').addClass("ic_tt ic_td");

	}else {
		$('.L_menu').animate({left:'-199px'},300);
		$('.ic_bb .ic_tt').removeClass("ic_td");
	}
	expanded = !expanded;
});
});

