<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" >
    <title>@yield('title')</title>
</head>
<body class="bg-light">
<div class="container p-3">
    <div>
        <img src="{{asset('images/VeriTrans_Payment.png')}}" alt="VeriTrans">
    </div>
    <hr>

    @yield('content')
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-sm-4"><img src="{{asset("images/VeriTransLogo_WH.png")}}" alt="VeriTrans"></div>
            <div class="col-12 col-sm-8">Copyright © VeriTrans Inc. All rights reserved</div>
        </div>
    </footer>

</div>
<script src=" {{ mix('js/app.js') }} "></script>
<script src=" {{ mix('js/sample.js') }} "></script>
</body>
</html>
