@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/result.css">
@endsection

@section('content')
    <div class="row ">
        <div class="col-lg-6">
            <h1>個人成績画面({{$current_exam_name}})</h1>
        </div>
        <div class="col-lg-3 col-lg-offset-3" style="margin-top: 20px;">

            <form name="sort_form" method="get" >
                <select  name="sort" class="form-control col-lg-6" onchange="dropsort()" >
                    <option value="">試験一覧</option>
                    @foreach($exam_list as $exam)
                        <option value="{{$exam->id}}">{{$exam->name}}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <br>
        <div class="row">
            @if(isset($null))
                {{$null}}
            @else
            <div class="col-lg-4" style="height:400px;" >

                <form action="/record/{{$exam_id}}" method="GET">

                    <h1 class="inline" style="margin-right: 40px">分野別正答率</h1>

                    <input class="btn btn-default inline" type="submit" value="期間指定" style="margin-bottom: 5px">
                    <div class="result_period" style="margin: 20px 0">
                        <input type="date" name="start_period" value="{{old('start_period')}}">　〜　<input type="date" name="end_period" max="{{$max_date}}" value="{{old('end_period')}}">
                        @if($period_error == true)
                            <p style="color: red">※指定した期間を見直してください</p>
                        @endif
                    </div>

                </form>

                <table border=1 height="400" width="330">
                    <tr>
                        <th style="width: 250px;height:40px">分野</th>
                        <th style="height:40px">正答率</th>
                    </tr>
                    <tr>
                        <td>テクノロジー</td>
                        <td>{{substr($answer_rate[0],0,4)}}%</td>
                    </tr>
                    <tr>
                        <td>マネジメント</td>
                        <td>{{substr($answer_rate[1],0,4)}}%</td>
                    </tr>
                    <tr>
                        <td>ストラテジー</td>
                        <td>{{substr($answer_rate[2],0,4)}}%</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-8">
                <h1>学習履歴</h1>
                <div style="height:400px;overflow-y:scroll;">
                    <table class="table table-hover"  width="600">
                        {{--forでやる--}}
                        <thead>
                            <tr style="border-color: black">
                                <th style="width: 280px;height:40px">ブロック名</th>
                                <th style="height:40px">正答率</th>
                                <th>合否</th>
                                <th>受験日</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{$record->block->name}}</td>
                                <td>{{$record->rate}}%</td>
                                <td>@if($record->rate >= 60)<span style="color:greenyellow">合格</span>
                                    @else<span style="color:red">不合格</span>@endif
                                </td>
                                <td>{{$record->created_at}}</td>
                                <td><a href="/record/{{$record->exam_id}}/history/{{$record->created_at}}" style="text-decoration: none; color:black;">解答履歴</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
@endsection
@section('script')
    <script src="/js/learning.js" type="text/javascript"></script>
@endsection
