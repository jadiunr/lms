@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            @if(Session::has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">掲示板一覧</h3>
                </div>
                <div class="panel-body">
                    <div align="center">{{ $threads->links() }}</div>
                    {!! Form::open(['action' => 'BbsAdminController@set_mail_flag']) !!}
                        <div align="right">
                            <span style="position:relative;bottom:8px">スレッドが作成された時に管理者宛にメールを送信する</span>
                            <label class="label-switch switch-primary">
                                {!! Form::checkbox('mail_flag', 1, $current_mail_flag, ['class' => 'switch-square switch-bootstrap status']) !!}
                                <span class="lable"></span>
                            </label>
                            <input type="submit" value="設定" class="btn btn-default btn-sm" style="position:relative;bottom:8px">
                        </div>
                    {!! Form::close() !!}
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
                                    {!! Form::submit('削除', ['class' => 'center-block btn btn-danger btn-sm ', 'onclick' => 'return confirm("削除ボタンがクリックされました。本当によろしいですか？\nOKを押すと実行されます")'])!!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection