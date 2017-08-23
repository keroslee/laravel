@extends('layout',$userData)

@section('sidebar')
    @include('sidebar_admin',$userData)
@endsection

@section('content')
    <div class="box">
        <ol class="breadcrumb">
            <li class="active">当前位置：</li>
            <li class="active">首页</li>
            <li class="active">执法信息管理</li>
        </ol>
        <div class="centent">
            {{--@include('company_status',$status)--}}

            @include('admin.message')
            <h4>执法信息表</h4>

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
                    <td>目的</td>
                    <td>内容</td>
                    <td>时间</td>
                    <td>结果PDF</td>
                    <td>备注</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody>
                <?php $colors = ['active', 'success', 'info', 'warning', 'danger']; $idx = 0?>
                @foreach($results as $index => $result)
                    <tr class="{{$colors[$idx%count($colors)]}}" id="row{{$result->tid}}">
                        <td>
                            <div class="">
                                <label>
                                    <input type="checkbox" name="tids[]" value="{{$result->tid}}">
                                </label>
                            </div>
                        </td>
                        <td>{{$idx+1}}</td>
                        <td>{{$result->companyname}}</td>
                        <td>{{$result->mudi}}</td>
                        <td>
                            {{$result->content}}
                        </td>
                        <td>{{$result->sj}}</td>
                        <td>
                            @if($result->result)
                                <a href="{{$result->result}}">查看</a>
                            @endif
                        </td>
                        <td>{{$result->mark}}</td>
                        <td style="padding:0 8px;">
                            <button type="button" class="bj"
                                    data-toggle="modal" data-target="#modalEdit"
                                    id="btn{{$result->tid}}"
                                    data-tid="{{$result->tid}}"
                                    data-company-tid="{{$result->companytid}}"
                                    data-mudi="{{$result->mudi}}"
                                    data-content="{{$result->content}}"
                                    data-sj="{{$result->sj}}"
                                    data-result="{{$result->result}}"
                                    data-mark="{{$result->mark}}"><img src="/img/bj.png" width="20px;"/>编辑
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
                <button type="button" class="btn" id="add" data-toggle="modal" data-target="#modalEdit">增加</button>
                <button type="button" class="btn btn-del" id="del">删除</button>
                {{$results->links('vendor.pagination.default')}}
            </form>
        </div>


        <!-- add/edit-->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalEdit" aria-labelledby="modalEditTitle">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalEditTitle">编辑执法检查信息</h4>
                    </div>
                    <div class="modal-body">
                        <input id="tid" class="hidden">
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
                                <label for="inputPassword3" class="col-sm-2 control-label">目的</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mudi" placeholder="目的">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">内容</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="content" placeholder="内容"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">时间</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="sj" placeholder="时间">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">结果</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control hidden" id="result" placeholder="结果">
                                    <input type="file" class="form-control" id="fileResult">
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
                        <button type="button" class="btn" id="delConfirm">删除</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

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
            var mudi = button.data('mudi');
            var content = button.data('content');
            var sj = button.data('sj');
            var result = button.data('result');
            var mark = button.data('mark');

            modal.find('.modal-body #tid').val(tid);
            modal.find('.modal-body #companyTid').val(companyTid);
            modal.find('.modal-body #mudi').val(mudi);
            modal.find('.modal-body #content').val(content);
            modal.find('.modal-body #sj').val(sj);
            modal.find('.modal-body #result').val(result);
            modal.find('.modal-body #mark').val(mark);
        })

        $('#save').click(function (env) {
            var modal = $('#modalEdit');
            var method = 'upd';
            var tid = modal.find('.modal-body #tid').val();
            var data = {
                tid: modal.find('.modal-body #tid').val(),
                companytid: modal.find('.modal-body #companyTid').val(),
                mudi: modal.find('.modal-body #mudi').val(),
                content: modal.find('.modal-body #content').val(),
                sj: modal.find('.modal-body #sj').val(),
                result: modal.find('.modal-body #result').val(),
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
            var keys = ['tid', 'companyName', 'mudi', 'content', 'sj', 'result', 'mark'];
            var row = $('#row' + data['tid']);
            var btn = $('#btn' + data['tid']);

            if (row.length) {
                var cells = row.find('td');
                cells[2].innerHTML = $('#modalEdit').find('.modal-body #companyTid option:selected').text();
                cells[3].innerHTML = data['mudi'];
                cells[4].innerHTML = data['content'];
                cells[5].innerHTML = data['sj'];
                cells[6].innerHTML = '<a href="' + data['result'] + '">查看</a>';
                cells[7].innerHTML = data['mark'];
                var btn = $('#btn'+data['tid'])
                btn.data('tid',data['tid'])
                btn.data('company-tid',data['companytid'])
                btn.data('mudi',data['mudi'])
                btn.data('content',data['content'])
                btn.data('sj',data['sj'])
                btn.data('result',data['result'])
                btn.data('mark',data['mark'])
            } else {
                var table = document.getElementById('tableData')
                var row = table.insertRow();
                row.id='row'+data['tid'];
                var cell = row.insertCell();
                cell.innerHTML = '<div class="checkbox"><label><input type="checkbox" name="tids[]" value="' + data['tid'] + '"></label></div>';
                cell = row.insertCell();
                cell.innerHTML = table.rows.length - 1;
                cell = row.insertCell();
                cell.innerHTML = $('#modalEdit').find('.modal-body #companyTid option:selected').text();
                cell = row.insertCell();
                cell.innerHTML = data['mudi']
                cell = row.insertCell();
                cell.innerHTML = data['content'];
                cell = row.insertCell();
                cell.innerHTML = data['sj'];
                cell = row.insertCell();
                cell.innerHTML = '<a href="' + data['result'] + '">查看</a>';
                cell = row.insertCell();
                cell.innerHTML = data['mark'];
                var cell = row.insertCell();
                cell.innerHTML = '<button type="button" class="bj" data-toggle="modal" data-target="#modalEdit"' +
                        ' id="btn' + data['tid'] + '"' +
                        ' data-tid="' + data['tid'] + '"' +
                        ' data-company-tid="' + data['companytid'] + '"' +
                        ' data-mudi="' + data['mudi'] + '"' +
                        ' data-content="' + data['content'] + '"' +
                        ' data-sj="' + data['sj'] + '"' +
                        ' data-result="' + data['result'] + '"' +
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

        $('#fileResult').click(function () {
            var companyTid = $('#companyTid').val();
            if (companyTid) {
                return true;
            } else {
                alert('请先选择一个企业')
                return false;
            }
        });

        $('#fileResult').change(function () {
            var formData = new FormData();
            formData.append('file', $('#fileResult')[0].files[0]);
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
                $('#result').val(res['path'])
            }).fail(function (res) {
                console.log(res);
            });
        });
    </script>
@endsection