@extends('layouts.master')

@section('title', 'Flight Tickets')

@section('header', 'Flight Tickets')

@section('sidebar')
    @include('layouts.flight_tickets_sidebar')
@endsection

@section('create_button')
    <a href="flight_tickets/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Ticket</a>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Passenger Name</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Departure date</th>
                        <th>Arrival date</th>
                        <th>Airline</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flight_tickets as $flight_ticket) 
                    <tr>
                    <td>{{$flight_ticket->id}}</td>
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