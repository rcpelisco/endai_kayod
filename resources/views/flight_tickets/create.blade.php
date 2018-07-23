@extends('layouts.master')

@section('title', 'Airline Companies')

@section('header', 'Create Airline Company')

@include('layouts.flight_tickets_sidebar')
    

@section('content')
    <div class="panel">
        <div class="panel-body">
            @include('layouts.flight_ticket_alert')
            {!! Form::open(['action' => 'FlightTicketsController@store', 'method' => 'POST']) !!}
                <h3>Flight Itinerary Ticket</h3>
                <div class="row">
                    <div class="col-xs-4">
                            {{ Form::label('issue_date', 'Issue date') }}
                            {{ Form::text('issue_date', '', ['class' => 'form-control datetimepicker', 'placeholder' => 'Issue date']) }}
                    </div>
                    <div class="col-xs-4">
                            {{ Form::label('booking_date', 'Booking date') }}
                            {{ Form::text('booking_date', '', ['class' => 'form-control datetimepicker', 'placeholder' => 'Booking date']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('booking_reference', 'Booking Reference') }}
                        {{ Form::text('booking_reference', $data->random_str, ['class' => 'form-control', 'placeholder' => 'Booking Reference', 'readonly' => true]) }}
                    </div>
                </div>
                <br>
                <h3>Airline Details</h3>
                <div class="row">
                    <div class="col-xs-8">
                        {{ Form::label('airline_company_id', 'Airline') }}
                        {{ Form::select('airline_company_id', $data->airline_companies, null, ['class' => 'form-control select-form-control']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('pnr', 'PNR') }}
                        {{ Form::text('pnr', '', ['class' => 'form-control', 'placeholder' => 'PNR']) }}
                    </div>
                </div>
                <br>
                <h3>Flight Details</h3>
                <div class="row">
                    <div class="col-md-4 col-sm-12" id="flight_type">
                        <label for="single_trip" class="radio-inline">
                            {{ Form::radio('flight_type', 'single_trip', true, ['id' => 'single_trip']) }} Single Trip
                        </label>
                        <label for="round_trip" class="radio-inline">
                            {{ Form::radio('flight_type', 'round_trip', false, ['id' => 'round_trip']) }} Round Trip
                        </label>
                    </div>
                </div>
                <br>
                <h4>Flight 1</h4>
                <div class="row">
                    <div class="col-xs-4">
                        {{ Form::label('flight_number', 'Flight number') }}
                        {{ Form::text('flight_number', '', ['class' => 'form-control', 'placeholder' => 'Flight number']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('origin', 'Origin') }}
                        {{ Form::text('origin', '', ['class' => 'form-control', 'placeholder' => 'Origin']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('destination', 'Destination') }}
                        {{ Form::text('destination', '', ['class' => 'form-control', 'placeholder' => 'Destination']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        {{ Form::label('departure_date', 'Departure date') }}
                        {{ Form::text('departure_date', '', ['class' => 'form-control fightdetailsdatetimepicker', 'placeholder' => 'Departure date']) }}
                    </div>
                    <div class="col-xs-6">
                        {{ Form::label('arrival_date', 'Arrival date') }}
                        {{ Form::text('arrival_date', '', ['class' => 'form-control fightdetailsdatetimepicker', 'placeholder' => 'Arrival date']) }}
                    </div>
                </div>
                <div id="secondTicket">
                    <hr>
                    <h4>Flight 2</h4>
                    <div class="row">
                        <div class="col-xs-4">
                            {{ Form::label('flight_number_2', 'Flight number 2') }}
                            {{ Form::text('flight_number_2', '', ['class' => 'form-control', 'placeholder' => 'Flight number 2']) }}
                        </div>
                        <div class="col-xs-4">
                            {{ Form::label('origin_2', 'Origin 2') }}
                            {{ Form::text('origin_2', '', ['class' => 'form-control', 'placeholder' => 'Origin 2']) }}
                        </div>
                        <div class="col-xs-4">
                            {{ Form::label('destination_2', 'Destination 2') }}
                            {{ Form::text('destination_2', '', ['class' => 'form-control', 'placeholder' => 'Destination 2']) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            {{ Form::label('departure_date_2', 'Departure date 2') }}
                            {{ Form::text('departure_date_2', '', ['class' => 'form-control fightdetailsdatetimepicker', 'placeholder' => 'Departure date 2']) }}
                        </div>
                        <div class="col-xs-6">
                            {{ Form::label('arrival_date_2', 'Arrival date 2') }}
                            {{ Form::text('arrival_date_2', '', ['class' => 'form-control fightdetailsdatetimepicker', 'placeholder' => 'Arrival date 2']) }}
                        </div>
                    </div>
                </div>
                <br>
                <h3>Passenger Details</h3>
                <div class="row">
                    <div class="col-xs-8">
                        {{ Form::label('passenger_name', 'Passenger name') }}
                        {{ Form::text('passenger_name', '', ['class' => 'form-control', 'placeholder' => 'Passenger name']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('ticket_number', 'Ticket number') }}
                        {{ Form::text('ticket_number', '', ['class' => 'form-control', 'placeholder' => 'Ticket number']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        {{ Form::label('pax_type', 'Pax type') }}
                        {{ Form::text('pax_type', '', ['class' => 'form-control', 'placeholder' => 'Pax type']) }}
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('add_on_baggage', 'Add on baggage') }}
                        {{ Form::text('add_on_baggage', '', ['class' => 'form-control', 'placeholder' => 'Add on baggage']) }}
                    </div>
                    <div class="col-xs-3 hidden">
                        {{ Form::label('add_on_baggage_2', 'Add on baggage 2') }}
                        {{ Form::text('add_on_baggage_2', '', ['class' => 'form-control', 'placeholder' => 'Add on baggage 2']) }}
                    </div>
                    <div class="form-group col-xs-4">
                        {{ Form::label('total_amount', 'Total amount') }}
                        <div class="input-group">
                            <div class="input-group-addon">Php</div>
                            {{ Form::text('total_amount', '', ['class' => 'form-control', 'placeholder' => 'Total amount']) }}
                        </div>
                    </div>
                </div>
                <br>
                {{ Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
         
        </div>
    </div>
@endsection 

@section('scripts')
<script src="/js/moment.js"></script>
<script src="/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(() => {
        $('#secondTicket').hide()
        $('.error_close').click(function(){ $(this).hide() })
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false,
            sideBySide: true,
        })
        $('.fightdetailsdatetimepicker').datetimepicker({
            format: 'MM/DD/YYYY hh:mm A',
            useCurrent: false,
            sideBySide: true,
        })
        $('input[name="flight_type"]').change(function() {
            $('#secondTicket').hide();
            hide_add_on_baggage()
            if($(this).val() == 'round_trip') {
                $('#secondTicket').show();
                show_add_on_baggage()
            }
        })

        function show_add_on_baggage() {
            $('input[name="add_on_baggage"]').parent().removeClass('col-xs-4')
            $('input[name="add_on_baggage"]').parent().addClass('col-xs-3')
            $('input[name="pax_type"]').parent().removeClass('col-xs-4')
            $('input[name="pax_type"]').parent().addClass('col-xs-3')
            $('input[name="total_amount"]').parent().parent().removeClass('col-xs-4')
            $('input[name="total_amount"]').parent().parent().addClass('col-xs-3')
            $('input[name="add_on_baggage_2"]').parent().removeClass('hidden')
        }

        function hide_add_on_baggage() {
            $('input[name="add_on_baggage"]').parent().addClass('col-xs-4')
            $('input[name="add_on_baggage"]').parent().removeClass('col-xs-3')
            $('input[name="pax_type"]').parent().addClass('col-xs-4')
            $('input[name="pax_type"]').parent().removeClass('col-xs-3')
            $('input[name="total_amount"]').parent().parent().addClass('col-xs-4')
            $('input[name="total_amount"]').parent().parent().removeClass('col-xs-3')
            $('input[name="add_on_baggage_2"]').parent().addClass('hidden')
        }
    })
</script>
@endsection