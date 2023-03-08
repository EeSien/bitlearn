@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Question</h2>
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
    {!! Form::open(array('route' => 'questions.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            @foreach($languages as $key=>$language)
                <div class="form-group">
                    <strong>Question {{$language}}:</strong>
                    {!! Form::text('question_'.$key, null, array('id'=>'question_'.$key,'placeholder' => 'Question '. $language ,'class' => 'form-control', 'value'=>(old('question_'.$key) ? old('question_'.$key) :''))) !!}
                </div>
            @endforeach
        </div>

        @for($i = 1; $i < 5; $i++)
            @php($j=1)

            @foreach($languages as $key=>$language)

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Selection {{$i. ' '. $language }}:</strong>
                        @if($j==1)
                            <label>
                                <input type="radio" name="answer_select" id="answer_select" value="{{$i}}"
                                       onchange="selectAnswer()"
                                    {{old('answer_select') == $i ? 'checked' : ''}}/>
                                Answer
                            </label>
                        @endif
                        <input placeholder="Selection {{$i. ' '. $language }} " class="form-control"
                               name="selection{{$i. '_'. $key }}"
                               id="selection{{$i. '_'. $key}}"
                               type="text"
                               value="{{old('selection'.$i.'_'. $key) ? old('selection'.$i.'_'. $key) : ''}}">
                    </div>
                </div>
                @php($j++)

            @endforeach
        @endfor
        <div class="col-xs-12 col-sm-12 col-md-12">
            @foreach($languages as $key=>$language)
                <div class="form-group">
                    <strong>Answer {{$language}}:</strong>
                    {!! Form::text('answer_'.$key, null, array('id'=>'answer_'.$key, 'placeholder' => 'Answer', 'class' => 'form-control', 'readonly', 'value'=>(old('answer_'.$key) ? old('answer_'.$key) :''))) !!}
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
