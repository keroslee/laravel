<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{trans('error.418_title')}}</title>
    <style>html, body {
            height: 100%;
            background-color: #c14027
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle
        }

        .content {
            text-align: center;
            display: inline-block
        }

        .title {
            font-size: 64px;
            margin-bottom: 40px
        }

        .links > a {
            color: #ffffff;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase
        }</style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">无法识别的本地化语言<br>Unrecognized localized language</div>
        <div class="m-b-md">请在下面选择一种语言<br>Please select a language below</div>
        <div class="links"><a href="{{url('/setLang','cn')}}">简体中文</a><a href="{{url('/setLang','en')}}">English</a></div>
    </div>
</div>
</body>
</html>