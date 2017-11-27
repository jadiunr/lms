@extends('layouts.app')

@section('content')
    @foreach($posts as $post)
        {{ $post->comment }}<br>
    @endforeach
@endsection