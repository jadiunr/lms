@extends('layouts.app')

@section('content')
    <div class="row">
        {!! Form::open(['method' => 'get', 'action' => 'BbsController@search']) !!}
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::select('solved', [false => '未解決', true => '解決済み']) !!}&nbsp;
                {!! Form::select('category', [1 => 'その他', 2 => 'テクノロジー', 3 => 'マネジメント', 4 => 'ストラテジー']) !!}<br>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text" class="form-control" name="key_w" value="{{ $key_w }}">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">検索</button>
                </span>
            </div>
        </div>
        {!! Form::close() !!}<br>
    </div>

    @if(isset($threads[0]))
        @foreach($threads as $thread)
            {{ Html::link('/bbs/show?id='.$thread->id, $thread->title) }}<br>
        @endforeach
    @else
        検索結果:0
    @endif
@endsection