@extends('layout',$userData)

@section('sidebar')
    @include('sidebar',$userData)
@endsection

@section('content')
    <div class="box">
        @include('breadcrumb')
        <div class="centent">
        <form id="search" class="form-inline" action="{{$currentUrl}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="companyName">单位名称</label>
                <input type="text" class="form-control" id="companyName" name="companyName" placeholder="输入单位名称" value="{{$companyName}}">
            </div>
            <button type="submit" class="btn" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className=' btn'">查询</button>
        </form>

        <ul class="nav1">
            <li role="presentation" class="active" style="background:#199a92">
                <a href="javascript:void(0)" data-url="{{$companyUrl}}">企业基本信息</a></li>
            <li role="presentation">
                <a href="javascript:void(0)" data-url="{{$judgeUrl}}">审批与验收信息</a></li>
            <li role="presentation">
                <a href="javascript:void(0)" data-url="{{$checkUrl}}">执法检查信息</a></li>
        </ul>

        <table class="table table-bordered">
            <thead>
            <tr>
                <td>序号</td>
                <td>企业名称</td>
                <td>所属区域</td>
                <td>行业类别</td>
                <td>重点类型</td>
                <td>污染物类型</td>
                <td>地址</td>
                <td>法人</td>
                <td>联系人</td>
                <td>联系电话</td>
                <td>工艺逻辑图</td>
            </tr>
            </thead>
            <tbody>
            <?php $colors = ['active', 'success', 'info', 'warning', 'danger']; ?>
            @foreach($results as $index => $result)
                <tr class="{{$colors[$index%count($colors)]}}">
                    <td>{{$index+1}}</td>
                    <td>{{$result->companyname}}</td>
                    <td>{{$result->area}}</td>
                    <td>{{$result->hylb}}</td>
                    <td>{{$result->jclx}}</td>
                    <td>{{$result->wrwlx}}</td>
                    <td>{{$result->address}}</td>
                    <td>{{$result->faren}}</td>
                    <td>{{$result->lianxiren}}</td>
                    <td>{{$result->lianxitel}}</td>
                    <td>
                        @if($result->gongyitu)
                            <a href="{{$result->gongyitu}}"><img style="width:100px" src="{{$result->gongyitu}}"></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection

@section('script')
    <script>
        $('.nav1 a').click(function(){
            var url = $(this).data('url');
            console.log(url)
            var form = $('#search')
            form.attr('action', url)
            form.submit();
        })
    </script>
@endsection