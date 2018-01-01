@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="nav nav-list">
                            <li class="active"><a href="/home">用户管理</a></li>
                            <li><a href="/coupon">优惠券管理</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <form class="form-inline">
                            <select id="brand" class="form-control">
                                <option value="0">所有品牌</option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand}}" {{$sel1==$brand?'selected':''}}>{{$brand}}</option>
                                @endforeach
                            </select>
                            <select id="customer-type" class="form-control">
                                <option value="0">所有类型</option>
                                @foreach($types as $type)
                                    <option value="{{$type}}" {{$sel2==$type?'selected':''}}>{{$type}}</option>
                                @endforeach
                            </select>
                            <button id="btn-search" type="button" class="btn btn-primary mb-2">搜索</button>
                            <button id="btn-create" type="button" class="btn btn-primary mb-2">添加</button>
                        </form>
                    </div>

                    <div class="panel-body">
                        {{--@if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif--}}
                        <table class="table">
                            <tr>
                                <th>优惠券名</th>
                                <th>品牌</th>
                                <th>开始时间</th>
                                <th>结束时间</th>
                                <th>人群</th>
                                <th>类型</th>
                                <th>操作</th>
                            </tr>
                            <?php $colors = ['active', 'success', 'info', 'warning', 'danger']?>
                            @foreach($coupons as $coupon)
                                <tr class="{{$colors[$loop->index%count($colors)]}}">
                                    <td>{{$coupon->name}}</td>
                                    <td>{{$coupon->brand}}</td>
                                    <td>{{$coupon->start}}</td>
                                    <td>{{$coupon->end}}</td>
                                    <td>{{$coupon->customer_type}}</td>
                                    <td>{{$coupon->type}}</td>
                                    <td>操作</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#btn-search').click(function () {
            var sel1 = $('#brand').val();
            var sel2 = $('#customer-type').val();
            window.location.href = '/coupon/'+sel1+'/'+sel2;
        })
    </script>
@endsection