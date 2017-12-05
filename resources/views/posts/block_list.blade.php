@extends('layouts.app')

@section('style')

@endsection
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">各年度別試験</div>
        <div class="row">
            <div class="panel-body">
                <ul class="block_list"style="list-style: none;font-size: 20px"; >
                    <li><a href="/exam/{{$exam_id}}/H25_s">平成２５年　春</a></li>
                    <li><a href="/exam/{{$exam_id}}/H25_s">平成２５年　春</a></li>
                    <li><a href="/exam/{{$exam_id}}/H25_s">平成２５年　春</a></li>
                    <li><a href="/exam/{{$exam_id}}/H25_s">平成２５年　春</a></li>
                    <li><a href="/exam/{{$exam_id}}/H25_s">平成２５年　春</a></li>
                    <li><a href="/exam/{{$exam_id}}/H25_s">平成２５年　春</a></li>
                    <li><a href="/exam/{{$exam_id}}/H25_s">平成２５年　春</a></li>
                    <li><a href="/exam/{{$exam_id}}/H25_s">平成２５年　春</a></li>
                </ul>
            </div>
        </div>
    </div>






@endsection