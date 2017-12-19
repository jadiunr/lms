@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            <a href="{{ route('admin.users') }}"><button type="button" class="btn btn-default">Back</button></a><hr/>

            {!! Form::open(['route' => ['admin.updateUser', $user->id], 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('name'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('name')}}</span><br>
                </div>
            @endif
            <div class="form-group">
                {!! Form::label('realname', 'Real Name:') !!}
                {!! Form::text('realname', $user->realname, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('realname'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('realname')}}</span><br>
                </div>
            @endif
            <div class="form-group">
                {!! Form::label('email', 'E-Mail:') !!}
                {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('email'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('email')}}</span><br>
                </div>
            @endif
            <div class="form-group">
                {!! Form::label('icon', 'Icon:') !!}
                <br>
                @if($user->icon)
                <img src="{{ asset('storage/img/' . $user->icon) }}" width="200">
                @endif
                {!! Form::file('file') !!}
            </div>
            @if($errors->has('file'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('file')}}</span><br>
                </div>
            @endif
            <div class="form-group">
                {!! Form::label('admin', 'Role:') !!}
                {!! Form::select('admin', ['1' => '管理者', '0' => 'ユーザ'], $user->admin) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection