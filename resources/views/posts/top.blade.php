@extends('layouts.app')

@section('style')

.b-t-n1 {
display: inline-block;
padding: 100px 110px;
text-decoration: none;
color: #67c5ff;
border: solid 2px #67c5ff;
border-radius: 3px;
transition: .4s;
}

.b-t-n1:hover {
background: #67c5ff;
color: white;
}

.b-t-n2{
font-size: 20px;
}

@endsection


@section('content')




　　　<div class="button" style="clear:both;margin-top: 150px;margin-left: 130px;">

        <div style="float:left;">
            <a href="/exam/{{$exam_id}}/{{$block_id}}/learning/1" class="b-t-n1"><span class="b-t-n2">ラーニングモード</span></a>

        </div>
        <div style="float:left;">
            <a href="/exam/{{$exam_id}}/{{$block_id}}/test/1" class="b-t-n1" style=" margin-left: 100px"><span class="b-t-n2">　テストモード　</span></a>

            <!--　テストモードの両端の全角空白はaタグボタンの横サイズを調整するために入れています。　-->

        </div>

    </div>









@endsection