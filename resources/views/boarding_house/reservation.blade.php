@extends('layouts.master')

@section('title', 'Boarding House')

@section('header', 'Reservations')

@include('layouts.boarding_house_sidebar')

@section('create_button')

@endsection

@section('stylesheets')
@endsection

@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <div id="calendar"></div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="reserveModalLabel">
  <div class="modal-dialog" role="document">
    {!! Form::open(['action' => 'ReservationsController@store' , 'method' => 'POST']) !!}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="reserveModalLabel">Reserve</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {{Form::label('date_start' , 'Start Date')}}
                {{Form::date('date_start' , '', ['class' => 'form-control' , 'placeholder' => 'Start Date'])}}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{Form::label('date_end' , 'End Date')}}
                {{Form::date('date_end' , '', ['class' => 'form-control' , 'placeholder' => 'End Date'])}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                {{Form::label('room' , 'Room')}}
                {{Form::select('room' , $rooms, null, ['class' => 'form-control select-form-control'])}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {{Form::label('first_name' , 'First name')}}
                {{Form::text('first_name' , '', ['class' => 'form-control' , 'placeholder' => 'First name'])}}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{Form::label('last_name' , 'Last name')}}
                {{Form::text('last_name' , '', ['class' => 'form-control' , 'placeholder' => 'Last name'])}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                {{Form::label('contact_no' , 'Contact no.')}}
                {{Form::text('contact_no' , '', ['class' => 'form-control' , 'placeholder' => 'Contact no.'])}}
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{Form::label('pax' , 'PAX')}}
                {{Form::number('pax' , '', ['class' => 'form-control' , 'placeholder' => 'PAX'])}}
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="eventModalLabel">Event</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">Name: </div>
            <div class="col-sm-6" id="event_name"></div>
          </div>
          <div class="row">
            <div class="col-sm-6">Contact no.</div>
            <div class="col-sm-6" id="event_contact_no"></div>
          </div>
          <div class="row">
            <div class="col-sm-6">Start Date</div>
            <div class="col-sm-6" id="event_date_start"></div>
          </div>
          <div class="row">
            <div class="col-sm-6">End Date</div>
            <div class="col-sm-6" id="event_date_end"></div>
          </div>
          <div class="row">
            <div class="col-sm-6">Room: </div>
            <div class="col-sm-6" id="event_room"></div>
          </div>
          <div class="row">
            <div class="col-sm-6">Location: </div>
            <div class="col-sm-6" id="event_location"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
$(function() {
  $('#calendar').fullCalendar({
    dayClick: function(date, jsEvent, view) {
      $('#reserveModal').modal()
      $('input[name="date_start"]').val(date.format())
    },
    events: {
      url: 'reservations/events',
      type: 'GET',
      data: '<>php csrf_token() ?>'
    },
    eventClick: function(calEvent, jsEvent, view) {
      $('#event_name').html(calEvent.name)
      $('#event_contact_no').html(calEvent.contact_no)
      $('#event_date_start').html(calEvent.start.format('MMMM DD, YYYY'))
      $('#event_date_end').html(calEvent.end.format('MMMM DD, YYYY'))
      $('#event_room').html(calEvent.room)
      $('#event_location').html(calEvent.location)
      $('#eventModal').modal()
    }
  })
})
</script>
@endsection