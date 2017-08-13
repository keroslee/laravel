@extends('layout',$userData)

@section('sidebar')
    @include('sidebar_admin',$userData)
@endsection

@section('content')
    <div class="box">
        <ol class="breadcrumb">
            <li class="active">当前位置：</li>
            <li class="active">首页</li>
            <li class="active">单位基本信息管理</li>
        </ol>
        <div class="centent">

            {{--@include('company_status',$status)--}}

            <h4>单位基本信息表</h4>
            @if(Auth::user()->type == 2)
            <form class="form-inline" action="{{$currentUrl}}" method="post">
                {{csrf_field()}}
                <input name="areaTid" value="{{$areaTid}}" class="hidden">
                <div class="form-group">
                    <label for="companyName">单位名称</label>
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="输入单位名称" value="{{$companyName}}">
                </div>
                <button type="submit" class="btn ">查询</button>
                <button type="button" class="btn " id="add" data-toggle="modal" data-target="#modalEdit">增加</button>
                <button type="button" class="btn btn-del" id="del">删除</button>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">导入</label>
                    <div class="col-sm-6">
                        <input id="import" name="import" type="file" class="form-horizontal" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                    </div>
                </div>
            </form>
            @endif
            @include('admin.message')

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
                    <td>所属区域</td>
                    <td>行业类别</td>
                    <td>重点类型</td>
                    <td>污染物类型</td>
                    <td>地址</td>
                    <td>法人</td>
                    <td>联系人</td>
                    <td>联系电话</td>
                    <td>工艺逻辑图</td>
                    <td>操作</td>
                </tr>
                </thead>
                <tbody>
                <?php $colors = ['active', 'success', 'info', 'warning', 'danger']; $idx = 0?>
                @foreach($companies as $index => $company)
                    <tr class="{{$colors[$idx%count($colors)]}}" id="row{{$company->tid}}">
                        <td>
                            <div class="#">
                                <label>
                                    <input type="checkbox" name="tids[]" value="{{$company->tid}}">
                                </label>
                            </div>
                        </td>
                        <td>{{$idx+1}}</td>
                        <td>{{$company->companyname}}</td>
                        <td>{{$company->area}}</td>
                        <td>{{$company->hylb}}</td>
                        <td>{{$company->jclx}}</td>
                        <td>{{$company->wrwlx}}</td>
                        <td>{{$company->address}}</td>
                        <td>{{$company->faren}}</td>
                        <td>{{$company->lianxiren}}</td>
                        <td>{{$company->lianxitel}}</td>
                        <td>
                            @if($company->gongyitu)
                                <img src="{{$company->gongyitu}}" width="50px">
                            @endif
                        </td>
                        <td style="padding:0 8px;">
                            <button type="button" class="bj"
                                    data-toggle="modal" data-target="#modalEdit"
                                    id="btn{{$company->tid}}"
                                    data-tid="{{$company->tid}}"
                                    data-company-name="{{$company->companyname}}"
                                    data-p-area="{{$company->parea}}"
                                    data-hylb="{{$company->hylb}}"
                                    data-jclx="{{$company->jclx}}"
                                    data-wrwlx="{{$company->wrwlx}}"
                                    data-address="{{$company->address}}"
                                    data-fa-ren="{{$company->faren}}"
                                    data-lian-xi-ren="{{$company->lianxiren}}"
                                    data-lian-xi-tel="{{$company->lianxitel}}"
                                    data-userid="{{$company->userid}}"
                                    data-acc="{{$company->email}}"
                                    data-passwd="{{$company->password}}"
                                    data-gong-yi-tu="{{$company->gongyitu}}"><img src="/img/bj.png" width="20px"/>编辑
                            </button>
                        </td>
                    </tr>
                    <?php $idx++;?>
                @endforeach
                </tbody>
            </table>
        {{--{{$companies->appends(['companyName' => $companyName])->links('vendor.pagination.default')}}--}}

            <!-- add/edit-->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalEdit" aria-labelledby="modalEditTitle">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modalEditTitle">编辑企业信息</h4>
                        </div>
                        <div class="modal-body">
                            <input id="tid" class="" style=" display:none;">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">企业名称</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="companyName" placeholder="企业名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">所属区域</label>
                                    <div class="col-sm-9">
                                        <select id="pArea" class="form-control">
                                            <option>请选择所属区域</option>
                                            @foreach($pareas as $parea)
                                                <option value="{{$parea->tid}}">{{$parea->area}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">行业类别</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="hylb" placeholder="行业类别">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">重点类型</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="jclx" placeholder="重点类型">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">污染物类型</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="wrwlx" placeholder="污染物类型">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">地址</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" placeholder="地址">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">法人</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="faRen" placeholder="法人">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">联系人</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="lianXiRen" placeholder="联系人">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">联系电话</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="lianXiTel" placeholder="联系电话">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">登录帐号</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="acc" placeholder="登录帐号">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="userid">
                                    <label for="inputPassword3" class="col-sm-3 control-label">登录密码</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="passwd_bcrypt">
                                        <input type="text" class="form-control" id="passwd" placeholder="登录密码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">工艺逻辑图</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control hidden" id="gongYiTu" placeholder="工艺逻辑图">
                                        <input type="file" class="form-control" id="upload" accept="image/*">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn " data-dismiss="modal">取消</button>
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
                            <h4 class="modal-title">确认要删除这些公司吗？</h4>
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
            var companyName = button.data('companyName');
            var pArea = button.data('pArea');
            var hylb = button.data('hylb');
            var jclx = button.data('jclx');
            var wrwlx = button.data('wrwlx');
            var address = button.data('address');
            var faRen = button.data('faRen');
            var lianXiRen = button.data('lianXiRen');
            var lianXiTel = button.data('lianXiTel');
            var gongYiTu = button.data('gongYiTu');
            var userid = button.data('userid');
            var acc = button.data('acc');
            var passwd = button.data('passwd');

            modal.find('.modal-body #tid').val(tid);
            modal.find('.modal-body #companyName').val(companyName);
            modal.find('.modal-body #pArea').val(pArea);
            modal.find('.modal-body #hylb').val(hylb);
            modal.find('.modal-body #jclx').val(jclx);
            modal.find('.modal-body #wrwlx').val(wrwlx);
            modal.find('.modal-body #address').val(address);
            modal.find('.modal-body #faRen').val(faRen);
            modal.find('.modal-body #lianXiRen').val(lianXiRen);
            modal.find('.modal-body #lianXiTel').val(lianXiTel);
            modal.find('.modal-body #gongYiTu').val(gongYiTu);
            modal.find('.modal-body #userid').val(userid);
            modal.find('.modal-body #acc').val(acc);
            modal.find('.modal-body #passwd_bcrypt').val(passwd);
        })

        $('#save').click(function (env) {
            var modal = $('#modalEdit');
            var method = 'upd';
            var tid = modal.find('.modal-body #tid').val();
            var data = {
                tid: modal.find('.modal-body #tid').val(),
                companyName: modal.find('.modal-body #companyName').val(),
                pArea: modal.find('.modal-body #pArea').val(),
                hylb: modal.find('.modal-body #hylb').val(),
                jclx: modal.find('.modal-body #jclx').val(),
                wrwlx: modal.find('.modal-body #wrwlx').val(),
                address: modal.find('.modal-body #address').val(),
                faRen: modal.find('.modal-body #faRen').val(),
                lianXiRen: modal.find('.modal-body #lianXiRen').val(),
                lianXiTel: modal.find('.modal-body #lianXiTel').val(),
                gongYiTu: modal.find('.modal-body #gongYiTu').val(),
            };
            var passwd = modal.find('.modal-body #passwd').val();
            if(!passwd){
                passwd = modal.find('.modal-body #passwd_bcrypt').val();
            }
            var user = {
                userid: modal.find('.modal-body #userid').val(),
                acc: modal.find('.modal-body #acc').val(),
                passwd: passwd,}
            data = {data:data,user:user}

            if (data['data']['tid']) {
                postData(data, method);
            } else {
                $.post('/uuid', {_token: _token}).done(function (ret) {
                    data['data']['tid'] = ret['tid'];
                    method = 'add';
                    postData(data, method);
                }).fail(function (ret) {
                    data['data']['tid'] = $.guid++;
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
                    fail(ret['err'])
                }
            }).fail(function (ret) {
                console.log(ret);
                alert('网络出错，请重试！')
            });
        }

        function updateRow(data) {
            var userData = data['user']
            var data = data['data']
            var keys = ['tid', 'companyName', 'pArea', 'hylb', 'jclx', 'wrwlx', 'address', 'faRen', 'lianXiRen', 'lianXiTel', 'gongYiTu'];
            var row = $('#row' + data['tid']);
            var btn = $('#btn' + data['tid']);

            if (row.length) {
                var cells = row.find('td');
                cells[2].innerHTML = data['companyName'];
                cells[3].innerHTML = $('#modalEdit').find('.modal-body #pArea option:selected').text();
                cells[4].innerHTML = data['hylb'];
                cells[5].innerHTML = data['jclx'];
                cells[6].innerHTML = data['wrwlx'];
                cells[7].innerHTML = data['address'];
                cells[8].innerHTML = data['faRen'];
                cells[9].innerHTML = data['lianXiRen'];
                cells[10].innerHTML = data['lianXiTel'];
                cells[11].innerHTML = '<img width="50px;" src="' + data['gongYiTu'] + '">';
                var cell = cells[12];
            } else {
                var table = document.getElementById('tableData')
                var row = table.insertRow();

                var cell = row.insertCell();
                cell.innerHTML = '<div class="checkbox"><label><input type="checkbox" name="tids[]" value="' + data['tid'] + '"></label></div>';
                cell = row.insertCell();
                cell.innerHTML = table.rows.length - 1;
                cell = row.insertCell();
                cell.innerHTML = data['companyName'];
                cell = row.insertCell();
                cell.innerHTML = $('#modalEdit').find('.modal-body #pArea option:selected').text();
                cell = row.insertCell();
                cell.innerHTML = data['hylb'];
                cell = row.insertCell();
                cell.innerHTML = data['jclx'];
                cell = row.insertCell();
                cell.innerHTML = data['wrwlx'];
                cell = row.insertCell();
                cell.innerHTML = data['address'];
                cell = row.insertCell();
                cell.innerHTML = data['faRen'];
                cell = row.insertCell();
                cell.innerHTML = data['lianXiRen'];
                cell = row.insertCell();
                cell.innerHTML = data['lianXiTel'];
                cell = row.insertCell();
                cell.innerHTML = '<img width="50px" src="' + data['gongYiTu'] + '">';
                var cell = row.insertCell();
            }
            cell.innerHTML = '<button type="button" class="bj" data-toggle="modal" data-target="#modalEdit"' +
                    ' id="btn' + data['tid'] + '"' +
                    ' data-tid="' + data['tid'] + '"' +
                    ' data-company-name="' + data['companyName'] + '"' +
                    ' data-p-area="' + $('#modalEdit').find('.modal-body #pArea option:selected').text() + '"' +
                    ' data-hylb="' + data['hylb'] + '"' +
                    ' data-jclx="' + data['jclx'] + '"' +
                    ' data-wrwlx="' + data['wrwlx'] + '"' +
                    ' data-address="' + data['address'] + '"' +
                    ' data-fa-ren="' + data['faRen'] + '"' +
                    ' data-lian-xi-ren="' + data['lianXiRen'] + '"' +
                    ' data-lian-xi-tel="' + data['lianXiTel'] + '"' +
                    ' data-gong-yi-tu="' + data['gongYiTu'] + '"' +
                    ' data-userid="' + userData['userid'] + '"' +
                    ' data-acc="' + userData['acc'] + '"' +
                    ' data-passwd="' + userData['passwd'] + '"' +
                    '><img src="/img/bj.png" width="20px"/>编辑</button>';
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
                alert('请在想要删除的公司前面打勾！');
            }
        });

        $('#delConfirm').click(function (env) {
            var tids = $('input[name=\'tids[]\']:checked:enabled').map(function () {
                return $(this).val();
            }).get();


            $.post('{{$currentUrl}}/del', {_token: _token, tids: tids}).done(function (ret) {
                $('#modalConfirm').modal('hide');
                if (ret['res'] === 0) {
                    info('请在想要删除的公司前面打勾！');
                } else if (ret['res'] > 0) {
                    success('成功删除' + ret['res'] + '个公司！');
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

        $('#upload').change(function () {
            var formData = new FormData();
            formData.append('file', $('#upload')[0].files[0]);
            formData.append('_token', '{{csrf_token()}}');
            formData.append('companyTid', $('#tid').val());
            $.ajax({
                url: '/admin/upload',
                type: 'POST',
                cache: false,
                data: formData,
                processData: false,
                contentType: false
            }).done(function (res) {
                $('#gongYiTu').val(res['path'])
            }).fail(function (res) {
                console.log(res);
            });
        });

        $('#import').click(function () {
            $('#import').val(null);
        })
        $('#import').change(function () {
            var formData = new FormData();
            formData.append('file', $('#import')[0].files[0]);
            formData.append('_token', '{{csrf_token()}}');
            formData.append('companyTid', $('#tid').val());
            $.ajax({
                url: '/admin/company/import',
                type: 'POST',
                cache: false,
                data: formData,
                processData: false,
                contentType: false
            }).done(function (res) {
                if(res == 'success'){
                    success('导入成功！');
                }else{
                    success('保存成功！');
                }
            }).fail(function (res) {
                console.log(res);
            });
        });
    </script>
@endsection