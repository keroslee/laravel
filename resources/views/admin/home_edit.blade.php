@extends('layouts.admin')

@section('content')
<script type="text/javascript"> 
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
        function previewImage(file)
        {
          var MAXWIDTH  = 512; 
          var MAXHEIGHT = 288;
          var div = document.getElementById('preview');
          if (file.files && file.files[0])
          {
              div.innerHTML ='<img id=imghead>';
              var img = document.getElementById('imghead');
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
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
            div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
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

@include('admin.nav', ['home'=>'cur', 'profile'=>'', 'works'=>'', 'media'=>'', 'events'=>'', 'jobs'=>''])

<div class="adcent clearfix">
  <div class="b_title">
    <h1>首页单屏图编辑</h1>
    <!--<div class="release"><button type="button">发布</button></div>-->
  </div>
  <div class="pic_edit">
    <div class="p_img" id="preview">
      <img id="imghead" src='/images/notpic.gif'>
    </div>
    <div class="uplond">
       <input type="text" id="uptext" value="请上传图片：1920x1080px；大小200k以内"  name="textfield" />  
       <button type="button">浏览</button>
       <input type="file" name="fileField" class="file" id="fileField"  onchange="previewImage(this),document.getElementById('uptext').value=this.value" />
    </div>
    <div>
      <input type="text" id="bigtext_cn" value="请输入15字内的项目名称-大字" />
    </div>
    <div>
      <input type="text" id="smalltext_cn" value="请输入22字内的内容说明-小字" />
    </div>
    <div>
      <input type="text" id="wheretext_cn" value="请输入省份名 · 城市名" />
    </div>
    <div class="hrs clearfix"></div>
    <div>
      <input type="text" id="bigtext_en" value="Enter within 40 character project name - big" />
    </div>
    <div>
      <input type="text" id="smalltext_en" value="Enter within 60 character project description - small" />
    </div>
    <div>
      <input type="text" id="wheretext_en" value="Enter City · Province" />
    </div>
    <div>
      <a href="home.html"><button type="button">确认</button></a>
    </div>

		
    
    
  </div>
</div>
@endsection