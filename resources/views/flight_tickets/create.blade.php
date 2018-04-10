@extends('layouts.master')

@section('title', 'Airline Companies')

@section('header', 'Create Airline Company')

@section('sidebar')
    @include('layouts.flight_tickets_sidebar')
@endsection

@section('content')
    {!! Form::open(['action' => 'AirlineCompaniesController@store' , 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-xs-4">
                {{ Form::label('name' , 'Company name') }}
                {{ Form::text('name' , '', ['class' => 'form-control' , 'placeholder' => 'Company name']) }}
            </div>
            
            <div class="col-xs-8">
                {{ Form::label('address' , 'Company Address') }}
                {{ Form::text('address' , '', ['class' => 'form-control' , 'placeholder' => 'Company Address']) }}
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4">
                {{ Form::label('phone_number' , 'Phone number') }}
                {{ Form::text('phone_number' , '', ['class' => 'form-control' , 'placeholder' => 'Phone number']) }}
            </div>
            <div class="col-xs-4">
                {{ Form::label('email' , 'E-mail') }}
                {{ Form::text('email' , '', ['class' => 'form-control' , 'placeholder' => 'E-mail']) }}
            </div>
            <div class="col-xs-4">
                {{ Form::label('pnr' , 'PNR') }}
                {{ Form::text('pnr' , '', ['class' => 'form-control' , 'placeholder' => 'PNR']) }}
            </div>
        </div>

        <div class="row">
           
            <div class="col-xs-6">
                {{ Form::label('logo_path' , 'Logo') }}
                {{ Form::text('logo_path' , '', ['class' => 'form-control' , 'placeholder' => 'Logo']) }}
            </div>
        </div>
        <br>
        {{ Form::submit('Submit' , ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection  