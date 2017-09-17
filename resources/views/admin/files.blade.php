@extends('layout',$userData)

@section('sidebar')
    @include('sidebar_admin',$userData)
@endsection

@section('content')
    <div class="box">
        <ol class="breadcrumb">
            <li class="active">当前位置：</li>
            <li class="active">首页</li>
            <li class="active">文件管理</li>
        </ol>
        <div class="centent">
            <h4>我的文件</h4>
            @if(Auth::user()->type == 3)
                <form class="form-inline" action="{{$currentUrl}}/upload" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="mark">文件备注</label>
                        <input type="text" class="form-control" id="mark" name="mark" placeholder="输入文件备注">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input id="file" name="file" type="file" class="form-horizontal"/>
                        </div>
                    </div>
                    <button type="button" class="btn " id="upload">上传</button>
                    <button type="button" class="btn btn-del" id="del">删除</button>
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
                    <td>文件备注</td>
                    <td>上传时间</td>
                    <td>下载文件</td>
                </tr>
                </thead>
                <tbody>
                <?php $colors = ['active', 'success', 'info', 'warning', 'danger']; $idx = 0?>
                @foreach($files as $index => $file)
                    <tr class="{{$colors[$idx%count($colors)]}}" id="row{{$file->id}}">
                        <td>
                            <div class="#">
                                <label>
                                    <input type="checkbox" name="ids[]" value="{{$file->id}}">
                                </label>
                            </div>
                        </td>
                        <td>{{$idx+1}}</td>
                        <td>{{$file->companyname}}</td>
                        <td>{{$file->mark}}</td>
                        <td>{{$file->upload_time}}</td>
                        <td>
                            @if($file->path)
                                <a href="{{$file->path}}">下载</a>
                            @endif
                        </td>
                    </tr>
                    <?php $idx++;?>
                @endforeach
                </tbody>
            </table>
            {{ $files->links() }}

            <!-- del confirm -->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalConfirm">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">确认要删除这些文件吗？</h4>
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

        $('#selectAll').click(function (env) {
            $('input[type*=\'checkbox\']').prop('checked', this.checked);
        })

        $('#del').click(function (env) {
            var tids = $('input[name=\'ids[]\']:checked:enabled').map(function () {
                return $(this).val();
            }).get();
            if (tids.length > 0) {
                $('#modalConfirm').modal('show');
            } else {
                alert('请在想要删除的文件前面打勾！');
            }
        });

        $('#delConfirm').click(function (env) {
            var ids = $('input[name=\'ids[]\']:checked:enabled').map(function () {
                return $(this).val();
            }).get();


            $.post('{{$currentUrl}}/del', {_token: _token, ids: ids}).done(function (ret) {
                $('#modalConfirm').modal('hide');
                if (ret['res'] === 0) {
                    info('请在想要删除的公司前面打勾！');
                } else if (ret['res'] > 0) {
                    success('成功删除' + ret['res'] + '个文件！');
                    window.location.href = window.location.href
                } else {
                    fail('删除失败，请重试！')
                }
            }).fail(function (ret) {
                console.log(ret);
                alert('网络出错，请重试！')
            })
        })

        $('#import').click(function () {
            $('#import').val(null);
        })
        $('#upload').click(function () {
            var formData = new FormData();
            formData.append('mark', $('#mark').val());
            formData.append('file', $('#file')[0].files[0]);
            formData.append('_token', '{{csrf_token()}}');

            $.ajax({
                url: '/admin/files/upload',
                type: 'POST',
                cache: false,
                data: formData,
                processData: false,
                contentType: false
            }).done(function (res) {
                if(res['res'] == 'success'){
                    success('上传成功！');
                    window.location.href = window.location.href
                }else{
                    var msg = res['msg'];
                    if(msg.indexOf('cannot insert') >-1){
                        fail('上传失败！请检查账号是否为空！');
                    }else{
                        fail('上传失败！');
                    }
                }
            }).fail(function (res) {
                console.log(res);
                fail('网络出错！')
            });
        });
    </script>
@endsection