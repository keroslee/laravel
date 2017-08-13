@extends('layout',$userData)

@section('sidebar')
    @include('sidebar_admin',$userData)
@endsection

@section('content')
    <div class="box">
        <ol class="breadcrumb">
            <li class="active">当前位置：</li>
            <li class="active">首页</li>
            <li class="active">监测点信息管理</li>
        </ol>
        <div class="centent">
            {{--@include('company_status',$status)--}}

            @include('admin.message')

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
                    <td>所属企业</td>
                    <td>监测点名称</td>
                    <td>检测级别</td>
                    <td>检测类型</td>
                    <td>治理设备</td>
                    <td>辅助治理设备</td>
                    <td>备注</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $colors = ['active', 'success', 'info', 'warning', 'danger'];
                $idx = 0;
                $jcType = ['废水', '废气', '固废', '危废'];
                ?>
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
                        <td>{{$result->stationname}}</td>
                        <td>{{$result->levels}}</td>
                        <td>
                            @if(isset($jcType[$result->type]))
                                {{$jcType[$result->type]}}
                            @endif
                        </td>
                        <td>
                            @if(isset($terminals[$result->companytid]))
                                <?php
                                $myTerminals = $terminals[$result->companytid];
                                $mySelectedTerminals = explode(',', $result->zlsbs)
                                ?>
                                @foreach($myTerminals as $terminal)
                                    @if(in_array($terminal->code,$mySelectedTerminals))
                                        {{$terminal->terminalname}}
                                        @if($loop->iteration != $loop->count)
                                            ,
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td>{{$result->zlsbs_fz}}</td>
                        <td>{{$result->mark}}</td>
                        <td class="etd">
                            <button type="button" class="bj"
                                    {{--data-toggle="modal" data-target="#modalEdit"--}}
                                    id="btn{{$result->tid}}"
                                    data-tid="{{$result->tid}}"
                                    data-companytid="{{$result->companytid}}"
                                    data-stationname="{{$result->stationname}}"
                                    data-levels="{{$result->levels}}"
                                    data-type="{{$result->type}}"
                                    data-zlsbs="{{$result->zlsbs}}"
                                    data-zlsbs_fz="{{$result->zlsbs_fz}}"
                                    data-mark="{{$result->mark}}"><img src="/img/bj.png" width="20px"/>编辑
                            </button>
                        </td>
                    </tr>
                    <?php $idx++;?>
                @endforeach
                </tbody>
            </table>
            {{$results->appends(['companyName' => $companyName])->links('vendor.pagination.default')}}

            @if(Auth::user()->type == 2)
            <form class="form-inline" action="{{$currentUrl}}" method="post">
                {{csrf_field()}}
                <button type="button" class="btn " id="add" >增加</button>
                <button type="button" class="btn btn-del" id="del">删除</button>
            </form>
            @endif

            <!-- add/edit-->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalEdit" aria-labelledby="modalEditTitle">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modalEditTitle">编辑监测点信息</h4>
                        </div>
                        <div class="modal-body">
                            <input id="tid" style="display:none">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">所属企业</label>
                                    <div class="col-sm-9">
                                        <select id="companytid" class="form-control">
                                            <option>请选择企业</option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->tid}}">{{$company->companyname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">监测点名称</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="stationname" placeholder="监测点名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">检测级别</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="levels" placeholder="检测级别">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">检测类型</label>
                                    <div class="col-sm-9">
                                        <select id="type" class="form-control" placeholder="检测类型">
                                            <option value="0">废水</option>
                                            <option value="1">废气</option>
                                            <option value="2">固废</option>
                                            <option value="3">危废</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">治理设备</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control hidden" id="zlsbs" placeholder="治理设备">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">辅助治理设备</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="zlsbs_fz" placeholder="治理设备">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">备注</label>
                                    <div class="col-sm-9">
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
                            <button type="button" class="btn" id="delConfirm">删除</button>
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

        $('#modalEdit11').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            var tid = button.data('tid');
            var companytid = button.data('companytid');
            var stationname = button.data('stationname');
            var levels = button.data('levels');
            var type = button.data('type');
            var zlsbs = button.data('zlsbs');
            var zlsbs_fz = button.data('zlsbs_fz');
            var mark = button.data('mark');

            modal.find('.modal-body #tid').val(tid);
            modal.find('.modal-body #companytid').val(companytid);
            modal.find('.modal-body #stationname').val(stationname);
            modal.find('.modal-body #levels').val(levels);
            modal.find('.modal-body #type').val(type);
            modal.find('.modal-body #zlsbs').val(zlsbs);
            modal.find('.modal-body #zlsbs_fz').val(zlsbs_fz);
            modal.find('.modal-body #mark').val(mark);
        })

        $('#save').click(function (env) {
            var modal = $('#modalEdit');
            var method = 'upd';
            var tid = modal.find('.modal-body #tid').val();
            var data = {
                tid: modal.find('.modal-body #tid').val(),
                companytid: modal.find('.modal-body #companytid').val(),
                stationname: modal.find('.modal-body #stationname').val(),
                levels: modal.find('.modal-body #levels').val(),
                type: modal.find('.modal-body #type').val(),
                zlsbs: modal.find('.modal-body #zlsbs').val(),
                zlsbs_fz: modal.find('.modal-body #zlsbs_fz').val(),
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
            var keys = ['tid', 'companytid', 'stationname', 'levels', 'type', 'zlsbs', 'zlsbs_fz', 'mark'];
            var row = $('#row' + data['tid']);
            var btn = $('#btn' + data['tid']);
            data['zlsbs'] = ''
            $('#modalEdit input[type=\'checkbox\']:checked').each(function (index) {
                data['zlsbs'] += index ? ',' + $(this).parent().text() : $(this).parent().text();
            });

            if (row.length) {
                var cells = row.find('td');
                cells[2].innerHTML = $('#modalEdit').find('.modal-body #companytid option:selected').text();
                cells[3].innerHTML = data['stationname'];
                cells[4].innerHTML = data['levels'];
                cells[5].innerHTML = $('#modalEdit').find('.modal-body #type option:selected').text();
                cells[6].innerHTML = data['zlsbs'];
                cells[7].innerHTML = data['zlsbs_fz'];
                cells[8].innerHTML = data['mark'];
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
                cell.innerHTML = data['stationname'];
                cell = row.insertCell();
                cell.innerHTML = data['levels'];
                cell = row.insertCell();
                cell.innerHTML = $('#modalEdit').find('.modal-body #type option:selected').text();
                cell = row.insertCell();
                cell.innerHTML = data['zlsbs'];
                cell = row.insertCell();
                cell.innerHTML = data['zlsbs_fz'];
                cell = row.insertCell();
                cell.innerHTML = data['mark'];
                var cell = row.insertCell();
                cell.innerHTML = '<button type="button" class="bj" data-toggle="modal" data-target="#modalEdit"' +
                        ' id="btn' + data['tid'] + '"' +
                        ' data-tid="' + data['tid'] + '"' +
                        ' data-companytid="' + data['companytid'] + '"' +
                        ' data-stationname="' + data['stationname'] + '"' +
                        ' data-levels="' + data['levels'] + '"' +
                        ' data-type="' + data['type'] + '"' +
                        ' data-zlsbs="' + data['zlsbs'] + '"' +
                        ' data-zlsbs_fz="' + data['zlsbs_fz'] + '"' +
                        ' data-mark="' + data['mark'] + '"><img src="/img/bj.png" width="20px"/>编辑</button>';
            }
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

        $('.bj').click(function (event) {
            var button = $(this);
            var data = {
                _token: _token,
                companytid: button.data('companytid'),
                tid: button.data('tid')
            };

            $.post('/admin/station/terminals', data).done(function (ret) {
                console.log(ret)

                var modal = $('#modalEdit');

                var tid = button.data('tid');
                var companytid = button.data('companytid');
                var stationname = button.data('stationname');
                var levels = button.data('levels');
                var type = button.data('type');
                var zlsbs = button.data('zlsbs');
                var zlsbs_fz = button.data('zlsbs_fz');
                var mark = button.data('mark');

                modal.find('.modal-body #tid').val(tid);
                modal.find('.modal-body #companytid').val(companytid);
                modal.find('.modal-body #stationname').val(stationname);
                modal.find('.modal-body #levels').val(levels);
                modal.find('.modal-body #type').val(type);
                modal.find('.modal-body #zlsbs').val(zlsbs);
                modal.find('.modal-body #zlsbs_fz').val(zlsbs_fz);
                modal.find('.modal-body #mark').val(mark);

                var zlsbs = modal.find('.modal-body #zlsbs').parent();
                var allTerminals = ret['allTerminals'];
                var myTerminals = ret['myTerminals'];

                modal.find('.modal-body #zlsbs').parent().children('label').remove()
                for (var index in allTerminals) {
                    if ($.inArray(allTerminals[index]['code'], myTerminals) > -1)
                        zlsbs.append('<label><input type="checkbox" checked value="' + allTerminals[index]['code'] + '">' + allTerminals[index]['terminalname'] + '</label>');
                    else
                        zlsbs.append('<label><input type="checkbox" value="' + allTerminals[index]['code'] + '">' + allTerminals[index]['terminalname'] + '</label>');
                }

                $('#modalEdit input[type=\'checkbox\']').change(function () {
                    console.log('change')
                    var zlsbs = '';
                    $('#modalEdit input[type=\'checkbox\']:checked').each(function (index) {
                        zlsbs += index ? ',' + $(this).val() : $(this).val();
                    });
                    console.log(zlsbs)
                    $('#modalEdit').find('.modal-body #zlsbs').val(zlsbs);
                })

                modal.modal('show');
            }).fail(function (ret) {
                console.log(ret)
            })
        })

        $('#companytid').change(function (event) {
            var selectCompany = $(this);
            var data = {
                _token: _token,
                companytid: selectCompany.val()
            };

            $.post('/admin/station/terminals', data).done(function (ret) {
                $('#modalEdit').find('.modal-body #zlsbs').parent().children('label').remove()
                var zlsbs = $('#modalEdit').find('.modal-body #zlsbs').parent();
                var allTerminals = ret['allTerminals'];
                for (var index in allTerminals) {
                    zlsbs.append('<label><input type="checkbox" value="' + allTerminals[index]['code'] + '">' + allTerminals[index]['terminalname'] + '</label>');
                }
                $('#modalEdit input[type=\'checkbox\']').change(function () {
                    console.log('change')
                    var zlsbs = '';
                    $('#modalEdit input[type=\'checkbox\']:checked').each(function (index) {
                        zlsbs += index ? ',' + $(this).val() : $(this).val();
                    });
                    console.log(zlsbs)
                    $('#modalEdit').find('.modal-body #zlsbs').val(zlsbs);
                })
            }).fail(function (ret) {
                console.log(ret);
            })
        })

        $('#add').click(function () {
            var modal = $('#modalEdit');
            modal.find('.modal-body #tid').val('');
            modal.find('.modal-body #companytid').val('');
            modal.find('.modal-body #stationname').val('');
            modal.find('.modal-body #levels').val('');
            modal.find('.modal-body #type').val('');
            modal.find('.modal-body #zlsbs').val('');
            modal.find('.modal-body #zlsbs_fz').val('');
            modal.find('.modal-body #mark').val('');
            $('#modalEdit input[type=\'checkbox\']').parent().remove();

            modal.modal('show')
        })
    </script>
@endsection