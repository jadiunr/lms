@extends('layouts.app')

@section('css')
    <link href="/css/bbs/index.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-2"><h4>BBS</h4></div>
        <div class="col-sm-3 col-sm-offset-7">
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">検索</button>
                </span>
            </div>
        </div>
    </div>
    <hr>
    <div align="center">{{ $threads->links() }}</div>
    <table class="table table-bordered">
        <tr>
            <th>タイトル</th>
            <th>回答数</th>
            <th>質問の状態</th>
            <th>カテゴリ</th>
        </tr>
        @foreach($threads as $thread)
            <tr>
                <td width="70%">{{ Html::link('/bbs/show?id='.$thread->id, $thread->title) }}</td>
                <td>{{ $thread->posts()->count()-1 }}</td>
                <td>未解決</td>
                <td>マネジメント</td>
            </tr>
        @endforeach
    </table>
    {{ Html::link('/bbs/create', 'create', ['class' => 'btn btn-info', 'role' => 'button']) }}
@endsection