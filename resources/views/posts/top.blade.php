@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/exam-top.css">

@endsection

@section('content')
<div class="row">
    <form id="form" name="form"  action="#" method="post">
        {{csrf_field()}}
            <div class="button">
                <div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 ">
                    <a href="javascript:form.submit()" class="b-t-n1" onclick="actionA()"; ><span class="b-t-n2">ラーニングモード</span></a>
                </div>
                <div class="col-lg-5 col-md-5">
                    <a href="javascript:form.submit()" id="b-t-n1-2" class="b-t-n1" onclick="actionB()";><span class="b-t-n2">　テストモード　</span></a>
                    　<!--テストモードの両端の全角空白はaタグボタンの横サイズを調整するために入れています。-->
                </div>
            </div>
    </form>
</div>


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