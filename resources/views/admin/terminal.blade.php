@extends('layout',$userData)

@section('sidebar')
    @include('sidebar_admin',$userData)
@endsection

@section('content')
    <div class="box">
        <ol class="breadcrumb">
            <li class="active">当前位置：</li>
            <li class="active">首页</li>
            <li class="active">设备信息管理</li>
        </ol>
        <div class="centent">
            {{--@include('company_status',$status)--}}

            @include('admin.message')
            <h4>设备信息表</h4>

            @if(Auth::user()->type == 2)
            <form class="form-inline" action="{{$currentUrl}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="companyName">单位名称</label>
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="输入单位名称" value="{{$companyName}}">
                </div>
                <button type="submit" class="btn ">查询</button>
            </form>
            @endif

            <table id="tableData" class="table table-bordered">
                <thead>
                <tr>
                    <td>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="selectAll">
                                全选
                            </label>
                        </div>
                    </td>
                    <td>序号</td>
                    <td>企业名称</td>
                    <td>设备编码</td>
                    <td>设备名称</td>
                    <td>设备类型</td>
                    <td>作用</td>
                    <td>备注</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody>
                <?php $colors = ['active', 'success', 'info', 'warning', 'danger']; $idx = 0?>
                @foreach($results as $index => $result)
                    <tr class="{{$colors[$idx%count($colors)]}}" id="row{{$result->tid}}">
                        <td>
                            <div class="#">
                                <label>
                                    <input type="checkbox" name="tids[]" value="{{$result->tid}}">
                                </label>
                            </div>
                        </td>
                        <td>{{$idx+1}}</td>
                        <td>{{$result->companyname}}</td>
                        <td>{{$result->code}}</td>
                        <td>{{$result->terminalname}}</td>
                        <td>{{$result->type?'治理设备':'源设备'}}</td>
                        <td>{{$result->dosomething}}</td>
                        <td>{{$result->mark}}</td>
                        <td style="padding:0 8px;">
                            <button type="button" class="bj"
                                    data-toggle="modal" data-target="#modalEdit"
                                    id="btn{{$result->tid}}"
                                    data-tid="{{$result->tid}}"
                                    data-companytid="{{$result->companytid}}"
                                    data-terminalname="{{$result->terminalname}}"
                                    data-code="{{$result->code}}"
                                    data-type="{{$result->type}}"
                                    data-dosomething="{{$result->dosomething}}"
                                    data-mark="{{$result->mark}}"><img src="/img/bj.png" width="20px"/>编辑
                            </button>
                        </td>
                    </tr>
                    <?php $idx++;?>
                @endforeach
                </tbody>
            </table>
            {{$results->appends(['companyName' => $companyName])->links('vendor.pagination.default')}}

            <form class="form-inline" action="{{$currentUrl}}" method="post">
                {{csrf_field()}}
                <button type="button" class="btn " id="add" data-toggle="modal" data-target="#modalEdit">增加</button>
                <button type="button" class="btn btn-del" id="del">删除</button>
            </form>

            <!-- add/edit-->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalEdit" aria-labelledby="modalEditTitle">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modalEditTitle">编辑设备信息</h4>
                        </div>
                        <div class="modal-body">
                            <input id="tid" style="display:none">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">企业名称</label>
                                    <div class="col-sm-10">
                                        <select id="companytid" class="form-control">
                                            <option>请选择企业</option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->tid}}">{{$company->companyname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">设备编码</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code" placeholder="设备编码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">设备名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="terminalname" placeholder="设备名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">设备类型</label>
                                    <div class="col-sm-10">
                                        <select id="type" class="form-control">
                                            <option value="0" selected>源设备</option>
                                            <option value="1">治理设备</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">作用</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="dosomething" placeholder="作用">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">备注</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="mark" placeholder="备注">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-del" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary" id="save">保存</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- del confirm -->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalConfirm">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">确认要删除这些执法检查信息吗？</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-del" data-dismiss="modal">取消</button>
                            <button type="button" class="btn " id="delConfirm">删除</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        var _token = '{{csrf_token()}}';
        $.guid = $.now();

        $('#modalEdit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            var tid = button.data('tid');
            var companytid = button.data('companytid');
            var terminalname = button.data('terminalname');
            var code = button.data('code');
            var type = button.data('type');
            var dosomething = button.data('dosomething');
            var mark = button.data('mark');

            modal.find('.modal-body #tid').val(tid);
            modal.find('.modal-body #companytid').val(companytid);
            modal.find('.modal-body #terminalname').val(terminalname);
            modal.find('.modal-body #code').val(code);
            modal.find('.modal-body #type').val(type);
            modal.find('.modal-body #dosomething').val(dosomething);
            modal.find('.modal-body #mark').val(mark);
        })

        $('#save').click(function (env) {
            var modal = $('#modalEdit');
            var method = 'upd';
            var tid = modal.find('.modal-body #tid').val();
            var data = {
                tid: modal.find('.modal-body #tid').val(),
                companytid: modal.find('.modal-body #companytid').val(),
                terminalname: modal.find('.modal-body #terminalname').val(),
                code: modal.find('.modal-body #code').val(),
                type: modal.find('.modal-body #type').val(),
                dosomething: modal.find('.modal-body #dosomething').val(),
                mark: modal.find('.modal-body #mark').val(),
            };

            if (data['tid']) {
                postData(data, method);
            } else {
                $.post('/uuid', {_token: _token}).done(function (ret) {
                    data['tid'] = ret['tid'];
                    method = 'add';
                    postData(data, method);
                }).fail(function (ret) {
                    data['tid'] = $.guid++;
                    postData(data, method);
                })
            }
        })

        function postData(data, method) {
            $.post('{{$currentUrl}}/' + method, {_token: _token, data: data}).done(function (ret) {

                $('#modalEdit').modal('hide');
                if (ret['res']) {
                    success('保存成功！');
                    updateRow(data)
                } else {
                    fail('保存失败，请重试！')
                }
            }).fail(function (ret) {
                console.log(ret);
                alert('网络出错，请重试！')
            });
        }

        function updateRow(data) {
            var keys = ['tid', 'companytid', 'terminalname', 'code', 'type', 'dosomething', 'mark'];
            var row = $('#row' + data['tid']);
            var btn = $('#btn' + data['tid']);

            if (row.length) {
                var cells = row.find('td')
                cells[2].innerHTML = $('#modalEdit').find('.modal-body #companytid option:selected').text();
                cells[3].innerHTML = data['code'];
                cells[4].innerHTML = data['terminalname']
                cells[5].innerHTML = $('#modalEdit').find('.modal-body #type option:selected').text();
                cells[6].innerHTML = data['dosomething'];
                cells[7].innerHTML = data['mark']
                var cell = cells[8];
            } else {
                var table = document.getElementById('tableData')
                var row = table.insertRow();

                var cell = row.insertCell();
                cell.innerHTML = '<div class="checkbox"><label><input type="checkbox" name="tids[]" value="' + data['tid'] + '"></label></div>';
                cell = row.insertCell();
                cell.innerHTML = table.rows.length - 1;
                cell = row.insertCell();
                cell.innerHTML = $('#modalEdit').find('.modal-body #companytid option:selected').text();
                cell = row.insertCell();
                cell.innerHTML = data['code'];
                cell = row.insertCell();
                cell.innerHTML = data['terminalname']
                cell = row.insertCell();
                cell.innerHTML = $('#modalEdit').find('.modal-body #type option:selected').text();
                cell = row.insertCell();
                cell.innerHTML = data['dosomething'];
                cell = row.insertCell();
                cell.innerHTML = data['mark']

                var cell = row.insertCell();
            }
            cell.innerHTML = '<button type="button" class="bj" data-toggle="modal" data-target="#modalEdit"' +
                    ' id="btn' + data['tid'] + '"' +
                    ' data-tid="' + data['tid'] + '"' +
                    ' data-companytid="' + data['companytid'] + '"' +
                    ' data-terminalname="' + data['terminalname'] + '"' +
                    ' data-code="' + data['code'] + '"' +
                    ' data-type="' + data['type'] + '"' +
                    ' data-dosomething="' + data['dosomething'] + '"' +
                    ' data-mark="' + data['mark'] + '"><img src="/img/bj.png" width="20px"/>编辑</button>';
        }

        $('#selectAll').click(function (env) {
            $('input[type*=\'checkbox\']').prop('checked', this.checked);
        })

        $('#del').click(function (env) {
            var tids = $('input[name=\'tids[]\']:checked:enabled').map(function () {
                return $(this).val();
            }).get();
            if (tids.length > 0) {
                $('#modalConfirm').modal('show');
            } else {
                alert('请在想要删除的信息前面打勾！');
            }
        });

        $('#delConfirm').click(function (env) {
            var tids = $('input[name=\'tids[]\']:checked:enabled').map(function () {
                return $(this).val();
            }).get();


            $.post('{{$currentUrl}}/del', {_token: _token, tids: tids}).done(function (ret) {
                $('#modalConfirm').modal('hide');
                if (ret['res'] === 0) {
                    info('请在想要删除的信息前面打勾！');
                } else if (ret['res'] > 0) {
                    success('成功删除' + ret['res'] + '条信息！');
                    var tids = $('input[name=\'tids[]\']:checked:enabled').map(function () {
                        return $(this).val();
                    }).get();
                    for (var tidKey in tids) {
                        $('#row' + tids[tidKey]).remove();
                    }
                } else {
                    fail('删除失败，请重试！')
                }
            }).fail(function (ret) {
                console.log(ret);
                alert('网络出错，请重试！')
            })
        })
    </script>
@endsection