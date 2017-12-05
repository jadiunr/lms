@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            {!! Form::open(['route' => ['admin.updateExam', $exam->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $exam->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">試験ブロック</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th class="center">ブロックID</th>
                            <th class="center">ブロック名</th>
                            <th class="center">作成日</th>
                            <th class="center">更新日</th>
                            <th class="center">問題数</th>
                            <th class="center">編集</th>
                            <th class="center">削除</th>
                        </tr>
                        @foreach($blocks as $block)
                            <tr>
                                <td class="center">{{ $block->id }}</td>
                                <td class="center">{{ $block->name }}</td>
                                <td class="center">{{ $block->created_at }}</td>
                                <td class="center">{{ $block->updated_at }}</td>
                                <td class="center">{{ $block->count }}</td>
                                <td class="center"><a href="{{ route('admin.editBlock', ['exam_id' => $block->exam_id, 'block_id' => $block->id]) }}"><button type="button" class="btn btn-primary">編集</button></a></td>
                                <td class="center"><a href="#"><button type="button" class="btn btn-danger">削除</button></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            {!! Form::open(['route' => ['admin.createBlock', $exam->id], 'method' => 'get']) !!}
                {!! Form::select('block_id', array_pluck($full_blocks, 'name', 'id')) !!}
                {!! Form::submit('ブロック追加', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection