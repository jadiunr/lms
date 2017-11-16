@extends('layouts.app')

@section('css')
    <link href="/css/bbs/show.css" rel="stylesheet">
@endsection

@section('content')
    <h4>{{ Html::link('/bbs', '質問掲示板') }}->{{ $first_comment->thread->title }}</h4><hr>
    <div class="media">
        <a class="media-left" href="#">
            @if($first_comment->user->icon)
                <img src="{{ asset('storage/img/' . $first_comment->user->icon) }}" alt="icon" width="90" height="90" />
            @else
                <img src="/default_icon/animal_serval.png" alt="icon" width="90" height="90">
            @endif
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{ $first_comment->user->name }}</h4>
            <p>{!! nl2br(e($first_comment->comment)) !!}</p><br>
            <em>{{ $first_comment->updated_at }}</em>&nbsp;&nbsp;
            <span class="label label-warning">{{ $first_comment->thread->category->name }}</span>
        </div>
    </div>
    <hr>

    @if($first_comment->thread->solved)
        <p class="text-center">
            この質問は解決済みです<br>
            質問者が {{ $first_comment->thread->updated_at }} にこの質問を解決済みにしました。
        </p>
        @if($first_comment->user_id == $user_id)
            {!! Form::open(['action' => 'BbsController@reopen']) !!}
            {!! Form::hidden('thread_id', $thread_id) !!}
            {!! Form::submit('この質問を未解決に戻す', ['class' => 'center-block btn btn-info']) !!}
            {!! Form::close() !!}
        @endif
    @elseif($first_comment->user_id == $user_id)
        <p class="text-center">
            解決済みにした後でも未解決状態に戻すことができます。
        </p>
        {!! Form::open(['action' => 'BbsController@solved']) !!}
        {!! Form::hidden('thread_id', $thread_id) !!}
        {!! Form::submit('この質問を解決済みにする！', ['class' => 'center-block btn btn-success']) !!}
        {!! Form::close() !!}
    @else
        <p class="text-center">質問の回答を受け付けています</p>
    @endif

    <hr>

    @if(!$first_comment->thread->solved)
        {!! Form::open(['action' => 'BbsController@store']) !!}
        {{-- スレッドIDをhiddenで用意 --}}
        {!! Form::hidden('thread_id', $thread_id) !!}

        @if ($errors->has('comment'))
            <span style="color:red;">{{ $errors->first('comment') }}</span>
        @endif
        <div class="form-group">
            {!! Form::label('comment', 'Comment:') !!}
            {!! Form::textarea('comment', null, ['class' => 'form-control', 'cols' => 50, 'rows' => 6]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('コメントする！', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
        <hr>
    @endif

    @if($posts)
        <p class="text-center">コメント一覧</p>
        <hr>
    @else
        <p class="text-center">コメントがありません</p>
        <hr>
    @endif

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
                <h4>{{ $post->user->name }}</h4>
                <p>{!! nl2br(e($post->comment)) !!}</p><br>
                <em>{{ $post->updated_at }}</em>
            </div>
        </div>
        <hr>
    @endforeach
@endsection