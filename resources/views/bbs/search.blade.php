@extends('layouts.app')

@section('content')
    <div class="row">
        {!! Form::open(['method' => 'get', 'action' => 'BbsController@search']) !!}
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::select('solved', ['all' => 'ALL' ,false => '未解決', true => '解決済み']) !!}&nbsp;
                {!! Form::select('category_id', ['all' => 'ALL', 1 => 'テクノロジー', 2 => 'マネジメント', 3 => 'ストラテジー', 4 => 'その他']) !!}<br>
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
        <br>
        <h4>検索結果</h4><hr>
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
    @else
        <h4>検索結果:0</h4>
    @endif
@endsection