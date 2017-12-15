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
            <div class="form-group">
                {!! Form::label('name', 'Block Name:') !!}
                {!! Form::text('name', $block->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection