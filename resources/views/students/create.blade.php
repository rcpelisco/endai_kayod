@extends('layouts.master')

@section('title', 'Students')

@section('header', 'Create Student')

@section('sidebar')
    @include('layouts.tutorial_sidebar')
@endsection

@section('content')
    {!! Form::open(['action' => 'StudentsController@store' , 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-xs-6">
                {{Form::label('first_name' , 'First name')}}
                {{Form::text('first_name' , '', ['class' => 'form-control' , 'placeholder' => 'First name'])}}
            </div>
            
            <div class="col-xs-6">
                {{Form::label('last_name' , 'Last name')}}
                {{Form::text('last_name' , '', ['class' => 'form-control' , 'placeholder' => 'Last name'])}}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-6">
                {{Form::label('date_of_birth' , 'Date of Birth')}}
                {{Form::date('date_of_birth' , '', ['class' => 'form-control' , 'placeholder' => 'Date of Birth'])}}
            </div>
            <div class="col-xs-6">
                {{Form::label('gender', 'Gender')}}
                {{Form::select('gender', [
                    'male' => 'Male',
                    'female' => 'Female',
                ], null, ['class' => 'form-control select-form-control'])}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('guardian_id' , 'Guardian')}}
            {{Form::select('guardian_id', $guardians, null, ['class' => 'form-control select-form-control'])}}
        </div>

        {{ Form::submit('Submit' , ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection  