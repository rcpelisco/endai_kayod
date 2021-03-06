@extends('layouts.master')

@section('title', 'Airline Companies')

@section('header', 'Create Airline Company')

@include('layouts.flight_tickets_sidebar')

@section('content')
    <div class="panel">
        <div class="panel-body">
            @include('layouts.flight_ticket_alert')
            {{-- {!! Form::open(['action' => ['FlightTicketsController@store', $data['flight_ticket']->id], 'method' => 'POST']) !!} --}}
            {!! Form::model($data['flight_ticket'], ['route' => ['flight_tickets.update', $data['flight_ticket']->id]]) !!}
                <h3>Flight Itinerary Ticket</h3>
                <div class="row">
                    <div class="col-xs-4">
                            {{ Form::label('issue_date', 'Issue date') }}
                            {{ Form::text('issue_date', $data['flight_ticket']->issue_date, ['class' => 'form-control datetimepicker', 'placeholder' => 'Issue date']) }}
                    </div>
                    <div class="col-xs-4">
                            {{ Form::label('booking_date', 'Booking date') }}
                            {{ Form::text('booking_date', $data['flight_ticket']->booking_date, ['class' => 'form-control datetimepicker', 'placeholder' => 'Booking date']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('booking_reference', 'Booking Reference') }}
                        {{ Form::text('booking_reference', $data['flight_ticket']->booking_reference, ['class' => 'form-control', 'placeholder' => 'Booking Reference']) }}
                    </div>
                </div>
                <br>
                <h3>Airline Details</h3>
                <div class="row">
                    <div class="col-xs-8">
                        {{ Form::label('airline_company_id', 'Airline') }}
                        {{ Form::select('airline_company_id', $data['airline_companies'], $data['flight_ticket']->airline_company_id, ['class' => 'form-control select-form-control']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('pnr', 'PNR') }}
                        {{ Form::text('pnr', $data['flight_ticket']->pnr, ['class' => 'form-control', 'placeholder' => 'PNR']) }}
                    </div>
                </div>
                <br>
                <h3>Flight Details</h3>
                <div class="row">
                    <div class="col-xs-4">
                        {{ Form::label('flight_number', 'Flight number') }}
                        {{ Form::text('flight_number', $data['flight_ticket']->flight_number, ['class' => 'form-control', 'placeholder' => 'Flight number']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('origin', 'Origin') }}
                        {{ Form::text('origin', $data['flight_ticket']->origin, ['class' => 'form-control', 'placeholder' => 'Origin']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('destination', 'Destination') }}
                        {{ Form::text('destination', $data['flight_ticket']->destination, ['class' => 'form-control', 'placeholder' => 'Destination']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        {{ Form::label('departure_date', 'Departure date') }}
                        {{ Form::text('departure_date', $data['flight_ticket']->departure_date, ['class' => 'form-control fightdetailsdatetimepicker', 'placeholder' => 'Departure date']) }}
                    </div>
                    <div class="col-xs-6">
                        {{ Form::label('arrival_date', 'Arrival date') }}
                        {{ Form::text('arrival_date', $data['flight_ticket']->arrival_date, ['class' => 'form-control fightdetailsdatetimepicker', 'placeholder' => 'Arrival date']) }}
                    </div>
                </div>
                <br>
                <h3>Passenger Details</h3>
                <div class="row">
                    <div class="col-xs-8">
                        {{ Form::label('passenger_name', 'Passenger name') }}
                        {{ Form::text('passenger_name', $data['flight_ticket']->passenger_name, ['class' => 'form-control', 'placeholder' => 'Passenger name']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('ticket_number', 'Ticket number') }}
                        {{ Form::text('ticket_number', $data['flight_ticket']->ticket_number, ['class' => 'form-control', 'placeholder' => 'Ticket number']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        {{ Form::label('pax_type', 'Pax type') }}
                        {{ Form::text('pax_type', $data['flight_ticket']->pax_type, ['class' => 'form-control', 'placeholder' => 'Pax type']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('add_on_baggage', 'Add on baggage') }}
                        {{ Form::text('add_on_baggage', $data['flight_ticket']->add_on_baggage, ['class' => 'form-control', 'placeholder' => 'Add on baggage']) }}
                    </div>
                    <div class="form-group col-xs-4">
                        {{ Form::label('total_amount', 'Total amount') }}
                        <div class="input-group">
                            <div class="input-group-addon">Php</div>
                            {{ Form::text('total_amount', $data['flight_ticket']->total_amount, ['class' => 'form-control', 'placeholder' => 'Total amount']) }}
                        </div>
                    </div>
                </div>
                <br>
                {{Form::hidden('_method', 'PUT')}}
                {{ Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
         
        </div>
    </div>
@endsection 

@section('scripts')
<script src="/js/moment.js"></script>
<script src="/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function () {
        $('.error_close').click(function(){
            $(this).hide()
        })
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