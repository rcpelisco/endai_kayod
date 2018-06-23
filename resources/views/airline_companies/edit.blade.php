@extends('layouts.master')

@section('title', 'Airline Companies')

@section('header', 'Create Airline Company')

@include('layouts.flight_tickets_sidebar')

@section('stylesheets')
    <style>
        img {
            width: 250px;
        }

        .btn {
            margin-top: 15px;
        }
    </style>
@endsection

@section('content')
    {!! Form::open(['action' => ['AirlineCompaniesController@update', $airline_company->id], 'method' => 'POST', 'files' => true]) !!}
        <div class="row">
            <div class="col-xs-4">
                {{ Form::label('name', 'Company name') }}
                {{ Form::text('name', $airline_company->name, ['class' => 'form-control', 'placeholder' => 'Company name']) }}
            </div>
            
            <div class="col-xs-8">
                {{ Form::label('address', 'Company Address') }}
                {{ Form::text('address', $airline_company->address, ['class' => 'form-control', 'placeholder' => 'Company Address']) }}
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4">
                {{ Form::label('phone_number', 'Phone number') }}
                {{ Form::text('phone_number', $airline_company->phone_number, ['class' => 'form-control', 'placeholder' => 'Phone number']) }}
            </div>
            <div class="col-xs-4">
                {{ Form::label('email', 'E-mail') }}
                {{ Form::text('email', $airline_company->email, ['class' => 'form-control', 'placeholder' => 'E-mail']) }}
            </div>
            <div class="col-xs-4">
                {{ Form::label('pnr', 'PNR') }}
                {{ Form::text('pnr', $airline_company->pnr, ['class' => 'form-control', 'placeholder' => 'PNR']) }}
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4">
                {{ Form::label('logo_path', 'Logo') }}
                {{ Form::file('logo_path', ['class' => 'form-control-file', 
                    'id' => 'logo_input', 'onchange' => 'handleFiles(this.files)',
                    'accept' => 'image/*']) }}
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-4">
                <img src="/{{ $airline_company->logo_path }}" alt="" id="airline_logo">
            </div>
        </div>
        <div class="row">

            <div class="col-xs-8">
                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
        {{ Form::hidden('_method', 'PUT') }}
    {!! Form::close() !!}
@endsection 

@section('scripts')
<script>
    function handleFiles(file) {
        let reader = new FileReader();
        reader.readAsDataURL(file[0])
        reader.onload = function(e) {
            $('#airline_logo').attr('src', e.target.result)
        }
    }
</script>
@endsection