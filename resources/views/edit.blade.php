@extends('layouts.app')

@section('content')
<div class="container">
    <h2>アイコン変更</h2>
    {!! Form::open(['url' => '/upload', 'method' => 'post', 'files' => true]) !!}

    {{--成功時のメッセージ--}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    {{-- エラーメッセージ --}}
    @if ($errors->has('file'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('file') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        @if ($user->icon)
            <p>
                <img src="{{ asset('storage/img/' . $user->icon) }}" alt="icon" />
            </p>
        @endif
        {!! Form::label('file', '画像アップロード', ['class' => 'control-label']) !!}
        {!! Form::file('file') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('アイコン変更', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}

    <h2>名前変更</h2>
    @if($errors->has('name'))
        <div class="alert alert-danger">
            <span class="error">{{$errors->first('name')}}</span><br>
        </div>
    @endif
    <form action="name" method="post">
        新しい名前:<input type="text" name="name"><br>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        {!! Form::submit('名前変更', ['class' => 'btn btn-default']) !!}
    </form>

    <h2>パスワード変更</h2>
    <form action="password" method="post">
        現在のパスワード:<input type="password" name="oldpassword"><br>
        @if($errors->has('oldpassword'))
            <span class="error" style="color:red">{{$errors->first('oldpassword')}}</span><br>
        @endif
        新しいパスワード:<input type="password" name="newpassword1"><br>
        @if($errors->has('newpassword1'))
            <span class="error" style="color:red">{{$errors->first('newpassword1')}}</span><br>
        @endif
        新しいパスワード(確認):<input type="password" name="newpassword2"><br>
        @if($errors->has('newpassword2'))
            <span class="error" style="color:red">{{$errors->first('newpassword2')}}</span><br>
        @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        {!! Form::submit('パスワード変更', ['class' => 'btn btn-default']) !!}
    </form>


</div>
@endsection