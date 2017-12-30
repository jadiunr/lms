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
                    <div class="col-md-6">{{ $records->appends(Request::only('key_w'))->links() }}</div>
                    <div class="col-md-6">
                        {!! Form::open(['method' => 'get', 'route' => 'admin.searchRecord']) !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="key_w">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">検索</button>
                            </span>
                        </div>
                        <div class="input-group">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                    絞り込み
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 1</a></li>
                                    <li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 2</a></li>
                                    <li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 3</a></li>
                                    <li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 4</a></li>
                                    <li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 5</a></li>
                                    <li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 6</a></li>
                                </ul>
                            </div>
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
                                <td>{{ $record->rate}}%</td>
                                <td>
                                    @if($record->rate >= 60)
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
