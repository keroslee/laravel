<div class="L_menu" style="left: -196px;">
  <div class="bar">
    <div class="ic_bb">
      <div class="ic_tt"></div>
      <!--iconlogo-->
      <!--<div class="ic_logo"></div>-->
    </div>
    <!--标条背景-->
    <!--<div class="ic_bg"></div>-->
	<?php $lan=['en'=>'cn','cn'=>'en'];$loc=Cookie::get('locale');$loc=$loc?$loc:'en';?>
    <div class="ic_encn"><a href="{{url('/setLang',$lan[$loc])}}">{{trans('menu.toggle')}}</a></div>
  </div>
  <div class="m_van">
    <div class="m_list">
      <ul>
        <li><a href="/" class="{{$home}}">{{trans('menu.home')}}</a></li>
        <li><a href="profile" class="{{$profile}}">{{trans('menu.profile')}}</a></li>
        <li><a href="works" class="{{$works}}">{{trans('menu.works')}}</a></li>
        <li><a href="media" class="{{$media}}">{{trans('menu.media')}}</a></li>
        <li><a href="events" class="{{$events}}">{{trans('menu.events')}}</a></li>
        <li><a href="jobs" class="{{$jobs}}">{{trans('menu.jobs')}}</a></li>
      </ul>
    </div>
    <div class="m_Logo">ATAH</div>
    <div class="m_bg"></div>
  </div>
</div>