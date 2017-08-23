<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
@yield('title')
<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/css/style.css">
@yield('style')
<script language="javascript" type="text/javascript" src="/js/WdatePicker.js"></script>
</head>
<body>
<div class="contain">
  <div class="nav">
    <h4>
        <img src="/img/logo.png" height="30em">&nbsp;环保辅助管理系统</h4>
    <ul>
      @if(isset($type) && $type!=1)
      <li class="aaa" style="{{Request::is('/')?'background:#199a92;':''}}"> <a  style="padding:0 1em;" href="/"><img src="/img/hz.png" width="20px" ;/>&nbsp;首页</a></li>
      @endif
      @if(isset($type) && $type==2)
      <li class="aaa" style="{{Request::is('info_company')?'background:#199a92;':''}}">
           <a  style="padding:0 1em;" href="/info_company"><img src="/img/cx.png" width="22px" ;/>&nbsp;企业信息查询</a>
      </li>
      <li class="aaa" style="{{Request::is('company_summary')?'background:#199a92;':''}}">
           <a  style="padding:0 1em;" href="/company_summary"><img src="/img/cx.png" width="22px" ;/>&nbsp;历史数据查询</a>
      </li>
      <li class="aaa" style="{{Request::is('area_summary')?'background:#199a92;':''}}">
           <a  style="padding:0 1em;" href="/area_summary"><img src="/img/cx.png" width="22px" ;/>&nbsp;管理分析</a>
      </li>
      <li class="aaa" style="{{Request::is('admin/*')?'background:#199a92;':''}}">
           <a  style="padding:0 1em;" href="/admin/area"><img src="/img/cx.png" width="22px" ;/>&nbsp;后台管理</a>
      </li>
      @endif
      @if(isset($type) && $type==3)
      <li class="aaa" style="{{Request::is('admin/*')?'background:#199a92;':''}}">
           <a  style="padding:0 1em;" href="/admin/company?tid={{$companytid}}">
              <img src="/img/cx.png" width="22px" ;/>&nbsp;后台管理
          </a>
      </li>
      @endif
          <li>
          <?php $userType = ['', '超级管理员', '管理员', '企业用户'];?>
              您好，{{$userType[$type]}}：{{ Auth::user()->name }}</li>
      <li class="aaa">
           <a  style="padding:0 1em;" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <img src="/img/end.png" width="24px" ;/>&nbsp;退出
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
      </li>
    </ul>
  </div>
  @yield('sidebar')
  @yield('content') </div>
<script src="/js/jquery-1.11.1.min.js"></script> 
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
<script type="text/javascript">
    $(document).ready(function () {
        $('.aaa').click(function () {
            $(this).siblings().attr('style', "");
            $(this).attr("style", "background:#199a92");
        });

        $('.inactive').click(function () {
            if ($(this).siblings('ul').css('display') == 'none') {
                $(this).parent('li').siblings('li').removeClass('inactives')
                $(this).addClass('inactives open');
                $(this).siblings('ul').slideDown(100).children('li');
                if ($(this).parents('li').siblings('li').children('ul').css('display') == 'block') {
                    $(this).parents('li').siblings('li').children('ul').parent('li').children('a').removeClass('inactives');
                    $(this).parents('li').siblings('li').children('ul').slideUp(100);
              }
            } else {
                //控制自身变成+号
                $(this).removeClass('inactives  open');
                //控制自身菜单下子菜单隐藏
                $(this).siblings('ul').slideUp(100);
                //控制自身子菜单变成+号
                $(this).siblings('ul').children('li').children('ul').parent('li').children('a').addClass('inactives');
                //控制自身菜单下子菜单隐藏
                $(this).siblings('ul').children('li').children('ul').slideUp(100);
                //控制同级菜单只保持一个是展开的（-号显示）
                $(this).siblings('ul').children('li').children('a').removeClass('inactives');
            }
        });
    });
</script> 
@yield('script')
</body>
</html>