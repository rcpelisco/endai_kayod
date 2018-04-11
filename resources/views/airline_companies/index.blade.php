@extends('layouts.master')

@section('title', 'Airline Companies')
@section('header', 'Airline Companies')

@section('sidebar')
    @include('layouts.flight_tickets_sidebar')
@endsection

@section('create_button')
    <a href="airline_companies/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Airline Company</a>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($airline_companies as $airline_company) 
                    <tr>
                        <td><a href="airline_companies/{{ $airline_company->id }}">
                            {{ $airline_company->name }}
                        </a></td>
                        <td>{{ $airline_company->address }}</td>
                        <td>{{ $airline_company->phone_number }}</td>
                        <td>{{ $airline_company->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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