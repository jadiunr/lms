@extends('layouts.app')

@section('content')
    <div class="row">


        <div class="col-md-10">
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a href="/changelog">新着情報</a></h3>
                    </div>
                    <div class="panel-body">
                        <ul id="chengelog">
                            @foreach($changelog as $log)
                                <li><h4>{{$log->created_at}}</h4></li>
                                <h4>{{$log->content}}</h4>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-heading" style="text-align: right">
                        <a href="/changelog">続きはこちら</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">試験選択</h3>
                    </div>
                    <div class="panel-body">
                        <h3>国家試験</h3>
                        <ul>
                            <li><h4>ITパスポート</h4></li>
                            <li><h4>応用情報技術者試験</h4></li>
                            <li><a href="/exam/FE"><h4>基本情報技術者試験</h4></a></li>
                            <li><h4>情報セキュリティマネジメント</h4></li>
                        </ul>
                    </div>
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
            </ul>

            <a href="/bbs"><img src="qa.png" width="165px" height="auto"></a>
            <ul class="list-group">
                @foreach($threads as $thread)
                    <li class="list-group-item">{{ Html::link('/bbs/show?id='.$thread->id, $thread->title) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection