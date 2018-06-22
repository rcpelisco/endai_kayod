@extends('layouts.master')

@section('title', 'Guardians')

@section('header', 'Guardians')

@include('layouts.tutorial_sidebar')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div>
                @include('layouts.guardian_alert')
            </div>
            {!! Form::open(['action' => 'GuardiansController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('first_name', 'First name')}}
                    {{Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => 'First name'])}}
                </div>

                <div class="form-group">
                    {{Form::label('last_name', 'Last name')}}
                    {{Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => 'Last name'])}}
                </div>

                <div class="form-group">
                    {{Form::label('contact_number', 'Contact number')}}
                    {{Form::text('contact_number', '', ['class' => 'form-control', 'placeholder' => 'Contact number'])}}
                </div>

                <div class="form-group">
                    {{Form::label('address', 'Address')}}
                    {{Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Address'])}}
                </div>
                {{ Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection  