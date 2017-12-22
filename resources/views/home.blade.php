@extends('layouts.app')

@section('content')
    <div class="row">


        <div class="col-md-10">
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4><a href="/changelog">新着情報</a></h4>
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
                        <h4>試験選択</h4>
                    </div>
                    <div class="panel-body">
                        <ul>
                            @foreach($exam_list as $exam)
                                <li><a href="/exam/{{$exam->id}}">{{$exam->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-2">

            <a href="/record/FE"><img src="seseki.png" width="165px" height="auto"></a>

            <a href="ranking"><img src="rank.png" width="165px" height="auto"></a>
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