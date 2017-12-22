@extends("layouts.app")

@section('content')
    <ul>
        @foreach($exam_list as $exam)
            <li><a href="/exam/{{$exam->id}}">{{$exam->name}}</a></li>
        @endforeach
    </ul>
@endsection
