@extends('layouts.master')

@section('title', 'Guardians')

@section('header', 'Edit Guardian Info')

@include('layouts.tutorial_sidebar')

@section('content')
    {!! Form::open(['action' => ['GuardiansController@update', $guardians->id], 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-xs-6">
                {{Form::label('first_name', 'First name')}}
                {{Form::text('first_name', $guardians->first_name, ['class' => 'form-control', 'placeholder' => 'First name'])}}
            </div>
            
            <div class="col-xs-6">
                {{Form::label('last_name', 'Last name')}}
                {{Form::text('last_name', $guardians->last_name, ['class' => 'form-control', 'placeholder' => 'Last name'])}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('contact_no', 'Contact no.')}}
            {{Form::text('contact_number', $guardians->contact_number, ['class' => 'form-control', 'placeholder'=> 'Contact no.'])}}
        </div>

        <div class="form-group">
                {{Form::label('address', 'Address')}}
                {{Form::text('address', $guardians->address, ['class' => 'form-control', 'placeholder'=> 'Address'])}}
            </div>

        {{Form::hidden('_method', 'PUT')}}
        {{ Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection