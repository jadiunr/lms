@extends('layouts.app')

@section('css')
    <link href="/css/bbs/index.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-2"><h4>質問掲示板</h4></div>
        <div class="col-sm-3 col-sm-offset-7">
            {!! Form::open(['method' => 'get', 'action' => 'BbsController@search']) !!}
            <div class="input-group">
                <input type="text" class="form-control" name="key_w">
                {!! Form::hidden('solved', 'all') !!}
                {!! Form::hidden('category_id', 'all') !!}
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">検索</button>
                </span>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <hr>
    <div align="center">{{ $threads->links() }}</div>
    <table class="table table-bordered">
        <tr>
            <th>タイトル</th>
            <th>コメント数</th>
            <th>質問の状態</th>
            <th>カテゴリ</th>
        </tr>
        @foreach($threads as $thread)
            <tr>
                <td width="70%">{{ Html::link('/bbs/show?id='.$thread->id, $thread->title) }}</td>
                <td>{{ $thread->posts()->count()-1 }}</td>
                <td>
                    @if($thread->solved)
                        解決済み
                    @else
                        未解決
                    @endif
                </td>
                <td>
                    {{ $thread->category->name }}
                </td>
            </tr>
        @endforeach
    </table>
    {{ Html::link('/bbs/create', 'create', ['class' => 'btn btn-info', 'role' => 'button']) }}
@endsection