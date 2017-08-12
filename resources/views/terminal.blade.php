@extends('layout',$userData)

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
                <h4>所属企业:{{$terminals->first()->companyname}}</h4>
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
                            <th colspan="2">源设备：</th>
                            @foreach($terminals as $terminal)
                                @if($terminal->type == 0)
                                    <tr>
                                        <td class="text-left">
                                            {{$terminal->stationname}}：
                                        </td>
                                        <td>
                                            <strong id="status{{$terminal->tid}}" style="background:#{{$terminal->state?'56bd0c':'ff7373'}};">
                                                {{$terminal->state?'运行中':'未运行'}}
                                            </strong>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        <br/><br/>
                        <table id="tblZhili">
                            <th colspan="2">治理设备：</th>
                            @foreach($terminals as $terminal)
                                @if($terminal->type == 1)
                                    <tr>
                                        <td class="text-left">
                                            {{$terminal->stationname}}：
                                        </td>
                                        <td>
                                            <strong id="status{{$terminal->tid}}" style="background:#{{$terminal->state?'56bd0c':'ff7373'}};">
                                                {{$terminal->state?'运行中':'未运行'}}
                                            </strong>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
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
            setInterval(getStatus, 5000)
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
                    var tblSource = document.getElementById('tblSource');
                    var length = tblSource.rows.length;
                    for (var index=1; index<length;index++) {
                        tblSource.deleteRow(1)
                    }
                    var tblZhili = document.getElementById('tblZhili');
                    var length = tblZhili.rows.length;
                    for (var index=1; index<length;index++) {
                        tblZhili.deleteRow(1)
                    }
                    for (var tid in terminals) {
                        var terminal = terminals[tid];
                        if (terminal['type'] == 0) {
                            var row = tblSource.insertRow();
                            var cell = row.insertCell();
                            cell.innerHTML = terminal['stationname'] + '：'
                            cell.className = 'text-left';
                            var cell = row.insertCell();
                            cell.innerHTML = '<strong style="background:#' + (terminal['state']=='1'?'56bd0c':'ff7373') + ';">'+(terminal['state'] == '1' ? '运行中' : '未运行')+'</strong>';
                        }else{
                            var row = tblZhili.insertRow();
                            var cell = row.insertCell();
                            cell.innerHTML = terminal['stationname'] + '：'
                            cell.className = 'text-left';
                            var cell = row.insertCell();
                            cell.innerHTML = '<strong style="background:#' + (terminal['state']=='1'?'56bd0c':'ff7373') + ';">'+(terminal['state'] == '1' ? '运行中' : '未运行')+'</strong>';
                        }
                    }
                }
            }).fail(function (ret) {
                console.log(ret);
            });
        }
    </script>
@endsection