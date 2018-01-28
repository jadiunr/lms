@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            <a href="{{ route('admin.editBlock', ['exam_id' => $exam_id, 'block_id' => $block_id]) }}"><button type="button" class="btn btn-default">Back</button></a><hr/>

            {!! Form::open(['route' => ['admin.postCreateProblem', $exam_id, $block_id]]) !!}
            <div class="form-group">
                {!! Form::label('category_id', 'Category:') !!}
                {!! Form::select('category_id', array_pluck($category, 'name', 'id')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('problem_number', 'Problem Number:') !!}
                {!! Form::text('problem_number', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('problem_number'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('problem_number')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('question', 'Question:') !!}
                {!! Form::textarea('question', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('question'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('question')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('answer1', 'Answer1:') !!}
                {!! Form::text('answer1', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('answer1'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('answer1')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('answer2', 'Answer2:') !!}
                {!! Form::text('answer2', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('answer2'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('answer2')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('answer3', 'Answer3:') !!}
                {!! Form::text('answer3', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('answer3'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('answer3')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('answer4', 'Answer4:') !!}
                {!! Form::text('answer4', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('answer4'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('answer4')}}</span><br>
                </div>
            @endif

            <div class="input-group">
                {!! Form::label('pic_que', 'Question Picture:') !!}
                {!! Form::text('pic_que', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('pic_que'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('pic_que')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('pic_ans', 'Answer Picture:') !!}
                {!! Form::text('pic_ans', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('pic_ans'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('pic_ans')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('correct', 'Correct:') !!}
                {!! Form::select('correct', ['ア' => 'ア', 'イ' => 'イ', 'ウ' => 'ウ', 'エ' => 'エ']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('explain', 'Explain:') !!}
                {!! Form::textarea('explain', null, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('explain'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('explain')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection