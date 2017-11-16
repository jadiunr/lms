@extends('layouts.app')

@section('content')
    @if(isset($threads[0]))
        @foreach($threads as $thread)
            {{ Html::link('/bbs/show?id='.$thread->id, $thread->title) }}<br>
        @endforeach
    @else
        検索結果:0
    @endif
@endsection