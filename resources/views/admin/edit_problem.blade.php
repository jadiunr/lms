@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            <a href="{{ route('admin.editBlock', ['exam_id' => $exam_id, 'block_id' => $block_id]) }}"><button type="button" class="btn btn-default">Back</button></a><hr/>

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            {!! Form::open(['route' => ['admin.updateProblem', $exam_id, $block_id, $problem->id]]) !!}
            <div class="form-group">
                {!! Form::label('category', 'カテゴリ:') !!}
                {!! Form::select('category_id', array_pluck($categories, 'name', 'id'), $problem->category_id) !!}
            </div>
            <div class="form-group">
                {!! Form::label('problem_number', '問題番号:') !!}
                {!! Form::text('problem_number', $problem->problem_number, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('problem_number'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('problem_number')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('question', '問題:') !!}
                {!! Form::textarea('question', $problem->question, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('question'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('question')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('answer1', 'ア:') !!}
                {!! Form::text('answer1', $problem->answer1, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('answer1'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('answer1')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('answer2', 'イ:') !!}
                {!! Form::text('answer2', $problem->answer2, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('answer2'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('answer2')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('answer3', 'ウ:') !!}
                {!! Form::text('answer3', $problem->answer3, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('answer3'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('answer3')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('answer4', 'エ:') !!}
                {!! Form::text('answer4', $problem->answer4, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('answer4'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('answer4')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('pic_que', '問題用画像:') !!}
                {!! Form::text('pic_que', $problem->pic_que, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('pic_que'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('pic_que')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('pic_ans', '解答用画像:') !!}
                {!! Form::text('pic_ans', $problem->pic_ans, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('pic_ans'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('pic_ans')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('correct', '正解:') !!}
                {!! Form::select('correct', ['ア' => 'ア', 'イ' => 'イ', 'ウ' => 'ウ', 'エ' => 'エ'], $problem->correct) !!}
            </div>

            <div class="form-group">
                {!! Form::label('explain', '解説:') !!}
                {!! Form::textarea('explain', $problem->explain, ['class' => 'form-control']) !!}
            </div>
            @if($errors->has('explain'))
                <div class="alert alert-danger">
                    <span class="error">{{$errors->first('explain')}}</span><br>
                </div>
            @endif

            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection