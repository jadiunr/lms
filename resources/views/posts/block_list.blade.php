@extends('layouts.app')

@section('style')

@endsection
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">各年度別試験</div>
        <div class="row">
            <div class="panel-body">
                <ul class="block_list" style="list-style: none;font-size: 20px" >
                    @foreach($block_list as $block)
                    <li><a href="/exam/{{$exam_id}}/{{$block->id}}">{{$block->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>






@endsection