@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            <a href="{{ route('admin.getBlocksGlobal') }}"><button type="button" class="btn btn-default">Back</button></a><hr/>

            {!! Form::open(['route' => ['admin.updateBlockGlobal', $block->id]]) !!}
            <div class="form-group">
                {!! Form::label('id', 'Block ID:') !!}
                {!! Form::text('id', $block->id, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('id'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('id')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('name', 'Block Name:') !!}
                {!! Form::text('name', $block->name, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('name'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('name')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection