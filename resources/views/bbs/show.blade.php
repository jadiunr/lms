@extends('layouts.app')

@section('css')
    <link href="/css/bbs/show.css" rel="stylesheet">
@endsection

@section('content')
    <h4>{{ Html::link('/bbs', 'BBS') }}->{{ $first_comment->thread->title }}</h4><hr>
    <div class="media">
        <div class="media-body">
            <h4 class="media-heading" style="border-bottom: 1px solid #A9BCF5;border-left: 10px solid #A9BCF5;padding: 7px;">{{ $first_comment->name }}&emsp;<em>{{ $first_comment->updated_at }}</em></h4>
            <p>{!! nl2br(e($first_comment->comment)) !!}</p><hr>
        </div>
    </div>

    {!! Form::open(['action' => 'BbsController@store']) !!}
    {{-- スレッドIDをhiddenで用意 --}}
    {!! Form::hidden('thread_id', $thread_id) !!}

    @if ($errors->has('name'))
        <span style="color:red;">{{ $errors->first('name') }}</span>
    @endif
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    @if ($errors->has('comment'))
        <span style="color:red;">{{ $errors->first('comment') }}</span>
    @endif
    <div class="form-group">
        {!! Form::label('comment', 'Comment:') !!}
        {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
    <hr>

    @foreach($posts as $post)
        <div class="media">
            <div class="media-body">
                <h4 style="border-bottom: 1px solid #A9BCF5;border-left: 10px solid #A9BCF5;padding: 7px;">{{ $post->name }}&emsp;<em>{{ $post->updated_at }}</em></h4>
                <p>{!! nl2br(e($post->comment)) !!}</p>
                <br>
            </div>
        </div>
    @endforeach

    <hr>
@endsection