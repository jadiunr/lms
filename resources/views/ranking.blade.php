@extends('layouts.app')
@section('content')
    <form name="form" style="float: right" action="/ranking" method="get">
        <p><select name="select">
                <option>試験選択</option>
                @foreach($exams as $exam)
                    <option value="{{$exam->id}}">{{$exam->name}}</option>
                @endforeach
            </select></p>
        <p><input class="btn btn-default" type="submit" value="試験選択"></p>
    </form>
    <table class="table" style="margin-top: 50px">
        <caption style="font-size: 20px">@if($null==NULL){{$exam_name[0]->name}}　正答率@else総合正答数@endifランキング</caption>
        <thead>
        <tr>
            <th>順位</th>
            <th>名前</th>
            <th>@if($null==NULL)正答率@else正答数@endif</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1 ?>
        @foreach($users as $user)
            <tr style="@if($i==1 or $i==2 or $i==3) height:60px ;font-size:20px ;font-weight: bold ;@endif">
                <td><img @if($i ==1) src ="gold.png" @elseif($i==2)src="silver.png"@elseif($i==3)src="bronze.png"@endif style="width: 28px;height: auto;margin-right: 10px">{{$i++}}</td>
                <td>{{$names($user->user_id)->name}}</td>
                <td>@if($null==NULL){{substr($user->rate,0,4)}}%@else{{$user->total}}@endif</td>
            </tr>

        @endforeach
        </tbody>
    </table>
@endsection
@section('script')

    <script src="/js/learning.js" type="text/javascript"></script>
@endsection