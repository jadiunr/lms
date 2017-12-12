@extends('layouts.app')

@section('content')
    <h1>個人成績画面</h1> <br>
    <div class="container" style="width:1500px">
        <div class="row row-eq-height">
            <div class="col-md-4"style="height:400px; width:400px;margin-right: 25px">
                <h1>年度別</h1>
                <div style="height:400px; width:400px; overflow-y:scroll;">
                    <table border=1 height="400" width="400">
                        {{--forでやる--}}
                        <tr>
                            <th style="width: 280px;height:40px">試験名</th>
                            <th style="height:40px">正答率</th>
                        </tr>

                        @foreach($records as $record)
                            <tr>
                                <td>平成{{substr($record->year,1,2)}}年</td>
                                <td>{{$record->total/80*100}}%</td>
                            </tr>
                        @endforeach


                    </table>
                </div>
            </div>
            <div class="col-md-4"style="height:400px; width:400px;margin-right: 25px">
                <h1>分野別正答率</h1>
                <div style="height:400px; width:400px; overflow-y:scroll;">
                    <table border=1 height="400" width="400">
                        <tr>
                            <th style="width: 280px;height:40px">分野</th>
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
            </div>
            <h1>  試験別正答率</h1>
            <div class="col-md-4"style="height:400px; width:400px;margin-right: 25px">
                <div style="height:400px; width:400px; overflow-y:scroll;">
                    <table border=1 height="400" width="400">
                        <tr>
                            <th style="width: 280px">試験名</th>
                            <th style="height:40px">正答率</th>
                        </tr>
                        @foreach($records as $record)
                            <tr>

                                <td>{{$record->exam_id}}平成{{substr($record->year,1,2)}}年</td>
                                <td>{{$record->total/80*100}}%</td>
                            </tr>
                        @endforeach

                    </table>
                </div>

            </div>
        </div>
    </div>






@endsection
