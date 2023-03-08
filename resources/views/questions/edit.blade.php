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
            @foreach($languages as $key=>$language)
                <div class="form-group">
                    <strong>Question {{$language}}: {{ $question->question->$key}} {{ old('question_'.$key)}}</strong>
                    <input id="question_{{$key}}" placeholder="Question {{$language}}" class="form-control"
                           name="question_{{$key}}" type="text"
                           value="{{( old('question_'.$key) ? old('question_'.$key) : $question->question->$key)}}">
                </div>
            @endforeach
        </div>
        @php
            $j =0;
            $number = 1;
        @endphp
        @foreach($question->selection as $key=>$selection)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Selection {{$number}} {{ str_contains($key, 'cn') ? 'Chinese' : 'English' }}:</strong>
                    @if($j%2==0)
                        <label>
                            <input type="radio" name="answer_select" id="answer_select" value="{{$number}}"
                                   onchange="selectAnswer()"
                            @if(old('answer_select'))
                                {{old('answer_select') == $number ? 'checked' :''}}
                                @else
                                {{($question->answer->cn == $selection) ? 'checked' : ''}}
                                @endif
                                />
                            Answer
                        </label>
                    @endif
                    <input
                        placeholder="Selection {{$number. ' '}}{{str_contains($key, 'cn') ? 'Chinese' : 'English' }} "
                        class="form-control"
                        name="selection{{$number. '_'}}{{str_contains($key, 'cn') ? 'cn' : 'en' }}"
                        id="selection{{$number. '_'}}{{str_contains($key, 'cn') ? 'cn' : 'en' }}"
                        type="text"
                        value="{{old('selection'.$number.'_'. str_contains($key, 'cn') ? 'cn' : 'en' ) ? old('selection'.$number.'_'. str_contains($key, 'cn') ? 'cn' : 'en' ) :$question->selection->$key}}">
                </div>
            </div>
            @php($j++)
            @if($j%2==0)
                @php($number ++)
            @endif
        @endforeach

        <div class="col-xs-12 col-sm-12 col-md-12">
            @foreach($languages as $key=>$language)
                <div class="form-group">
                    <strong>Answer {{$language}} :</strong>
                    <input id="answer_{{$key}}" placeholder="Answer" class="form-control" readonly=""
                           name="answer_{{$key}}" type="text"
                           value="{{(old('answer_'.$key) ? old('answer_'.$key) : $question->answer->$key)}}">
                </div>
            @endforeach
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('scripts')
    <script>
        function selectAnswer() {
            var answer_selection = document.querySelector('input[name="answer_select"]:checked').value;
            console.log('selection' + answer_selection + '_cn');
                @foreach($languages as $key=>$language)

            var answer_field_{{$key}} = document.getElementById('answer_{{$key}}');
            var answer_text_{{$key}} = document.getElementById('selection' + answer_selection + '_{{$key}}').value;

            if (answer_text_{{$key}}.trim() !== '') {
                answer_field_{{$key}}.value = answer_text_{{$key}};
            } else {
                alert('The answer for {{$language}} cannot be null!');
                if (document.querySelector('input[name="answer_select"]:checked')) {
                    document.querySelector('input[name="answer_select"]:checked').checked = false;
                }
            }

            @endforeach
        }
    </script>
@endsection
