@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            {!! Form::open(['route' => ['admin.updateProblem', $problem->id]]) !!}
            <div class="form-group">
                {!! Form::label('problem_number', '問題番号:') !!}
                {!! Form::text('problem_number', $problem->problem_number, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('category', 'カテゴリ:') !!}
                {!! Form::select('category', array_pluck($categories, 'name', 'id'), $problem->category_id) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection