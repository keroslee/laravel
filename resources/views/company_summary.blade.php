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
                @if($userData['type']==2)
                <div class="form-group">
                    <label for="companyName">单位名称</label>
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="输入单位名称" value="{{$companyName}}">
                </div>
                @endif
                <div class="form-group">
                    <label for="startTime">开始时间</label>
                    <input type="text" class="form-control" onClick="WdatePicker()" id="startTime" name="startTime" placeholder="输入开始时间" value="{{$startTime}}">
                </div>
                <div class="form-group">
                    <label for="endTime">结束时间</label>
                    <input type="text" class="form-control" onClick="WdatePicker()" id="endTime" name="endTime" placeholder="输入结束时间" value="{{$endTime}}">
                </div>
                <button type="submit" class="btn" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className=' btn'">查询</button>
                <button id="expExcel" type="button" class="btn" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className='btn'">导出Excel</button>
                <button id="expPdf" type="button" class="btn" onmouseover="this.className='btn-mouseover btn'" onmouseout="this.className='btn'">导出PDF</button>
            </form>
            <table class="table table-bordered" id="companyInfo">
                <thead>
                <tr>
                    <td width="50px">序号</td>
                    <td>企业名称</td>
                    <td>监测点名称</td>
                    <td>日期</td>
                    <td>时间</td>
                    <td>源设备</td>
                    <td>治理设备</td>
                    <td>监控结果</td>
                    <td>备注</td>
                </tr>
                </thead>
                <tbody>
                <?php $colors = ['active', 'success', 'info', 'warning', 'danger']; $goodCount = 0; $badCount = 0;?>
                @foreach($results as $index => $result)
                    <tr class="{{$colors[$index%count($colors)]}}">
                        <td>{{$index+1}}</td>
                        <td>{{$result->pcompany}}</td>
                        <td>{{$result->stationname}}</td>
                        <td>{{substr($result->realtime,0,8)}}</td>
                        <td>{{substr($result->realtime,8,4)}}</td>
                        <td>{{$result->s_state}}</td>
                        <td>{{$result->d_state}}</td>
                        <td>{{$result->result}}</td>
                        <td>{{$result->mark}}</td>
                    </tr>
                    <?php $result->result ? $goodCount++ : $badCount++;?>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">总监测次数：{{count($results)}}正常次数：{{$goodCount}}异常次数：{{$badCount}}</td>
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
            tableExport('companyInfo', '企业监控统计汇总', 'xls');
        });
        
        $("#expPdf").click(function () {
            tableExport('companyInfo', '企业监控统计汇总', 'pdf');
        });
    </script>
@endsection