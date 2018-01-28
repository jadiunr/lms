@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            <a href="{{ route('admin.exams') }}"><button type="button" class="btn btn-default">Back</button></a><hr/>

            {!! Form::open(['route' => 'admin.postCreateExam']) !!}
            <div class="form-group">
                {!! Form::label('id', 'Exam ID:') !!}
                {!! Form::text('id', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('id'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('id')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('name'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('name')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection