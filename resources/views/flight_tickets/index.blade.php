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
                        <th>Booking Ref.</th>
                        <th>Airline PNR</th>
                        <th>Flight Number</th>
                        <th>Origin</th>
                        <th>Destination</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flight_tickets as $flight_ticket) 
                    <tr>
                        <td><a href="/flight_tickets/{{ $flight_ticket->id }}">
                            {{ $flight_ticket->booking_reference }}</a></td>
                        <td>{{ $flight_ticket->pnr }}</td>
                        <td>{{ $flight_ticket->flight_number }}</td>
                        <td>{{ $flight_ticket->origin }}</td>
                        <td>{{ $flight_ticket->destination }}</td>
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