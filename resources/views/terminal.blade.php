@extends('layout',$userData)

@section('style')
    <style>
        .centent .nav a{
            color: #337ab7;
        }
    </style>
@endsection
@section('sidebar')
    @include('sidebar',$userData)
@endsection

@section('content')
    <div class="box">

        <ol class="breadcrumb">
            <li class="active">当前位置：</li>
            <li class="active">首页</li>
            <li class="active">设备运行情况</li>
        </ol>
        <div class="centent">
            @if(count($terminals)==0)
                企业设备信息不存在
            @else
                <ul class="nav nav-tabs" style="background: #fff;">
                    <h4 style="color: black;">所属企业:{{$terminals->first()->companyname}}&nbsp;&nbsp;</h4>
                    <li role="presentation" class="active"><a href="#info" data-toggle="tab">运行信息</a></li>
                    <li role="presentation"><a href="#video" data-toggle="tab">现场视频</a></li>
                </ul>
            <div class="tab-content ">
                <div id="info" class="tab-pane active">
                    <div class="row">
                    <div id="status" class="top left" style="background:{{$status['state']?'green':'red'}};margin-top:20px;">
                        <div class="situation">
                            <span>简单工艺流程图</span>
                            <span id="state">治理情况：{{$status['state']?'正常':'异常'}}</span>
                            <span id="time">时间：{{$status['time']}}</span>
                        </div>
                        <img src="{{$terminals->first()->gongyitu}}" width="100%" style="padding:2px;"/>
                    </div>
                    <div class="history">
                        <div class="right" style="padding-top:20px;">
                            <table id="tblSource">
                                @foreach($terminals as $terminal)
                                    @if($terminal->type == 0)
                                        <tr>
                                            <td class="text-left">
                                                {{$terminal->stationname}}：
                                            </td>
                                            <td>
                                                <strong id="status{{$terminal->tid}}" style="background:{{$terminal->state>0 ? '#56bd0c' : '#ff7373'}};">
                                                    {{$terminal->state>0 ? $terminal->state : '未运行'}}
                                                </strong>
                                            </td>
                                        </tr>
                                        @foreach($terminals as $terminalZhili)
                                            @if($terminalZhili->type == 1 && in_array($terminalZhili->code,$stations[$terminal->stationname]))
                                                <tr>
                                                    <td class="text-left">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;{{$terminalZhili->stationname}}：
                                                    </td>
                                                    <td>
                                                        <strong id="status{{$terminalZhili->tid}}" style="background:{{$terminalZhili->state>0 ? '#56bd0c' : '#ff7373'}};">
                                                            {{$terminalZhili->state>0 ? $terminalZhili->state : '未运行'}}
                                                        </strong>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="video" class="tab-pane ">
                    <div style="width: 400px;height: 300px;background: #000;"></div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.tr-company').each(function (index) {
                var tid = $(this).data('tid');
                console.log(index, tid);
                tids.push(tid);
            })
            setInterval(getStatus, 5000);
        });

        function getStatus() {
            $.post('/terminal_status', {_token: '{{csrf_token()}}', tid: '{{$companyTid}}'}).done(function (ret) {
                console.log(ret);
                if (ret) {
                    var status = ret['status'];
                    $('#status').css('background', status['state'] ? 'green' : 'red');
                    $('#state').text('治理情况：' + (status['state'] ? '正常' : '异常'));
                    $('#time').text('时间：' + status['time']);
                    var terminals = ret['terminals'];
                    var stations = ret['stations'];
                    var tblSource = document.getElementById('tblSource');
                    var length = tblSource.rows.length;
                    for (var index=0; index<length;index++) {
                        tblSource.deleteRow(0)
                    }

                    for (var tid in terminals) {
                        var terminal = terminals[tid];
                        if (terminal['type'] == 0) {
                            var row = tblSource.insertRow();
                            var cell = row.insertCell();
                            var terminalName = terminal['stationname'];
                            cell.innerHTML = terminalName + '：'
                            cell.className = 'text-left';
                            var cell = row.insertCell();
                            cell.innerHTML = '<strong style="background:#' + (terminal['state']>0 ? '56bd0c':'ff7373') + ';">'+(terminal['state'] > 0 ? terminal['state'] : '未运行')+'</strong>';

                            for (var tidZhili in terminals) {
                                var terminal = terminals[tidZhili];
                                if (terminal['type'] == 1 && stations[terminalName].indexOf(terminal['code'])>-1) {
                                    var row = tblSource.insertRow();
                                    var cell = row.insertCell();
                                    cell.innerHTML = '&nbsp;&nbsp;&nbsp;&nbsp;' + terminal['stationname'] + '：'
                                    cell.className = 'text-left';
                                    var cell = row.insertCell();
                                    cell.innerHTML = '<strong style="background:#' + (terminal['state']>0 ? '56bd0c' : 'ff7373') + ';">' + (terminal['state'] > 0 ? terminal['state'] : '未运行') + '</strong>';

                                }
                            }
                        }
                    }
                }
            }).fail(function (ret) {
                console.log(ret);
            });
        }
    </script>
@endsection