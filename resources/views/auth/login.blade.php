<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ATAH-后台登录</title>
<link href="/images/atah_logo.ico" rel="shortcut icon">
<link rel="stylesheet" href="/css/style-admin.css">
<script src="/js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript"> 
//账号部分
$(function(){
  $('.admin').css('color','#999');
  $('#login_showPwd').css('color','#999');
  $(".admin").focus(function(){
	if($(this).val() == "请输入您的账号"){
	  $(this).val("");
	  $(this).css('color','#282828');
	}
  });
  $(".admin").blur(function(){
	if($(this).val() == ""){
	  $(this).val("请输入您的账号");
	  $(this).css('color','#999');
	}
  });
  // 密码部分
  $('#login_showPwd').focus(function(){
	var text_value=$(this).val();
	if(text_value == this.defaultValue){
	  $('#login_showPwd').hide();
	  $('#login_password').show().focus();
	}
  });
  $('#login_password').blur(function(){
	var text_value = $(this).val();
	if(text_value==""){
	  $('#login_showPwd').show();
	  $('#login_password').hide();
	}
  });
  //重置部分
  $('#btn_res').click(function(){
	$('.admin').val("请输入您的账号");
    $('.admin').css('color','#999');
	$('#login_password').hide().val("");
	$("#login_showPwd").show();
  });
});
</script> 

</head>
<body>
<div class="Login">
  <div class="logo"><img src="images/admin_logo.png" /></div>
  <div>
    <input type="text" value="请输入您的账号" class="admin" />
  </div>
  <div>
    <input type="text" value="请输入您的密码" id="login_showPwd" />
    <input type="password" id="login_password" style="display: none" />
  </div>
  <div>
    <a href="home.html"><button type="button">登录</button></a>
    <!--<button type="button" id ="btn_res" />重置</button>-->
  </div> 
</div>

</body>
</html>