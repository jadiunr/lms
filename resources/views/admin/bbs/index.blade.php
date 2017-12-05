@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <h4>掲示板管理</h4><hr>
    <table class="table table-striped">
        <tr>
            <td>タイトル</td>
            <td>コメント数</td>
            <td>質問の状態</td>
            <td>カテゴリ</td>
            <td>削除</td>
        </tr>
        @foreach($threads as $thread)
            <tr>
                <td width="70%">{{ Html::link('/admin/bbs/show?id='.$thread->id, $thread->title) }}</td>
                <td>{{ $thread->posts()->count()-1 }}</td>
                <td>
                    @if($thread->solved)
                        解決済み
                    @else
                        未解決
                    @endif
                </td>
                <td>{{ $thread->category->name }}</td>
                <td>
                    {!! Form::open(['action' => 'BbsAdminController@delete_thread']) !!}
                    {!! Form::hidden('thread_id', $thread->id) !!}
                    {!! Form::submit('削除', ['class' => 'center-block btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
@endsection