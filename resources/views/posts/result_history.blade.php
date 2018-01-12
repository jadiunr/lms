@extends('layouts.app')

@section('content')

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>答案</th>
                <th>解答</th>
                <th>正誤</th>
                <th>問題内容</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0 ?>
            @foreach($problems as $problem)
            <tr @if($problem->correct == $answer_history[$i]->answer) style="background:#CEF6CE"
                @else style="background:#F6CECE"@endif>
                <td>{{$problem->problem_number}}</td>
                <td>{{$answer_history[$i]->answer}}</td>
                <td>{{$problem->correct}}</td>
                <td>{{$judgement($problem->correct,$answer_history[$i++]->answer)}}</td>
                <td><a href='/record/{{$exam_id}}/history/{{$time}}/{{$problem->id}}' style="text-decoration: none;color: gray">詳細</a></td>
            </tr>

            @endforeach

        </tbody>



    </table>



@endsection

@section('script')
    <script src="/js/learning.js" type="text/javascript"></script>
@endsection
