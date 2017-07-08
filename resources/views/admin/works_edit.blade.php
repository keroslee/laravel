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
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/works_edit/store') }}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input name="id" value="{{$work->id}}" hidden>
		<div class="s_img" id="preview">
			<img id="imghead" src="{{$work->thumb}}">
		</div>
		<div class="uplond">
			<input type="text" id="uptext" value="请上传缩略图：640x430px；大小150k以内"  name="textfield" />
			<button type="button">浏览</button>
			<input type="file" name="fileField" class="file" id="fileField" onchange="previewImage(this),document.getElementById('uptext').value=this.value" />
			@if ($errors->has('fileField'))
				<span class="help-block">
					<strong>{{ $errors->first('fileField') }}</strong>
				</span>
			@endif
		</div>
		<div>
		请输入15字内的项目名称
			<input type="text" id="posttext_cn" placeholder="请输入15字内的项目名称" name="name_cn" value="{{$work->name_cn}}"/>
			@if ($errors->has('name_cn'))
				<span class="help-block">
					<strong>{{ $errors->first('name_cn') }}</strong>
				</span>
			@endif
		</div>
		<div>
		Enter within 40 character project name
			<input type="text" id="bigtext_en" placeholder="Enter within 40 character project name" name="name_en" value="{{$work->name_en}}"/>
			@if ($errors->has('name_en'))
				<span class="help-block">
					<strong>{{ $errors->first('name_en') }}</strong>
				</span>
			@endif
		</div>
		<div>
		请输入项目时间，中英文格式：年/月/日
			<input type="text" id="posttime" name="time" placeholder="请输入项目时间，中英文格式：年/月/日" value="{{$work->time}}"/>
			@if ($errors->has('time'))
				<span class="help-block">
					<strong>{{ $errors->first('time') }}</strong>
				</span>
			@endif
		</div>
		<div style="width:580px;">
		@foreach($tags as $tag)
			<input type="checkbox" id="checkbox_a{{$loop->index}}" class="chk_1" name="tags[{{$tag->id}}]" {{$myTags->contains($tag->id)?"checked":""}}/><label for="checkbox_a{{$loop->index}}"><span>{{$tag->cn}}</span></label>
		@endforeach
		</div>

		<div class="hrs clearfix"></div>
		
		<div class="img-cont">
		@foreach($work->details as $detail)
			<div>
				<div >
					<img src='{{$detail->path}}' />
				</div>
				<a class='hide delete-btn' data-id="{{$detail->id}}" data-url="/admin/works_edit/del_pic">删除</a>
			</div>
		@endforeach
		</div>
		<div class="uplond">
			<input type="text" id="upimgs" value="请上传详情图：1280x800px；大小200k以内"  name="textfields" />
			<button type="button">浏览</button>
			<input type="file" name="fileFields[]" class="file2"  id="fileFields" onchange="PreviewImage(this)" multiple="multiple"/>
		</div>
		<div>
			<button type="submit">确认</button>
		</div>
    </form>
  </div>
</div>
@endsection