@extends('layouts.master')

@section('title', 'Airline Company')
@section('header', $airline_company->name)

@section('sidebar')
    @include('layouts.flight_tickets_sidebar')
@endsection

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
                    <img src="../../{{ $airline_company->logo_path }}" alt="">
                </div>
                <div class="col-md-8">
                    <p>Address: {{ $airline_company->address }}</p>
                    <p>Phone Number: {{ $airline_company->phone_number }}</p>
                    <p>E-mail: {{ $airline_company->email }}</p>
                    <p>PNR: {{ $airline_company->pnr }}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <a href="" class="btn btn-primary">Edit</a>
                    <a href="" class="btn btn-danger">Delete</a>
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