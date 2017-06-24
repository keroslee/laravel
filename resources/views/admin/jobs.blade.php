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
//input部分
$(function(){
  $('.cur1').click(function(){
  $('#uptext1').css('color','#282828');
  });
});
//输入框文字效果
window.onload = function(){
	  allinput()
    function allinput(){
     $('input').css('color','#999');
	  var aInp=document.getElementsByTagName('input');
	  var i=0;
	  var sArray=[];
	  for(i=0; i<aInp.length; i++){
		aInp[i].index=i;
		sArray.push(aInp[i].value);
		aInp[i].onfocus=function(){
			if(sArray[this.index]==aInp[this.index].value){
				aInp[this.index].value='';
				aInp[this.index].style.color='#282828'
			}
//			aInp[this.index].className='current';
		};

		aInp[i].onblur=function(){
			if(aInp[this.index].value==''){
				aInp[this.index].value=sArray[this.index];
				aInp[this.index].style.color='#999'
			}
//			aInp[this.index].className='';
		};
	  }
    }
    allinput();
};
</script>

<script type="text/javascript">
//Firefox 因安全性问题已无法直接通过input[file].value 获取完整的文件路径   
                //图片上传预览    IE是用了滤镜。
        function previewImage1(file)
        {
          var MAXWIDTH  = 100 +"%"; 
          var MAXHEIGHT = 100 +"%";
          var div = document.getElementById('preview1');
          if (file.files && file.files[0])
          {
              div.innerHTML ='<img id=imghead1>';
              var img = document.getElementById('imghead1');
              img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width  =  rect.width;
                img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top+'px';
              }
              var reader = new FileReader();
              reader.onload = function(evt){img.src = evt.target.result;}
              reader.readAsDataURL(file.files[0]);
          }
          else //兼容IE
          {
            var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            var src = document.selection.createRange().text;
            div.innerHTML = '<img id=imghead1>';
            var img = document.getElementById('imghead1');
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
            div.innerHTML = "<div id=divhead1 style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
          }
        }
        function clacImgZoomParam( maxWidth, maxHeight, width, height ){
            var param = {top:0, left:0, width:width, height:height};
            if( width>maxWidth || height>maxHeight )
            {
                rateWidth = width / maxWidth;
                rateHeight = height / maxHeight;
                 
                if( rateWidth > rateHeight )
                {
                    param.width =  maxWidth;
                    param.height = Math.round(height / rateWidth);
                }else
                {
                    param.width = Math.round(width / rateHeight);
                    param.height = maxHeight;
                }
            }
             
            param.left = Math.round((maxWidth - param.width) / 2);
            param.top = Math.round((maxHeight - param.height) / 2);
            return param;
        }
</script>
<script type="text/javascript">
//Firefox 因安全性问题已无法直接通过input[file].value 获取完整的文件路径   
                //图片上传预览    IE是用了滤镜。
        function previewImage2(file)
        {
          var MAXWIDTH  = 100 +"%"; 
          var MAXHEIGHT = 100 +"%";
          var div = document.getElementById('preview2');
          if (file.files && file.files[0])
          {
              div.innerHTML ='<img id=imghead2>';
              var img = document.getElementById('imghead2');
              img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width  =  rect.width;
                img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top+'px';
              }
              var reader = new FileReader();
              reader.onload = function(evt){img.src = evt.target.result;}
              reader.readAsDataURL(file.files[0]);
          }
          else //兼容IE
          {
            var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            var src = document.selection.createRange().text;
            div.innerHTML = '<img id=imghead2>';
            var img = document.getElementById('imghead2');
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
            div.innerHTML = "<div id=divhead2 style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
          }
        }
        function clacImgZoomParam( maxWidth, maxHeight, width, height ){
            var param = {top:0, left:0, width:width, height:height};
            if( width>maxWidth || height>maxHeight )
            {
                rateWidth = width / maxWidth;
                rateHeight = height / maxHeight;
                 
                if( rateWidth > rateHeight )
                {
                    param.width =  maxWidth;
                    param.height = Math.round(height / rateWidth);
                }else
                {
                    param.width = Math.round(width / rateHeight);
                    param.height = maxHeight;
                }
            }
             
            param.left = Math.round((maxWidth - param.width) / 2);
            param.top = Math.round((maxHeight - param.height) / 2);
            return param;
        }
</script>    
</head> 
<body style="overflow-y:scroll; overflow-x:hidden">

@include('admin.nav', ['home'=>'', 'profile'=>'', 'works'=>'', 'media'=>'', 'events'=>'', 'jobs'=>'cur'])

<div class="adcent clearfix">
  <div class="b_title">
    <h1>求职编辑</h1>
  </div>
  <div class="top_list clearfix" style="width:600px;">
    <ul>
      <li class="cur"><a href="jobs.html">中文</a></li>
      <li><a href="jobs_en.html">英文</a></li>
    </ul>
  </div>
  <div class="pic_edit">
    <div class="k_img" id="preview1"></div>
    <div class="uplond">
       <input type="text" id="uptext1" value="请上传求职图片：1920px宽；大小200k以内"  name="textfield" />  
       <button type="button">浏览</button>
       <input type="file" name="fileField" class="file cur1" id="fileField"  onchange="previewImage1(this),document.getElementById('uptext1').value=this.value" />
       <div class="pop_but"><button type="button">确定</button></div>
    </div>

  </div>
</div>

</body>
</html>