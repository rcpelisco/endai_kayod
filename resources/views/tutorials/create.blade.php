@extends('layouts.master')

@section('title', 'Lesson')

@section('header', 'Add Lesson')

@section('content')
    {!! Form::open(['action' => 'TutorialsController@store' , 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-6">
                {{Form::label('title' , 'Title')}}
                {{Form::text('title' , '', ['class' => 'form-control' , 'placeholder' => 'Title'])}}
            </div>
            
            <div class="col-6">
                {{Form::label('description' , 'Description')}}
                {{Form::text('description' , '', ['class' => 'form-control' , 'placeholder' => 'Description'])}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('price' , 'Price')}}
            {{Form::text('price' , '', ['class' => 'form-control' , 'placeholder' => 'Price'])}}
        </div>

        <div class="form-group">
            {{Form::label('type' , 'Type:')}}
            {{Form::select('type', [
                'academic' => 'Academic',
                'interest' => 'Interest',
            ], null, ['class' => 'form-control'])}}
        </div>

        {{ Form::submit('Submit' , ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection  