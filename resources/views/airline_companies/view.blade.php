@extends('layouts.master')

@section('title', 'Airline Company')

@section('header', $airline_company->name)

@include('layouts.flight_tickets_sidebar')

@section('stylesheets')
<style>
    img {
        width: 275px;
    }
</style>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ url($airline_company->logo_path) }}" alt="">
                </div>
                <div class="col-md-8">
                    <p>Address: {{ $airline_company->address }}</p>
                    <p>Phone Number: {{ $airline_company->phone_number }}</p>
                    <p>E-mail: {{ $airline_company->email }}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['action' => ['AirlineCompaniesController@destroy', $airline_company->id], 'method' => 'POST']) !!}
                        <a href="{{route('airline_companies.edit', ['airline_company' => $airline_company->id])}}" class="btn btn-primary">Edit</a>
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    });
</script>
@endsection