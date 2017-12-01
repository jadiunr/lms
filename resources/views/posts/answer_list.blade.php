@extends('layouts.app')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>解答</th>
                <th>答案</th>
                <th>正誤</th>
            </tr>
        </thead>
        <?php $i=0?>




        @foreach($correct as $item)
        <tr @if($judgment($session_item[$i],$item->correct)=="○") style="background:#CEF6CE"
        @else style="background:#F6CECE"@endif>
            <td>{{$item->problem_number}}</td>
            <td>{{$session_item[$i]}}</td>
            <td>{{$item->correct}}</td>
            <td style="font-size: 20px;padding:0;">{{$judgment($session_item[$i],$item->correct)}}</td>
        </tr>
        <?php $i++?>
        @endforeach
    </table>

    <a href="/exam/{{$exam_id}}"><button>試験一覧</button></a>
@endsection