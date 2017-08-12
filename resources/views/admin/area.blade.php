@extends('layout',$userData)

@section('sidebar')
    @include('sidebar_admin',$userData)
@endsection

@section('content')
    <div class="box">
        <ol class="breadcrumb">
            <li class="active">当前位置：</li>
            <li class="active">首页</li>
            <li class="active">区域信息管理</li>
        </ol>
        <div class="centent">
            {{--@include('company_status',$status)--}}
            <h4>区域管理</h4>
            @include('admin.message')
            <?php $pareas = $results->where('parea', null);?>

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
                    <td>区域</td>
                    <td>所属区域</td>
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
                        <td>
                            @if($result->parea)
                                <a href="/admin/company?areaTid={{$result->tid}}"> {{$result->area}}</a>
                            @else
                                {{$result->area}}
                            @endif
                        </td>
                        <td><?php $parea = $pareas->where('tid', $result->parea)->first(); echo $parea ? $parea->area : ''?></td>
                        <td>{{$result->mark}}</td>
                        <td style="padding:0 8px;">
                            <button type="button" class="bj"
                                    data-toggle="modal" data-target="#modalEdit"
                                    id="btn{{$result->tid}}"
                                    data-tid="{{$result->tid}}"
                                    data-area="{{$result->area}}"
                                    data-p-area="{{$result->parea}}"
                                    data-mark="{{$result->mark}}"><img src="/img/bj.png" width="20px"/>编辑
                            </button>
                        </td>
                    </tr>
                    <?php $idx++;?>
                @endforeach
                </tbody>
            </table>
            {{$results->links('vendor.pagination.default')}}
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
                            <h4 class="modal-title" id="modalEditTitle">编辑区域信息</h4>
                        </div>
                        <div class="modal-body">
                            <input id="tid" style="display:none">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">区域</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="area" placeholder="区域名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">所属区域</label>
                                    <div class="col-sm-10">
                                        {{--<input type="text" class="form-control" id="pArea" placeholder="所属区域">--}}
                                        <select id="pArea" class="form-control">
                                            <option>请选择所属区域</option>
                                            @foreach($pareas as $parea)
                                                <option value="{{$parea->tid}}">{{$parea->area}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">备注</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="mark" placeholder="行业类别">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-del" data-dismiss="modal">取消</button>
                            <button type="button" class="btn " id="save">保存</button>
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
                            <h4 class="modal-title">确认要删除这些区域吗？</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-del" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary" id="delConfirm">删除</button>
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
            var area = button.data('area');
            var pArea = button.data('pArea');
            var mark = button.data('mark');


            if(tid&&!pArea) {
                modal.find('.modal-body #pArea').prop('disabled', true);
            }else{
                modal.find('.modal-body #pArea').prop('disabled', false);
            }
            modal.find('.modal-body #tid').val(tid);
            modal.find('.modal-body #area').val(area);
            modal.find('.modal-body #pArea').val(pArea);
            modal.find('.modal-body #mark').val(mark);
        })

        $('#save').click(function (env) {
            var modal = $('#modalEdit');
            var method = 'upd';
            var tid = modal.find('.modal-body #tid').val();
            var data = {
                tid: modal.find('.modal-body #tid').val(),
                area: modal.find('.modal-body #area').val(),
                pArea: modal.find('.modal-body #pArea').val(),
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
            var keys = ['tid', 'area', 'pArea', 'mark'];
            var row = $('#row' + data['tid']);
            var btn = $('#btn' + data['tid']);

            if (row.length) {
                var cells = row.find('td');
                cells[2].innerHTML = data['area'];
                cells[3].innerHTML = $('#modalEdit').find('.modal-body #pArea option:selected').text();
                cells[4].innerHTML = data['mark'];
            } else {
                var table = document.getElementById('tableData')
                var row = table.insertRow();

                var cell = row.insertCell();
                cell.innerHTML = '<div class="checkbox"><label><input type="checkbox" name="tids[]" value="' + data['tid'] + '"></label></div>';
                cell = row.insertCell();
                cell.innerHTML = table.rows.length - 1;
                cell = row.insertCell();
                cell.innerHTML = data['area'];
                cell = row.insertCell();
                cell.innerHTML = $('#modalEdit').find('.modal-body #pArea option:selected').text();
                cell = row.insertCell();
                cell.innerHTML = data['mark'];
                var cell = row.insertCell();
                cell.innerHTML = '<button type="button" class="bj" data-toggle="modal" data-target="#modalEdit"' +
                        ' id="btn' + data['tid'] + '"' +
                        ' data-tid="' + data['tid'] + '"' +
                        ' data-company-name="' + data['area'] + '"' +
                        ' data-p-area="' + data['parea'] + '"' +
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
                alert('请在想要删除的区域前面打勾！');
            }
        });

        $('#delConfirm').click(function (env) {
            var tids = $('input[name=\'tids[]\']:checked:enabled').map(function () {
                return $(this).val();
            }).get();


            $.post('{{$currentUrl}}/del', {_token: _token, tids: tids}).done(function (ret) {
                $('#modalConfirm').modal('hide');
                if (ret['res'] === 0) {
                    info('请在想要删除的区域前面打勾！');
                } else if (ret['res'] > 0) {
                    success('成功删除' + ret['res'] + '个区域！');
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