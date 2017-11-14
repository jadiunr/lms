@extends('layouts.app')

@section('css')
    <link href="/css/bbs/show.css" rel="stylesheet">
@endsection

@section('content')
    <h4>{{ Html::link('/bbs', 'BBS') }}->{{ $first_comment->thread->title }}</h4><hr>
    <div class="media">
        <a class="media-left" href="#">
            @if($first_comment->user->icon)
                <img src="{{ asset('storage/img/' . $first_comment->user->icon) }}" alt="icon" width="90" height="90" />
            @else
                <img src="/default_icon/animal_serval.png" alt="icon" width="90" height="90">
            @endif
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{ $first_comment->user->name }}&emsp;<em>{{ $first_comment->updated_at }}</em></h4>
            <p>{!! nl2br(e($first_comment->comment)) !!}</p><br>
        </div>
    </div>
    <hr>

    {!! Form::open(['action' => 'BbsController@store']) !!}
    {{-- スレッドIDをhiddenで用意 --}}
    {!! Form::hidden('thread_id', $thread_id) !!}

    @if ($errors->has('comment'))
        <span style="color:red;">{{ $errors->first('comment') }}</span>
    @endif
    <div class="form-group">
        {!! Form::label('comment', 'Comment:') !!}
        {!! Form::textarea('comment', null, ['class' => 'form-control', 'cols' => 50, 'rows' => 8]) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('回答する！', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
    <hr>

    @foreach($posts as $post)
        <div class="media">
            <a class="media-left" href="#">
                @if($post->user->icon)
                    <img src="{{ asset('storage/img/' . $post->user->icon) }}" alt="icon" width="90" height="90" />
                @else
                    <img src="/default_icon/animal_serval.png" alt="icon" width="90" height="90">
                @endif
            </a>
            <div class="media-body">
                <h4>{{ $post->user->name }}&emsp;<em>{{ $post->updated_at }}</em></h4>
                <p>{!! nl2br(e($post->comment)) !!}</p>
                <br>
            </div>
        </div>
        <hr>
    @endforeach
@endsection