// JavaScript Document

//侧边弹窗
$(function(){
	$('.L_menu').css('rifgt','-10.8em');
	var expanded = true;
	$('.ic_tt').click(function(){
		if (expanded) {
			$('.L_menu').animate({right:'0'},350);
			$('.bar .ic_tt').css('background-position','-2.42em 0');
	
		}else {
			$('.L_menu').animate({right:'-10.8em'},350);
			$('.bar .ic_tt').css('background-position','0 0');
		}
		expanded = !expanded;
	});
});
$(function(){
    $(".test li a").click(function() {
        $('li a').removeClass('act');  
        $(this).addClass('act');   
    });
});           

/*---------------------------------------------*/