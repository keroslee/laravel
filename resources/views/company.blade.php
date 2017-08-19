@extends('layout',$userData)

@section('sidebar')
    @include('sidebar',$userData)
@endsection

@section('content')
    <div class="box">
        <ol class="breadcrumb">
            <li class="active">当前位置：</li>
            <li class="active">首页</li>
            <li class="active">企业汇总</li>
        </ol>
        {{--@include('company_status',$status)--}}
        <div class="centent">

            <form class="form-inline" action="{{$currentUrl}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="companyName">单位名称:</label>
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="输入单位名称" value="{{$companyName}}">
                </div>
                <button type="submit" class="btn" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className=' btn'">查询</button>
                <button type="button" class="btn btn-default" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className=' btn'" id="expExcel">导出</button>
            </form>
            <table class="table table-bordered" id="companyInfo">
                <tr>
                    <th>序号</th>
                    <th>企业名称</th>
                    <th>当前时间</th>
                    <th>运行情况</th>
                    <th>监测点个数</th>
                    <th>正常个数</th>
                    <th>异常个数</th>
                    <th>联系人</th>
                    <th>联系电话</th>
                </tr>
                <tbody>
                <?php $colors = ['active', 'success', 'info', 'warning', 'danger'];?>
                @foreach($companies as $index => $company)
                    <tr class="tr-company {{$colors[$loop->index%count($colors)]}}" data-tid="{{$company['tid']}}" id="tr{{$company['tid']}}">
                        <td>{{$loop->iteration}}</td>
                        <td><a href="/terminal/{{$company['tid']}}">{{$company['name']}}</a></td>
                        <td>{{$company['lastTime']}}</td>
                        <td>{{$company['running']}}</td>
                        <td>{{$company['total']}}</td>
                        <td>{{$company['good']}}</td>
                        <td><span style="{{$company['bad']>0?'color: red;':''}}">{{$company['bad']}}</span></td>
                        <td>{{$company['contact']}}</td>
                        <td>{{$company['tel']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/jquery-1.11.1.min.js"></script>
    <script src="/js/tableExport.js"></script>
    <script type="text/javascript">

        $("#expExcel").click(function () {
            tableExport('companyInfo', '企业监控统计汇总', 'xls');
        });

        $("#expPdf").click(function () {
            tableExport('companyInfo', '企业监控统计汇总', 'pdf');
        });
        var tids = [];
        $(document).ready(function () {
            $('.tr-company').each(function (index) {
                var tid = $(this).data('tid');
                console.log(index, tid);
                tids.push(tid);
            })
            setInterval(getStatus, 10000)
        });

        function getStatus() {
            $.post('/company_status', {_token: '{{csrf_token()}}', tids: tids}).done(function (ret) {
                console.log(ret);
                if (ret) {
                    for (var tid in ret) {
                        var cells = $('#tr' + tid).children();
                        cells[2].innerHTML = ret[tid]['lastTime'];
                        cells[3].innerHTML = ret[tid]['running'];
                        cells[4].innerHTML = ret[tid]['total'];
                        cells[5].innerHTML = ret[tid]['good'];
                        cells[6].innerHTML = '<span style="'+ (ret[tid]['bad']>0?'color: red;':'') +'">'+ ret[tid]['bad'] + '</span>';
                    }
                }
            }).fail(function (ret) {
                console.log(ret);
            });
        }
    </script>
@endsection