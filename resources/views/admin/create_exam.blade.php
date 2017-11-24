@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            {!! Form::open(['route' => 'admin.postCreateExam']) !!}
            <div class="form-group">
                {!! Form::label('id', 'Exam ID:') !!}
                {!! Form::text('id', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection