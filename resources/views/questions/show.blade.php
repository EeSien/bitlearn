@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Question</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('questions.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Questions :</strong>
                {{$question->question}}
            </div>
        </div>
        @foreach($question->selection as $key=>$selection)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Selection {{$key+1}}:</strong>
                    {{$selection}}
                </div>
            </div>
        @endforeach
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Correct Answer:</strong>
                {{$question->answer}}
            </div>
        </div>
    </div>
@endsection
