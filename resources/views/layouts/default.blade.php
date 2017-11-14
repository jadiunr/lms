<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ラーニングモード</title>
    <script src="https://use.fontawesome.com/f55b79482e.js"></script>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/exam/animate.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/exam/bootsnav.css">


    @yield('link')
    <style>
    @yield('style')
    </style>

</head>
<body>
<nav class="navbar navbar-default bootsnav">
    <div class="container">
        @yield('navbar-1')

        <div class="navbar-header">
            <a class="navbar-brand" href="#brand" style="font-size: 60px;margin-top: 12px" >OIC</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-menu">

            <ul class="nav navbar-nav navbar-right">

                <li><a href="#">個人成績</a></li>
                <li><a href="#">ランキング</a></li>
                <li><a href="#">質問一覧</a></li>
            </ul>
        </div>
    </div>

@yield('side')
</nav>

@yield('contents')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="/js/app.js"></script>
<script src="/js/bootsnav.js"></script>
<script src="/js/learning.js" type="text/javascript"></script>


</body>
</html>