@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <p>正答数　{{$correct_count}}/80</p>
            <p>正答率　{{$result}}%</p>
            <a href="/"><button>試験終了</button></a>
        </div>
    <div class="col-lg-6">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>解答</th>
                    <th>答案</th>
                    <th>正誤</th>
                </tr>
            </thead>
                <?php $i=0 ?>
                @foreach($problem_id as $item)
                    <tr>
                        <td>{{$item->problem_number}}</td>
                        <td>{{$session_item[$i]}}</td>
                        <td>{{$item->correct}}</td>
                        <td style="font-size: 20px;padding:0;">{{$judgment($session_item[$i],$item->correct)}}</td>
                    </tr>
                <?php $i++?>
                @endforeach
        </table>
    </div>
    </div>
@endsection