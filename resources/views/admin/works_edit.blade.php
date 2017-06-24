@extends('layouts.admin')

@section('content')
<script type="text/javascript"> 
//input部分
$(function(){
  $('.file').click(function(){
  $('#uptext').css('color','#282828');
  });

  $('.file2').click(function(){
  $('#upimgs').css('color','#282828');
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
<script  src="/js/imgs_upload.js"></script>
</head> 
<body style="overflow-y:scroll; overflow-x:hidden">

@include('admin.nav', ['home'=>'', 'profile'=>'', 'works'=>'cur', 'media'=>'', 'events'=>'', 'jobs'=>''])

<div class="adcent clearfix">
  <div class="b_title">
    <h1>项目添加/编辑</h1>
  </div>
  <div class="pic_edit">
    <div class="s_img" id="preview">
      <img id="imghead" src='/images/notpic.gif'>
    </div>
    <div class="uplond">
       <input type="text" id="uptext" value="请上传缩略图：640x430px；大小150k以内"  name="textfield" />  
       <button type="button">浏览</button>
       <input type="file" name="fileField" class="file" id="fileField"  onchange="previewImage(this),document.getElementById('uptext').value=this.value" />
    </div>
    <div>
      <input type="text" id="posttext_cn" value="请输入15字内的项目名称" />
    </div>
    <div>
      <input type="text" id="bigtext_en" value="Enter within 40 character project name" />
    </div>
    <div>
      <input type="text" id="posttime" value="请输入项目时间，中英文格式：年/月/日" />
    </div>
    <div style="width:580px;">
   		<input type="checkbox" id="checkbox_a1" class="chk_1" checked-"" /><label for="checkbox_a1"><span>小</span></label>
		<input type="checkbox" id="checkbox_a2" class="chk_1" /><label for="checkbox_a2"><span>中</span></label>
		<input type="checkbox" id="checkbox_a3" class="chk_1" /><label for="checkbox_a3"><span>大</span></label>
		<input type="checkbox" id="checkbox_a4" class="chk_1" /><label for="checkbox_a4"><span>超大</span></label>
		<input type="checkbox" id="checkbox_a5" class="chk_1" /><label for="checkbox_a5"><span>文化 &amp; 酒店</span></label>
		<input type="checkbox" id="checkbox_a6" class="chk_1" /><label for="checkbox_a6"><span>商业 &amp; 体育</span></label>
		<input type="checkbox" id="checkbox_a7" class="chk_1" /><label for="checkbox_a7"><span>办公</span></label>
		<input type="checkbox" id="checkbox_a8" class="chk_1" /><label for="checkbox_a8"><span>场所 &amp; 室内</span></label>
		<input type="checkbox" id="checkbox_a9" class="chk_1" /><label for="checkbox_a9"><span>规划 &amp; 景观</span></label>
    </div>
<!--    <div class="select">
      <select>
        <option value="all" selected>全部</option>
        <option value="small"></option>
        <option value='medium'></option>
        <option value='large'></option>
        <option value='exlarge'></option>
        <option value="Culture Hotel"></option>
        <option value='Commercial Sport'></option>
        <option value='Office'></option>
        <option value='House Interior'></option>
        <option value='Planning Landscape'></option>
      </select>
    </div>-->
    <div class="hrs clearfix"></div>
		
    <div class="img-cont"></div> 
    <div class="uplond">
    <form>
       <input type="text" id="upimgs" value="请上传详情图：1280x800px；大小200k以内"  name="textfields" />  
       <button type="button">浏览</button>
       <input type="file" name="fileFields" class="file2"  id="fileFields" onchange="PreviewImage(this)" />
    </form>
    </div>
    <div>
      <a href="works.html"><button type="button">确认</button></a>
    </div>
    
  </div>
</div>
@endsection