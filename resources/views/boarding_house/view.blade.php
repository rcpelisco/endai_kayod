@extends('layouts.master')

@section('title', 'Boarding House')

@section('header', $room->name)

@include('layouts.boarding_house_sidebar')

@section('stylesheets')
<style>
    .hr-total {
        margin-bottom: 5px;
    }
    .hr-grand-total {
        margin-top: 5px;
    }
    .row-lessons h4 {
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .type-title {
        margin: 0 0 10px 0;
    }
    .display-inline-block {
      display: inline-block;
      margin-bottom: 0px;
    }
    .display-inline-block + h4.pull-right {
      margin-top: 20px;
    }
    .my-2 {
      margin-top: 10px;
      margin-bottom: 10px;
    }
    .my-0 {
      margin-top: 0px;
      margin-bottom: 0px;
    }
    .mt-25 {
      margin-top: 25px;
    }
</style>
@endsection

@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
      <div class="col-md-4">
        <div class="row">
          <div class="col-xs-12">
            <h3 class="display-inline-block">Room Info</h3>
            <hr class="my-2">
            <div class="row">
              <div class="col-xs-8">
                Room Name: 
              </div>
              <div class="col-xs-4">
                {{ $room->name }}
              </div>
            </div>
            <div class="row">
              <div class="col-xs-8">
                Room Type: 
              </div>
              <div class="col-xs-4">
                {{ $room->type }}
              </div>
            </div>
            <div class="row">
              <div class="col-xs-8">
                Room Location: 
              </div>
              <div class="col-xs-4">
                {{ $room->location }}
              </div>
            </div>
            <div class="row">
              <div class="col-xs-7">
                Room Price: 
              </div>
              <div class="col-xs-5">
                &#8369; 
                <span class="pull-right">
                  {{ number_format($room->price, 2) }}
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          
        </div>
      </div>
      <div class="col-md-6">
        <h3>Reserved</h3>
        <hr class="my-2">
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <td>Name</td>
                  <td>Start Date</td>
                  <td>End Date</td>
                </tr>
              </thead>
              <tbody>
                @foreach($room->reservations->where('date_start', '>=', Carbon\Carbon::now()) as $reservation)
                <tr>
                  <td>{{ $reservation->first_name . ' ' . $reservation->last_name }}</td>
                  <td>{{ $reservation->date_start->format('F d, Y') }}</td>
                  <td>{{ $reservation->date_end->format('F d, Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="paymentModalLabel">Payment <small>form</small></h4>
      </div>
      <div class="modal-body">
        {{Form::label('amount' , 'Amount')}}
        {{Form::number('amount' , '', ['class' => 'form-control' , 'placeholder' => 'Amount'])}}
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
</script>
@endsection