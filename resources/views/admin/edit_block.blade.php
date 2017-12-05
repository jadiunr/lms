@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            {!! Form::open(['route' => ['admin.updateExam', $block->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $block->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">問題一覧</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th class="center">問題番号</th>
                            <th class="center">問題文</th>
                            <th class="center">カテゴリ名</th>
                            <th class="center">作成日</th>
                            <th class="center">更新日</th>
                            <th class="center">編集</th>
                            <th class="center">削除</th>
                        </tr>
                        @foreach($problems as $problem)
                            <tr>
                                <td class="center">{{ $problem->problem_number }}</td>
                                <td class="center">{{ str_limit($problem->question, 30, $end = '...') }}</td>
                                <td class="center">{{ $problem->name }}</td>
                                <td class="center">{{ $problem->created_at }}</td>
                                <td class="center">{{ $problem->updated_at }}</td>
                                <td class="center"><a href="{{ route('admin.editProblem', ['exam_id' => $exam_id, 'block_id' => $block->id, 'problem_id' => $problem->id]) }}"><button type="button" class="btn btn-primary">編集</button></a></td>
                                <td class="center"><a href="#"><button type="button" class="btn btn-danger">削除</button></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <a href="{{ route('admin.getCreateProblem', ['exam_id' => $exam_id, 'block_id' => $block->id]) }}"><button type="button" class="btn btn-success">問題追加</button></a>
        </div>
    </div>
@endsection