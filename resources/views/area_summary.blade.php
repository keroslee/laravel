@extends('layout',$userData)

@section('sidebar')
    @include('sidebar',$userData)

@endsection

@section('content')
    <div class="box">
        @include('breadcrumb')
        <div class="centent">
            {{--@include('company_status',$status)--}}
            <form class="form-inline" action="{{$currentUrl}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="companyName">区域名称：</label>
                    <input type="text" class="form-control" id="areaName" name="areaName" placeholder="输入区域名称" value="{{$areaName}}">
                </div>
                <div class="form-group">
                    <label for="startTime">开始时间：</label>
                    <input type="text" onClick="WdatePicker()" class="form-control" id="startTime" name="startTime" placeholder="输入开始时间" value="{{$startTime?date('Y-m-d',strtotime($startTime)):$startTime}}">
                </div>
                <div class="form-group">
                    <label for="endTime">结束时间：</label>
                    <input type="text" onClick="WdatePicker()" class="form-control" id="endTime" name="endTime" placeholder="输入结束时间" value="{{$endTime?date('Y-m-d',strtotime($endTime)):$endTime}}">
                </div>
                <button type="submit" class="btn" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className=' btn'">查询</button>
                <button id="expExcel" type="button" class="btn" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className='btn'">导出Excel</button>
                <button id="expPdf" type="button" class="btn" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className='btn'">导出PDF</button>
            </form>
            <table class="table table-bordered" id="areaInfo">
                <thead>
                <tr>
                    <td>序号</td>
                    <td>所属区域</td>
                    <td>企业总数</td>
                    <td>正常企业</td>
                    <td>异常企业</td>
                    <td>合格率%</td>
                </tr>
                </thead>
                <tbody>
                <?php $colors = ['active', 'success', 'info', 'warning', 'danger'];$good = 0;$total = 0; ?>
                @foreach($results as $index => $result)
                    <tr class="{{$colors[$loop->index%count($colors)]}}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$result['area']}}</td>
                        <td>{{$result['total']}}</td>
                        <td>{{$result['good']}}</td>
                        <td>{{$result['total'] - $result['good']}}</td>
                        <td>{{round($result['good']*100/($result['total']),2)}}</td>
                    </tr>
                    <?php $good += $result['good']; $total += $result['total'];?>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7" class="text-right">总检测次数：{{$total}}&nbsp;&nbsp;&nbsp;&nbsp;正常次数：{{$good}}&nbsp;&nbsp;&nbsp;&nbsp;异常次数：{{$total-$good}}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/jquery-1.11.1.min.js"></script>
    <script src="/js/tableExport.js"></script>
    <script type="text/javascript">

        $("#expExcel").click(function () {
            tableExport('areaInfo', '企业监控统计汇总', 'xls');
        });

        $("#expPdf").click(function () {
            tableExport('areaInfo', '企业监控统计汇总', 'pdf');
        });
    </script>
@endsection