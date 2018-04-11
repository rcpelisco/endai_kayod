@extends('layouts.master')

@section('title', 'Students')

@section('header', 'Edit Student Info')
@section('sidebar')
    @include('layouts.tutorial_sidebar')
@endsection

@section('content')
    {!! Form::open(['action' => ['StudentsController@update', $data['student']->id], 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-xs-6">
                {{Form::label('first_name', 'First name')}}
                {{Form::text('first_name', $data['student']->first_name, ['class' => 'form-control', 'placeholder' => 'First name'])}}
            </div>
            
            <div class="col-xs-6">
                {{Form::label('last_name', 'Last name')}}
                {{Form::text('last_name', $data['student']->last_name, ['class' => 'form-control', 'placeholder' => 'Last name'])}}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-6">
                {{Form::label('date_of_birth', 'Date of Birth')}}
                {{Form::date('date_of_birth', $data['student']->date_of_birth, ['class' => 'form-control', 'placeholder' => 'Date of Birth'])}}
            </div>
            <div class="col-xs-6">
                {{Form::label('gender', 'Gender')}}
                {{Form::select('gender', [
                    'male' => 'Male',
                    'female' => 'Female',
                ], $data['student']->gender, ['class' => 'form-control select-form-control'])}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('guardian_id', 'Guardian')}}
            {{Form::select('guardian_id', $data['guardians'], $data['student']->guardian_id, ['class' => 'form-control select-form-control'])}}
        </div>

        {{Form::hidden('_method', 'PUT')}}
        {{ Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection  