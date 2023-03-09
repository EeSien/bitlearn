@extends('layouts.app')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daily Question</h2>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('daily-question-answer') }}" >
        @csrf
        @foreach($question->question as $key=>$questiontitle)
            <input hidden name="question" id="question" value="{{$question->id}}"/>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Questions {{$languages[$key]}} :</strong>
                    {{$questiontitle}}
                </div>
            </div>
        @endforeach
        @php
            $j =0;
            $number = 1;
        @endphp
        @foreach($question->selection as $key=>$selection)
            @if($j%2==0)
                <label>
                    <input type="radio" name="answer_select" id="answer_select" value="{{$number}}"/>
                    Answer
                </label>
            @endif
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

        <button type="submit">Submit</button>
    </form>
@endsection
