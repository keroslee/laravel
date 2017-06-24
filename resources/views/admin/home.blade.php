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
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="../storage/home_img/index_bg2.jpg"/></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="中纺国际时尚中心">中纺国际时尚中心</em>
              <i title="艺术介入商业的体验聚场">艺术介入商业的体验聚场</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="浙江 · 绍兴">浙江 · 绍兴</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
      <li>
        <div class="mar_ls">
          <div class="bor_white">
            <div class="p_img"><img src="/images/notpic.gif" /></div>
          </div>
          <div class="inpull">
            <div class="ktext">
              <em title="标题名称文字-大字">标题名称文字-大字</em>
              <i title="简短的文字内容说明">简短的文字内容说明</i>
            </div>
            <div>
            <a href="home_edit"><button type="button">编辑</button></a>
            <div class="classify" title="省份 · 城市">省份 · 城市</div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </li>
  	</ul>
  </div>
</div>
@endsection