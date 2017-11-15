@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            {!! Form::open(['route' => ['admin.updateUser', $user->id], 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'E-Mail:') !!}
                {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('icon', 'Icon:') !!}
                <br><img src="{{ asset('storage/img/' . $user->icon) }}" width="200">
                {!! Form::file('file') !!}
            </div>
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