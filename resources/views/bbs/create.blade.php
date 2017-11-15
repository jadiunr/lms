@extends('layouts.app')

@section('css')
    <link href="/css/bbs/create.css" rel="stylesheet">
@endsection

@section('content')
    <h4>{{ Html::link('/bbs', '戻る') }}</h4><hr>
    {!! Form::open() !!}
    <div class="form-group">
        {!! Form::label('category', 'カテゴリー:') !!}
        {!! Form::select('category', ['マネジメント' => 'マネジメント', '数学' => '数学', 'その他' => 'その他']) !!}
    </div>

    @if ($errors->has('title'))
        <span style="color:red;">{{ $errors->first('title') }}</span>
    @endif
    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    @if ($errors->has('comment'))
        <span style="color:red;">{{ $errors->first('comment') }}</span>
    @endif
    <div class="form-group">
        {!! Form::label('comment', 'Comment:') !!}
        {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('質問する！', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@endsection
