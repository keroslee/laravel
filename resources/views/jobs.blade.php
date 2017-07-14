@extends('layouts.atah')

@section('content')
<script type="text/javascript">

    window.onload=auto_boxs;
	function auto_boxs()
	{
        $('.scroller').css ('width',document.documentElement.clientWidth -76 +"px");
	}
	auto_boxs();
	onresize=auto_boxs;
</script>

</head>
<body>

@include('partial.nav', ['home'=>'', 'profile'=>'', 'works'=>'', 'media'=>'', 'events'=>'', 'jobs'=>'act'])

<div class="toF">
    <div class="imgsbox clearfix" style="background:#F90">
	  <img src="{{$job->path}}"/>
    </div>
</div>
@endsection