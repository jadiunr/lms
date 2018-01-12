@extends("layouts.app")
@section('css')
    <link rel="stylesheet" href="/css/learning.css">
@endsection

@section('content')

    <h3 style="margin-left: 200px">問{{$question->problem_number}}</h3>

    <div class="row">

        <div class="col-lg-8 col-lg-offset-2" style="margin-top: 30px;margin-bottom: 30px">
            {{$question->question}}
        </div>

        @if($question->pic_que != 'NULL')
            <div style="text-align: center;"><img src="{{$question->pic_que}}" ></div>
        @endif


    </div>
    <div class="row" style="margin-top: 30px">
        <div class="col-lg-6">
            <ul style="margin-left: 200px;font-size:20px;list-style: none;" class="select-list">
                <li><span class="size" style="margin-right: 10px ; font-size: 20px">ア.</span>{{$question->answer1}}</li>
                <li><span class="size" style="margin-right: 10px ; font-size: 20px">イ.</span>{{$question->answer2}}</li>
                <li><span class="size" style="margin-right: 10px ; font-size: 20px">ウ.</span>{{$question->answer3}}</li>
                <li><span class="size" style="margin-right: 10px ; font-size: 20px">エ.</span>{{$question->answer4}}</li>
            </ul>
        </div>
        <div class="col-lg-6">
            @if($question->pic_ans != 'NULL')<img src="{{$question->pic_ans}}" >@endif
        </div>
    </div>

    <a class="btn btn-default" href="/record/{{$exam_id}}/history/{{$time}}" role="button">戻る</a>
@endsection