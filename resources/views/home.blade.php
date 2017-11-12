@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h5 class="panel-title"><h2>チェンジログ</h2></h5>
                </div>
                <div class="panel-body">
                    <ul id="chengelog">
                        <li><a href="#"><h4>2017/10/31<br>
                                H29年秋基本情報技術者試験午前問題を追加しました。</h4></a></li>
                        <li><a href="#"><h4>2017/10/30<br>
                                    H29年春基本情報技術者試験午前問題を追加しました。</h4></a></li>
                        <li><a href="#"><h4>2017/10/29<br>
                                    H28年秋基本情報技術者試験午前問題を追加しました。</h4></a></li>
                        <li><a href="#"><h4>2017/10/28<br>
                                    H28年春基本情報技術者試験午前問題を追加しました。</h4></a></li>
                        <li><a href="#"><h4>2017/10/27<br>
                                    H27年秋基本情報技術者試験午前問題を追加しました。</h4></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h5 class="panel-title"><h2>試験選択</h2></h5>
                </div>
                <div class="panel-body">
                    <h3>国家試験</h3>
                    <ul>
                        <li><h4>ITパスポート</h4></li>
                        <li><h4>応用情報技術者試験</h4></li>
                        <li><a href="/FE/exam"><h4>基本情報技術者試験</h4></a></li>
                        <li><h4>情報セキュリティマネジメント</h4></li>
                    </ul>

                    <h3>民間試験</h3>
                    <ul>
                        <li><h4>C言語能力検定 3級</h4></li>
                        <li><h4>C言語能力検定 2級</h4></li>
                        <li><h4>MOS検定　Word</h4></li>
                        <li><h4>MOS検定　Excel</h4></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-2">

            <img src="seseki.png" width="165px" height="auto">

            <img src="rank.png" width="165px" height="auto">
                <ul class="list-group">
                    <li class="list-group-item">1位　学籍番号　0.00%</li>
                    <li class="list-group-item">2位　学籍番号　0.00%</li>
                    <li class="list-group-item">3位　学籍番号　0.00%</li>
                    <li class="list-group-item">4位　学籍番号　0.00%</li>
                    <li class="list-group-item">5位　学籍番号　0.00%</li>
                </ul>

            <a href="/bbs"><img src="qa.png" width="165px" height="auto"></a>
                <ul class="list-group">
                    <li class="list-group-item"><a href="#">新着質問</a></li>
                    <li class="list-group-item"><a href="#">新着質問</a></li>
                    <li class="list-group-item"><a href="#">新着質問</a></li>
                </ul>
        </div>
    </div>
@endsection
