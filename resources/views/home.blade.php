@extends('layouts.app')

@section('content')
    <div class="row">
            <div class="col-md-5">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">新着情報</h3>
                    </div>
                    <div class="panel-body">
                        <ul id="chengelog" style="list-style:none;">
                            <li><a href="#"><h5>2017/10/31<br>
                                    H29年秋基本情報技術者試験午前問題を追加しました。</h5></a></li>
                            <li><a href="#"><h5>2017/10/30<br>
                                        H29年春基本情報技術者試験午前問題を追加しました。</h5></a></li>
                            <li><a href="#"><h5>2017/10/29<br>
                                        H28年秋基本情報技術者試験午前問題を追加しました。</h5></a></li>
                            <li><a href="#"><h5>2017/10/28<br>
                                        H28年春基本情報技術者試験午前問題を追加しました。</h5></a></li>
                            <li><a href="#"><h5>2017/10/27<br>
                                        H27年秋基本情報技術者試験午前問題を追加しました。</h5></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">試験選択</h3>
                    </div>
                    <div class="panel-body">
                        <ul style="list-style:none;">
                            <li><h5>ITパスポート</h5></li>
                            <li><h5>応用情報技術者試験</h5></li>
                            <li><a href="/FE/exam"><h5>基本情報技術者試験</h5></a></li>
                            <li><h5>情報セキュリティマネジメント</h5></li>
                        </ul>
                    </div>
                </div>

                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">質問一覧</h3>
                    </div>
                    <div class="panel-body">
                        <ul style="list-style:none;">
                            <li><a href="#"><h5>新着質問</h5></a></li>
                            <li><a href="#"><h5>新着質問</h5></a></li>
                            <li><a href="#"><h5>新着質問</h5></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        <div class="col-md-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">ランキング</h3>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">1位　学籍番号　0.00%</li>
                    <li class="list-group-item">2位　学籍番号　0.00%</li>
                    <li class="list-group-item">3位　学籍番号　0.00%</li>
                    <li class="list-group-item">4位　学籍番号　0.00%</li>
                    <li class="list-group-item">5位　学籍番号　0.00%</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
