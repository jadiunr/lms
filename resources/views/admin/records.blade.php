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
                    <h3 class="panel-title">成績一覧</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">{{ $records->links() }}</div>
                    <div class="col-md-6">
                        {!! Form::open(['method' => 'get', 'route' => 'admin.searchRecord']) !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="key_w">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">検索</button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <th>成績ID</th>
                            <th>試験名</th>
                            <th>ブロック名</th>
                            <th>受験者名</th>
                            <th>受験者本名</th>
                            <th>正答率</th>
                            <th>合否</th>
                            <th>受験日</th>
                            <th>削除</th>
                        </tr>
                        @foreach($records as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->exam->name }}</td>
                                <td>{{ $record->block->name }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>{{ $record->user->realname }}</td>
                                <td>{{ ($record->total / $record->answers->count()) * 100 }}%</td>
                                <td>
                                    @if(($record->total / $record->answers->count()) >= 0.6)
                                        <span style="color:red;font-weight:bold">合格</span>
                                    @else
                                        <span style="color:blue">不合格</span>
                                    @endif
                                </td>
                                <td>{{ $record->created_at }}</td>
                                <td>
                                    {!! Form::open(['route' => ['admin.deleteRecord']]) !!}
                                    {!! Form::hidden('record_id', $record->id) !!}
                                    {!! Form::submit('削除', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("本当によろしいですか？")']) !!}
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
