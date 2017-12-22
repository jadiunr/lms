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
                    <h3 class="panel-title">ユーザ一覧</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">{{ $records->links() }}</div>
                    {{--<div class="col-md-6">--}}
                        {{--{!! Form::open(['method' => 'get', 'route' => 'admin.searchUser']) !!}--}}
                        {{--<div class="input-group">--}}
                            {{--<input type="text" class="form-control" name="key_w">--}}
                            {{--<span class="input-group-btn">--}}
                                {{--<button class="btn btn-default" type="submit">検索</button>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                        {{--{!! Form::close() !!}--}}
                    {{--</div>--}}
                    <table class="table table-striped">
                        <tr>
                            <th>成績ID</th>
                            <th>試験名</th>
                            <th>ブロック名</th>
                            <th>利用者名</th>
                            <th>本名</th>
                            <th>正答率</th>
                            <th>合否</th>
                            <th>受験日</th>
                            <th>削除</th>
                        </tr>
                        @foreach($records as $record)
                            <tr>
                                <td>{{ $record->record_id }}</td>
                                <td>{{ $record->exam_name }}</td>
                                <td>{{ $record->block_name }}</td>
                                <td>{{ $record->user_name }}</td>
                                <td>{{ $record->user_realname }}</td>
                                <td>{{ $record->rate }}</td>
                                <td>
                                    @if($record->rate >= 0.6)
                                        <span style="color:red;font-weight:bold">合格</span>
                                    @else
                                        <span style="color:blue">不合格</span>
                                    @endif
                                </td>
                                <td>{{ $record->exam_date }}</td>
                                <td>
                                    {!! Form::open(['route' => ['admin.deleteRecord']]) !!}
                                    {!! Form::hidden('record_id', $record->record_id) !!}
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
