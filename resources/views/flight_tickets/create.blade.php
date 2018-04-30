@extends('layouts.master')

@section('title', 'Airline Companies')

@section('header', 'Create Airline Company')

@section('sidebar')
    @include('layouts.flight_tickets_sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-body">
            @include('layouts.flight_ticket_alert')
            {!! Form::open(['action' => 'FlightTicketsController@store' , 'method' => 'POST']) !!}
                <h3>Flight Itinerary Ticket</h3>
                <div class="row">
                    <div class="col-xs-4">
                            {{ Form::label('issue_date' , 'Issue date') }}
                            {{ Form::text('issue_date' , '', ['class' => 'form-control datetimepicker' , 'placeholder' => 'Issue date']) }}
                    </div>
                    <div class="col-xs-4">
                            {{ Form::label('booking_date' , 'Booking date') }}
                            {{ Form::text('booking_date' , '', ['class' => 'form-control datetimepicker' , 'placeholder' => 'Booking date']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('booking_reference' , 'Booking Reference') }}
                        {{ Form::text('booking_reference' , '', ['class' => 'form-control' , 'placeholder' => 'Booking Reference']) }}
                    </div>
                </div>
                <br>
                <h3>Airline Details</h3>
                <div class="row">
                    <div class="col-xs-8">
                        {{ Form::label('airline_company_id' , 'Airline') }}
                        {{ Form::select('airline_company_id', $airline_companies, null, ['class' => 'form-control select-form-control']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('pnr' , 'PNR') }}
                        {{ Form::text('pnr' , '', ['class' => 'form-control' , 'placeholder' => 'PNR']) }}
                    </div>
                </div>
                <br>
                <h3>Flight Details</h3>
                <div class="row">
                    <div class="col-xs-4">
                        {{ Form::label('flight_number' , 'Flight number') }}
                        {{ Form::text('flight_number' , '', ['class' => 'form-control' , 'placeholder' => 'Flight number']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('origin' , 'Origin') }}
                        {{ Form::text('origin' , '', ['class' => 'form-control' , 'placeholder' => 'Origin']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('destination' , 'Destination') }}
                        {{ Form::text('destination' , '', ['class' => 'form-control' , 'placeholder' => 'Destination']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        {{ Form::label('departure_date' , 'Departure date') }}
                        {{ Form::text('departure_date' , '', ['class' => 'form-control fightdetailsdatetimepicker' , 'placeholder' => 'Departure date']) }}
                    </div>
                    <div class="col-xs-6">
                        {{ Form::label('arrival_date' , 'Arrival date') }}
                        {{ Form::text('arrival_date' , '', ['class' => 'form-control fightdetailsdatetimepicker' , 'placeholder' => 'Arrival date']) }}
                    </div>
                </div>
                <br>
                <h3>Passenger Details</h3>
                <div class="row">
                    <div class="col-xs-8">
                        {{ Form::label('passenger_name' , 'Passenger name') }}
                        {{ Form::text('passenger_name' , '', ['class' => 'form-control' , 'placeholder' => 'Passenger name']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('ticket_number' , 'Ticket number') }}
                        {{ Form::text('ticket_number' , '', ['class' => 'form-control' , 'placeholder' => 'Ticket number']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        {{ Form::label('pax_type' , 'Pax type') }}
                        {{ Form::text('pax_type' , '', ['class' => 'form-control' , 'placeholder' => 'Pax type']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('add_on_baggage' , 'Add on baggage') }}
                        {{ Form::text('add_on_baggage' , '', ['class' => 'form-control' , 'placeholder' => 'Add on baggage']) }}
                    </div>
                    <div class="form-group col-xs-4">
                        {{ Form::label('total_amount' , 'Total amount') }}
                        <div class="input-group">
                            <div class="input-group-addon">Php</div>
                            {{ Form::text('total_amount' , '', ['class' => 'form-control' , 'placeholder' => 'Total amount']) }}
                        </div>
                    </div>
                </div>
                <br>
                {{ Form::submit('Submit' , ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
         
        </div>
    </div>
@endsection 

@section('scripts')
<script src="/js/moment.js"></script>
<script src="/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function () {
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false,
            sideBySide: true,
        });
        $('.fightdetailsdatetimepicker').datetimepicker({
            format: 'MM/DD/YYYY hh:mm A',
            useCurrent: false,
            sideBySide: true,
        });
    });
</script>
@endsection