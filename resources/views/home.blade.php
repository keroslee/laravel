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
                        <select id="customer-type" class="form-control">
                            <option value="">全部</option>
                            @foreach($types as $type)
                                <option value="{{$type}}" {{$sel==$type?'selected':''}}>{{$type}}</option>
                            @endforeach
                        </select>
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
                            <th>编号</th>
                            <th>类型</th>
                            <th>姓名</th>
                            <th>年龄</th>
                            <th>手机号</th>
                            <th>注册时间</th>
                            </tr>
                            <?php $colors=['active','success','info','warning','danger']?>
                            @foreach($customers as $customer)
                                <tr class="{{$colors[$loop->index%count($colors)]}}">
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$customer->type}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->age}}</td>
                                    <td>{{$customer->tel}}</td>
                                    <td>{{$customer->created_at}}</td>
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
        $('#customer-type').change(function () {
            var sel = $(this).val();
            console.log(sel);
            window.location.href = '/home/'+sel;
        })
    </script>
@endsection