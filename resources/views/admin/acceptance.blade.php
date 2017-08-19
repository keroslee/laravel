@extends('layout',$userData)

@section('sidebar')
    @include('sidebar_admin',$userData)
@endsection

@section('content')
    <div class="box">
        <ol class="breadcrumb">
            <li class="active">当前位置：</li>
            <li class="active">首页</li>
            <li class="active">验收信息</li>
        </ol>
        <div class="centent">
            {{--@include('company_status',$status)--}}

            @include('admin.message')
            <h4>验收信息表</h4>

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
                    <td>验收文号</td>
                    <td>验收部门</td>
                    <td>验收时间</td>
                    <td>验收内容</td>
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
                        <td>{{$result->ysno}}</td>
                        <td>{{$result->ysbm}}</td>
                        <td>{{$result->yssj}}</td>
                        <td>
                            @if($result->content)
                                <a href="{{$result->content}}">查看</a>
                            @endif
                        </td>
                        <td>{{$result->mark}}</td>
                        <td style="padding:0 8px;">
                            <button type="button" class="bj"
                                    data-toggle="modal" data-target="#modalEdit"
                                    id="btn{{$result->tid}}"
                                    data-tid="{{$result->tid}}"
                                    data-company-tid="{{$result->companytid}}"
                                    data-ysno="{{$result->ysno}}"
                                    data-ysbm="{{$result->ysbm}}"
                                    data-yssj="{{$result->yssj}}"
                                    data-content="{{$result->content}}"
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
                            <h4 class="modal-title" id="modalEditTitle">编辑验收信息</h4>
                        </div>
                        <div class="modal-body">
                            <input id="tid" style="display:none">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">企业名称</label>
                                    <div class="col-sm-10">
                                        <select id="companyTid" class="form-control">
                                            <option>请选择企业</option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->tid}}">{{$company->companyname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">验收文号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ysno" placeholder="验收文号">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">验收部门</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ysbm" placeholder="验收部门">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">验收时间</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="yssj" placeholder="验收时间">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">验收内容</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control hidden" id="content" placeholder="验收内容">
                                    <input type="file" class="form-control" id="upload" accept="image/*,application/pdf">
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
                            <h4 class="modal-title">确认要删除这些验收信息吗？</h4>
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

        $('#modalEdit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            var tid = button.data('tid');
            var companyTid = button.data('companyTid');
            var ysno = button.data('ysno');
            var ysbm = button.data('ysbm');
            var yssj = button.data('yssj');
            var content = button.data('content');
            var mark = button.data('mark');

            modal.find('.modal-body #tid').val(tid);
            modal.find('.modal-body #companyTid').val(companyTid);
            modal.find('.modal-body #ysno').val(ysno);
            modal.find('.modal-body #ysbm').val(ysbm);
            modal.find('.modal-body #yssj').val(yssj);
            modal.find('.modal-body #content').val(content);
            modal.find('.modal-body #mark').val(mark);
        })

        $('#save').click(function (env) {
            var modal = $('#modalEdit');
            var method = 'upd';
            var tid = modal.find('.modal-body #tid').val();
            var data = {
                tid: modal.find('.modal-body #tid').val(),
                companytid: modal.find('.modal-body #companyTid').val(),
                ysno: modal.find('.modal-body #ysno').val(),
                ysbm: modal.find('.modal-body #ysbm').val(),
                yssj: modal.find('.modal-body #yssj').val(),
                content: modal.find('.modal-body #content').val(),
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
            var keys = ['tid', 'companyName', 'ysno', 'ysbm', 'yssj', 'content', 'mark'];
            var row = $('#row' + data['tid']);
            var btn = $('#btn' + data['tid']);

            if (row.length) {
                var cells = row.find('td');
                cells[2].innerHTML = $('#modalEdit').find('.modal-body #companyTid option:selected').text();
                cells[3].innerHTML = data['ysno'];
                cells[4].innerHTML = data['ysbm'];
		cells[5].innerHTML = data['yssj'];
		cells[6].innerHTML = '<a href="' + data['content'] + '" >查看</a>';
		cells[7].innerHTML = data['mark'];
            } else {
                var table = document.getElementById('tableData')
                var row = table.insertRow();

                var cell = row.insertCell();
                cell.innerHTML = '<div class="checkbox"><label><input type="checkbox" name="tids[]" value="' + data['tid'] + '"></label></div>';
                cell = row.insertCell();
                cell.innerHTML = table.rows.length - 1;
                cell = row.insertCell();
                cell.innerHTML = $('#modalEdit').find('.modal-body #companyTid option:selected').text();
                cell = row.insertCell();
                cell.innerHTML = data['ysno']
                cell = row.insertCell();
                cell.innerHTML = data['ysbm'];
		cell = row.insertCell();
                cell.innerHTML = data['yssj'];
		cell = row.insertCell();
                cell.innerHTML = '<a href="' + data['content'] + '" >查看</a>';
		cell = row.insertCell();
                cell.innerHTML = data['mark'];
                var cell = row.insertCell();
                cell.innerHTML = '<button type="button" class="bj" data-toggle="modal" data-target="#modalEdit"' +
                        ' id="btn' + data['tid'] + '"' +
                        ' data-tid="' + data['tid'] + '"' +
                        ' data-company-name="' + data['companyTid'] + '"' +
                        ' data-ysno="' + data['ysno'] + '"' +
                        ' data-ysbm="' + data['ysbm'] + '"' +
                        ' data-yssj="' + data['yssj'] + '"' +
                        ' data-content="' + data['content'] + '"' +
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

        $('#upload').click(function () {
            var companyTid = $('#companyTid').val();
            if (companyTid) {
                return true;
            } else {
                alert('请先选择一个企业')
                return false;
            }
        });

        $('#upload').change(function () {
            var formData = new FormData();
            formData.append('file', $('#upload')[0].files[0]);
            formData.append('_token', '{{csrf_token()}}');
            var companyTid = $('#companyTid').val();
            formData.append('companyTid', companyTid);

            $.ajax({
                url: '/admin/upload',
                type: 'POST',
                cache: false,
                data: formData,
                processData: false,
                contentType: false
            }).done(function (res) {
                $('#content').val(res['path'])
            }).fail(function (res) {
                console.log(res);
            });
        });
    </script>
@endsection