@extends('layouts.admin')

@section('content')
<script type="text/javascript">
//list、图片等计算的尺寸
window.onload = function(){
	  auto_boxs()
	$(".delt").click(delt);
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
		if(!confirm("确认要删除？")){ 
		window.event.returnValue = false; 
		}
		var button=$(this)
console.log($(this).data('id'));
		$.post("/admin/works/del",{id:button.data('id'),_token:"{{csrf_token()}}"}).done(function(){
			button.closest('li').remove();
		}).fail(function(){
			console.log("删除失败");
		});
	};
</script>

<script type="text/javascript"> 
//
  $(function(){
	  $('#addtoli').click(function(){
		  $('.sortable').append("<li><div class=\'mar_ls\'><div class=\'bor_white\'><div class=\'p_img\'><img src=\'/images/notpic.gif\' /></div></div><div class=\'inpull\'><div class=\'ktext\'><em title=\'建筑项目名称\'>建筑项目名称</em><p title=\'建成时间\'>--/--/--</p></div><div><a href=\'works_edit\'><button type=\'button\'>编辑</button></a><button type=\'button\' class=\'delt\'>删除</button><div class=\'classify\' title=\'建筑分类\'>建筑分类</div></div><div class=\'clearfix\'></div></div></div></li>");
  		$('.pic_list li .p_img').css('width',((((document.documentElement.clientWidth)-178) *0.25) *0.94) -12 +"px");
		$('.pic_list li .p_img').css('height',(((((document.documentElement.clientWidth)-178) *0.25) *0.94) -12) *0.6718 +"px");
		$(".delt").click(delt);
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
      <li class="{{$tagCur?'':'cur'}}"><a href="/admin/works">全部</a></li>
	  @foreach($tags as $tag)
      <li class="{{$tag->id==$tagCur?'cur':''}}"><a href="/admin/works/{{$tag->id}}">{{$tag->cn}}</a></li>
	  @endforeach
    </ul>
  </div>
  <div class="pic_list clearfix">
    <ul class="sortable">
	@foreach($works as $work)
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="{{$work->thumb}}"/></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="{{$work->name_cn}}">{{$work->name_cn}}</em>
              <p title="{{$work->time}}">{{$work->time}}</p>
            </div>
            <div>
            <a href="/admin/works_edit/{{$work->id}}"><button type="button">编辑</button></a>
            <button type="button" data-id="{{$work->id}}" class="delt">删除</button>
            <div class="classify" title="建筑分类">{{$tags->get($work->tags->first()['tag_id'])['cn']}}</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
	@endforeach
  	</ul>
  </div>
    <div class=""><button  id="addtoli" type="button">添加</button></div>
</div>
@endsection