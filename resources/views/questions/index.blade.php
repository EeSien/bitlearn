@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Questions Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('questions.create') }}"> Create New Question</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Question</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $question)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $question->question }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('questions.show',$question->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('questions.edit',$question->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['questions.destroy', $question->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {!! $data->render() !!}
@endsection
