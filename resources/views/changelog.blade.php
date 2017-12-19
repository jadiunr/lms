@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <h4>新着情報</h4><hr/>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>作成日</th>
                    <th>内容</th>
                </tr>
                @foreach($changelog as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td>{{ $log->content }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection