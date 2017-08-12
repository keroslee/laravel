@extends('layout',$userData)

@section('sidebar')
    @include('sidebar',$userData)
@endsection

@section('content')
    <div class="box">
        @include('breadcrumb')
        @include('company_status',$status)
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            setInterval(getStatus,10000)
        });

        function getStatus() {
            $.post('/getStatus', {_token: '{{csrf_token()}}'}).done(function (ret) {
                console.log(ret);
                if (ret) {
                    $('#total').text('企业总数：' + ret['total']);
                    $('#running').text('正在运行的企业数：' + ret['running']);
                    $('#good').text('正常企业数：' + ret['good']);
                    $('#bad').text('异常企业数：' + ret['bad']);
                }
            }).fail(function (ret) {
                console.log(ret);
            });
        }
    </script>
@endsection