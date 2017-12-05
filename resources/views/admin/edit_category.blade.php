@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            <a href="{{ route('admin.getCategories') }}"><button type="button" class="btn btn-default">Back</button></a><hr/>

            {!! Form::open(['route' => ['admin.updateCategory', $category->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Category Name:') !!}
                {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection