@extends('layouts.admin')
@section('content')
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
		$('.pic_list li .p_img').css('height',(((((document.documentElement.clientWidth)-178) *0.25) *0.94) -12) *0.5625 +"px");
	}
	auto_boxs();
</script>

</head> 
<body style="overflow-y:scroll; overflow-x:hidden">

@include('admin.nav', ['home'=>'cur', 'profile'=>'', 'works'=>'', 'media'=>'', 'events'=>'', 'jobs'=>''])

<div class="adcent clearfix">
  <div class="b_title">
    <h1>首页列表</h1>
    <!--<div class="release"><button type="button">发布</button></div>-->
  </div>
  <div class="pic_list clearfix">
    <ul class="sortable">
	@foreach($homes as $home)
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="{{$home->path}}"/></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="{{$home->name_cn}}">{{$home->name_cn}}</em>
              <i title="{{$home->desc_cn}}">{{$home->desc_cn}}</i>
            </div>
            <div>
            <a href="home_edit/{{$home->id}}"><button type="button">编辑</button></a>
            <div class="classify" title="{{$home->addr_cn}}">{{$home->addr_cn}}</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
	@endforeach
  	</ul>
  </div>
</div>
@endsection