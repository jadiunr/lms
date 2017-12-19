@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <h4>{{ $posts->first()->thread->title }}</h4><hr>
    <table class="table table-striped">
        <tr>
            <td>ユーザー名</td>
            <td>コメント</td>
            <td>投稿日</td>
            <td>削除</td>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->user->name }}</td>
                <td width="60%">{{ $post->comment }}</td>
                <td>{{ $post->updated_at }}</td>
                <td>
                    @if(!$loop->first)
                        {!! Form::open(['action' => 'BbsAdminController@delete_post']) !!}
                        {!! Form::hidden('post_id', $post->id) !!}
                        {!! Form::submit('削除', ['class' => 'center-block btn btn-danger btn-sm', 'onclick' => 'return confirm("削除ボタンがクリックされました。本当によろしいですか？\nOKを押すと実行されます")']) !!}
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection