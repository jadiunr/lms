@extends('layouts.app')

@section('style')

.submit {
display: inline-block;
padding: 100px 110px;
color: #67c5ff;
}
.b-t-n2{
font-size: 20px;
}

@endsection


@section('content')
<form id="form" name="form"  action="#" method="post">
　　　<div class="button" style="clear:both;margin-top: 150px;margin-left: 130px;">
        <div style="float:left;">
            <button class="submit" value="A" onclick="actionA()";>
                <span class="b-t-n2">ラーニングモード</span>
            </button>
        </div>
        <div style="float:left; margin-left: 60px" >
            <button class="submit" value="B" onclick="actionB()";>
                <span class="b-t-n2">　テストモード　</span>
            </button>
            　<!--テストモードの両端の全角空白はaタグボタンの横サイズを調整するために入れています。-->
        </div>
    </div>
</form>




@endsection


@section('script')
    <script src="/js/learning.js" type="text/javascript"></script>
    <script>function actionA(){
            document.getElementById('form').action = '/exam/{{$exam_id}}/{{$block_id}}/learning/start';
        }
        function actionB(){
            document.getElementById('form').action = '/exam/{{$exam_id}}/{{$block_id}}/test/start';
        }</script>
@endsection