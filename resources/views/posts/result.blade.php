@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-lg-6">
            <h1>個人成績画面</h1>
        </div>
        <div class="col-lg-3 col-lg-offset-3" style="margin-top: 20px;">

            <form name="sort_form" method="get" >
                <select  name="sort" class="form-control col-lg-6" onchange="dropsort()" >
                    <option value="" >試験一覧</option>
                    <option value="FE">基本情報技術者試験</option>
                    <option value="AP">応用情報技術者試験</option>
                    <option value="SE">情報セキュリティマネジメント</option>
                    <option value="IT">ITパスポート</option>
                </select>
            </form>
        </div>
    </div>

    <br>


        <div class="row">
            @if(isset($null))
                {{$null}}
            @else
            <div class="col-lg-4"style="height:400px;">
                <h1>分野別正答率</h1>
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
                                <th style="width: 280px;height:40px">試験名</th>
                                <th style="height:40px">正答率</th>
                                <th>合否</th>
                                <th>受験日</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>平成{{substr($record->year,1,2)}}年</td>
                                <td>{{$record->total/80*100}}%</td>
                                <td>@if($record->total >=60)<span style="color:greenyellow">合格</span>
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
