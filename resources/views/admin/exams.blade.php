@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">試験一覧</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th class="center">試験ID</th>
                            <th class="center">試験名</th>
                            <th class="center">作成日</th>
                            <th class="center">更新日</th>
                            <th class="center">編集</th>
                            <th class="center">削除</th>
                        </tr>
                        @foreach($exams as $exam)
                            <tr>
                                <td class="center">{{ $exam->id }}</td>
                                <td class="center">{{ $exam->name }}</td>
                                <td class="center">{{ $exam->created_at }}</td>
                                <td class="center">{{ $exam->updated_at }}</td>
                                <td class="center"><a href="{{ route('admin.editExam', ['exam_id' => $exam->id]) }}"><button type="button" class="btn btn-primary">編集</button></a></td>
                                <td class="center">
                                    {!! Form::open(['route' => ['admin.deleteExam']]) !!}
                                    {!! Form::hidden('exam_id', $exam->id) !!}
                                    {!! Form::submit('削除', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("本当によろしいですか？")']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <a href="{{ route('admin.getCreateExam') }}"><button type="button" class="btn btn-success">新規試験追加</button></a>
            <a href="{{ route('admin.getBlocksGlobal') }}"><button type="button" class="btn btn-default"> ブロック編集 </button></a>
            <a href="{{ route('admin.getLfm') }}"><button type="button" class="btn btn-primary"> 試験用画像管理 </button></a>
        </div>
    </div>
@endsection