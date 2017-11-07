@extends('layouts.app')

@section('css')
    <link href="/css/bbs/index.css" rel="stylesheet">
@endsection

@section('content')
    <h4>BBS</h4><hr>
    <div align="center">{{ $threads->links() }}</div>
    <table class="table table-bordered">
        <tr>
            <th>Thread Title</th>
        </tr>
        @foreach($threads as $thread)
            <tr>
                <td>{{ Html::link('/bbs/show?id='.$thread->id, $thread->title) }}</td>
            </tr>
        @endforeach
    </table>
    {{ Html::link('/bbs/create', 'create', ['class' => 'btn btn-info', 'role' => 'button']) }}
@endsection