<div class="sidebar">
    <div class="item-nav">
        <ul>
            @if(isset($areaList) && $type==2)
                @foreach($areaList as $key=>$areaB)
                    <li>
                        <a class="parent inactive">{{$areaBigList[$key]}}</a>
                        @foreach($areaB as $area)
                            <ul style="display:none">
                                <li><a href="{{Request::is('/')?"/?area=$area->tid":"/company?area=$area->tid"}}">{{$area->area}}</a></li>
                            </ul>
                        @endforeach
                    </li>
                @endforeach
            @endif

            @if(isset($companiesSameArea) && $type==2)
                <form class="" action="{{$currentUrl}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" class="form-control" id="companyName" name="companyName" placeholder="输入公司名称" value="{{$companyName}}">
                    </div>
                    <button type="submit" class="btn" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className=' btn'">查询</button>
                </form>
			<li>
            	<ul>         
                @foreach($companiesSameArea as $company)
                    <li><a href="/terminal/{{$company->tid}}">{{$company->companyname}}</a></li>
                @endforeach
                </ul>
            </li>
            @endif
        </ul>
    </div>

</div>

