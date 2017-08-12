@extends('layout',$userData)

@section('sidebar')
{{--    @include('sidebar',$userData)--}}
@endsection

@section('content')
    <div style="padding:20px 0;">
        
        <div class="centent">
            @if($rightError)
                <h3>'您没有查看该页面的权限'</h3>
            @else
                @include('admin.message')
                <h4>用户权限设置</h4>
                <div class="centent">
                    <div style="padding:10px 0; border-bottom:1px solid #ccc;">
                        <span>用户：</span><br/>
                        @foreach($users as $user)
                            <label class="radio-inline" style="padding-right:40px; padding-left:40px;">
                                <input type="radio" name="radioUser" value="{{$user->id}}">
                                <span style="color:#1fb5ac">{{$user->name}}</span>
                            </label>
                        @endforeach
                    </div>
                    <div style="padding-top:20px;">
                        <span>权限管理：</span><br/>

                        @foreach($areasBig as $areaB)

                            <div class="adm">

                                <label class="checkbox-inline" style="margin-bottom:10px;">
                                    <input type="checkbox" name="areabig" value="{{$areaB->tid}}">
                                    <span style="font-weight:800; font-size:16px; color:#199a92;">{{$areaB->area}}&nbsp;&nbsp;>></span>
                                </label>
                                <div class="quyu">

                                    @foreach($areasLittle as $areaL)
                                        @if($areaL->parea == $areaB->tid)
                                            <div style="margin-bottom:5px; overflow:hidden;">
                                                <label class="checkbox-inline" style="float:left; margin-left:20px;">
                                                    <input type="checkbox" name="arealittle" value="{{$areaL->tid}}" data-parea="{{$areaL->parea}}">
                                                    <span style=" font-weight:700; font-size:14px; color:#1fb5ac;">{{$areaL->area}}</span>
                                                </label>
                                            </div>

                                            <div class="111" style="margin-left:40px;">

                                                @foreach($companies as $company)
                                                    @if($company->parea == $areaL->tid)
                                                        <label class="checkbox-inline">
                                                            <input id="{{$company->tid}}" type="checkbox" name="companytid[]" value="{{$company->tid}}" data-parea="{{$company->parea}}">
                                                            <span style="color:#666;">{{$company->companyname}}</span>
                                                        </label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button id="save" class="save btn">保存</button>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('input[name=\'radioUser\']').on('change', function () {
            var userId = $(this).val();

            $.post('{{$currentUrl}}/userright', {_token: '{{csrf_token()}}', userId: userId}).done(function (ret) {
                console.log(ret);
                if (ret['rights']) {
                    $('input[name=\'companytid\[\]\']').prop('checked', false);
                    for (var index in ret['rights']) {
                        var right = ret['rights'][index]['companytid'];
                        $('#' + right).prop('checked', true);
                    }
                }
            }).fail(function (ret) {
                console.log(ret);
            })
        });

        $('input[name=\'areabig\']').on('change', function () {
            console.log($(this).val());
            var tid = $(this).val();
            var checked = $(this).is(':checked');
            $('input[name=\'arealittle\']').each(function (index) {
                console.log($(this).val());
                if ($(this).data('parea') == tid) {
                    $(this).prop('checked', checked).triggerHandler('change');
                }
            })
        })

        $('input[name=\'arealittle\']').on('change', function () {
            console.log($(this).val());
            var tid = $(this).val();
            var checked = $(this).is(':checked');
            $('input[name=\'companytid\[\]\']').each(function (index) {
                console.log($(this).val());
                if ($(this).data('parea') == tid) {
                    $(this).prop('checked', checked);
                }
            })
        });

        $('#save').click(function (env) {
            var tids = [];
            $('input[name=\'companytid\[\]\']:checked').each(function (index) {
                var tid = $(this).val();
                tids.push(tid);
            })
            console.log(tids);
            var userId = $('input[name=\'radioUser\']:checked').val();

            var data = {
                _token: '{{csrf_token()}}',
                userId: userId,
                tids: tids
            }

            if (!userId) {
                alert('请选择用户');
            } else {
                $.post('{{$currentUrl}}/upd', data).done(function (ret) {
                    console.log(ret);
                    if (ret['res']) {
                        success('成功');
                    } else {
                        fail('失败')
                    }
                }).fail(function (ret) {
                    console.log(ret);
                    alert('网络出错了，请重试')
                })
            }
        })
    </script>
@endsection