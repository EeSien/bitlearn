@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit New Question</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('questions.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($question, ['method' => 'PATCH','route' => ['questions.update', $question->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Questions :</strong>
                {!! Form::text('question', null, array('placeholder' => 'Question','class' => 'form-control')) !!}
            </div>
        </div>
        @for($i = 1; $i < 5; $i++)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Selection {{$i}}:</strong>
                    <input placeholder="Selection {{$i}}" class="form-control" name="selection{{$i}}"
                           id="selection{{$i}}" type="text" value="{{$question->selection[$i-1]}}">
                </div>
            </div>
        @endfor

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Answer:</strong>
                {!! Form::text('answer',null, array('placeholder' => 'Answer','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
