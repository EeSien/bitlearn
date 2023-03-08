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
        @foreach($question->question as $key=>$questiontitle)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Questions {{$language[$key]}} :</strong>
                    {{$questiontitle}}
                </div>
            </div>
        @endforeach
        @php
            $j =0;
            $number = 1;
        @endphp
        @foreach($question->selection as $key=>$selection)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Selection {{$number}} {{ str_contains($key, 'cn') ? 'Chinese' : 'English' }}:</strong>
                    {{$selection}}
                </div>
            </div>
            @php($j++)
            @if($j%2==0)
                @php($number ++)
            @endif
        @endforeach
        @foreach($question->answer as $key=>$answer)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Correct Answer {{$language[$key]}} :</strong>
                    {{$answer}}
                </div>
            </div>
        @endforeach
    </div>
@endsection
