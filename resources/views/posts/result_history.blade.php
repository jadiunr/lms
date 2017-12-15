@extends('layouts.app')

@section('content')

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>答案</th>
                <th>解答</th>
                <th>正誤</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0 ?>
            @foreach($problems as $problem)
            <tr>
                <td>{{$problem->problem_number}}</td>
                <td>{{$answer_history[$i]->answer}}</td>
                <td>{{$problem->correct}}</td>
                <td>{{$judgement($problem->correct,$answer_history[$i++]->answer)}}</td>
            </tr>
            @endforeach

        </tbody>


    </table>


@endsection