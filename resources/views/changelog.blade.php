@extends('layouts.app')

@section('content')
    @foreach($changelog as $log)
        <h2>{{$log->created_at}}</h2>
        <h2>{{$log->content}}</h2>
    @endforeach
@endsection