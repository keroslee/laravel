@extends('layouts.admin')

@section('content')
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
<script  src="/js/imgs_upload.js"></script>
</head> 
<body style="overflow-y:scroll; overflow-x:hidden">

@include('admin.nav', ['home'=>'', 'profile'=>'', 'works'=>'', 'media'=>'cur', 'events'=>'', 'jobs'=>''])

<div class="adcent clearfix">
  <div class="b_title">
    <h1>媒体编辑</h1>
  </div>
  <div class="top_list clearfix" style="width:600px;">
    <ul>
      <li class="{{$loc=='cn'?'cur':''}}"><a href="/admin/media/cn">中文</a></li>
      <li class="{{$loc=='en'?'cur':''}}"><a href="/admin/media/en">英文</a></li>
    </ul>
  </div>
  <div class="pic_edit">
    <div class="img-cont">
		@foreach($media as $m)
			<div>
				<div>
					<img src='{{$m->path}}' />
				</div>
				<a class='hide delete-btn' data-id="{{$m->id}}" data-url="/admin/media/del">删除</a>
			</div>
		@endforeach
	</div> 
    <div class="uplond">
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/media/store') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input name="loc" value="{{$loc}}" hidden/>
		   <input type="text" id="upimgs" value="请上传事件图：1280x800px；大小200k以内"  name="textfields" />  
		   <button type="button">浏览</button>
		   <input type="file" name="fileFields[]" class="file2"  id="fileFields" onchange="PreviewImage(this)" multiple="multiple"/>
		   <div class="pop_but"><button type="submit">确定</button></div>
		</form>
    </div>
    
  </div>
</div>
@endsection