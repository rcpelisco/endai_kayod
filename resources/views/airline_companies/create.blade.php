@extends('layouts.master')

@section('title', 'Airline Companies')

@section('header', 'Create Airline Company')

@section('sidebar')
    @include('layouts.flight_tickets_sidebar')
@endsection

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
<div class="panel">
    <div class="panel-body">
        @include('layouts.airline_companies_alert')
        {!! Form::open(['action' => 'AirlineCompaniesController@store', 'method' => 'POST', 'files' => true]) !!}
        <div class="row">
            <div class="col-xs-4">
                {{ Form::label('name', 'Company name') }}
                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Company name']) }}
            </div>
            
            <div class="col-xs-4">
                {{ Form::label('address', 'Company Address') }}
                {{ Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Company Address']) }}
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-3">
                {{ Form::label('phone_number', 'Phone number') }}
                {{ Form::text('phone_number', '', ['class' => 'form-control', 'placeholder' => 'Phone number']) }}
            </div>
            <div class="col-xs-5">
                {{ Form::label('email', 'E-mail') }}
                {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'E-mail']) }}
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
                <img src="#" alt="" id="airline_logo">
            </div>
        </div>
        <div class="row">
            
            <div class="col-xs-8">
                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
        
    {!! Form::close() !!}
    
    </div>
</div>
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