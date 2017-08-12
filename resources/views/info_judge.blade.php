@extends('layout',$userData)

@section('sidebar')
    @include('sidebar',$userData)
@endsection

@section('content')
    <div class="box">
        @include('breadcrumb')
        <div class="centent">
        <form class="form-inline" action="{{$currentUrl}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="companyName">单位名称</label>
                <input type="text" class="form-control" id="companyName" name="companyName" placeholder="输入单位名称" value="{{$companyName}}">
            </div>
            <button type="submit" class="btn" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className=' btn'">查询</button>
        </form>

        <ul class="nav1">
            <li role="presentation"><a href="{{$companyUrl}}">企业基本信息</a></li>
            <li role="presentation" class="active" style="background:#199a92"><a href="{{$judgeUrl}}">审批与验收信息</a></li>
            <li role="presentation"><a href="{{$checkUrl}}">执法检查信息</a></li>
        </ul>

        <table class="table table-bordered">
            <thead>
            <tr>
                <td>序号</td>
                <td>企业名称</td>
                <td>审批文号</td>
                <td>审批部门</td>
                <td>审批时间</td>
                <td>审批内容</td>
                <td>审批备注</td>
                <td>验收文号</td>
                <td>验收部门</td>
                <td>验收时间</td>
                <td>验收内容</td>
                <td>验收备注</td>
            </tr>
            </thead>
            <tbody>
            <?php $colors = ['active', 'success', 'info', 'warning', 'danger']; ?>
            @foreach($results as $index => $result)
                <tr class="{{$colors[$index%count($colors)]}}">
                    <td>{{$index+1}}</td>
                    <td>{{$result->companyname}}</td>
                    <td>{{$result->spno}}</td>
                    <td>{{$result->spbm}}</td>
                    <td>{{$result->spsj}}</td>
                    <td>
                        @if($result->content)
                        <a href="{{$result->content}}">查看</a>
                        @endif
                    </td>
                    <td>{{$result->mark}}</td>
                    <td>{{$result->ysno}}</td>
                    <td>{{$result->ysbm}}</td>
                    <td>{{$result->yssj}}</td>
                    <td>
                        @if($result->yanshou_content)
                            <a href="{{$result->yanshou_content}}">查看</a>
                        @endif
                    </td>
                    <td>{{$result->yanshou_mark}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection