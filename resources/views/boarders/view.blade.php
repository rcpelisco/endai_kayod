@extends('layouts.master')

@section('title', 'Boarder')

@section('header', $boarder->first_name . ' ' . $boarder->last_name)

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
      <div class="col-md-7">
        <div class="row">
          <div class="col-xs-12">
            @if($boarder->room->type == 'monthly')
              {!! Form::open(['action' => ['BoardersController@destroy', $boarder->id], 'method' => 'DELETE']) !!}
                <h3 class="display-inline-block">Account Info</h3>
                <button type="submit" class="btn btn-xs btn-danger pull-right mt-25 {{ $boarder->balance() == 0 ? '' : 'disabled' }}" style="margin-left: 5px">Drop</button>
                <button type="button" class="btn btn-xs btn-primary pull-right mt-25" data-toggle="modal" data-target="#paymentModal">Pay</button>
              {!! Form::close() !!}
              <hr class="my-2">
              <div class="row">
                <div class="col-xs-6">
                  Date Started: 
                </div>
                <div class="col-xs-6">
                  <span class="pull-right">
                    {{ $boarder->created_at->format('F d, Y') }}
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  Due Date: 
                </div>
                <div class="col-xs-6">
                  <span class="pull-right">
                    {{ $boarder->nextDue()->format('F d, Y') }}
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  Last Paid Month: 
                </div>
                <div class="col-xs-6">
                  <span class="pull-right">
                    {{ $boarder->lastPaidMonth()->format('F d, Y') }}
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  Months Delayed: 
                </div>
                <div class="col-xs-6">
                  <span class="pull-right">
                    {{ $boarder->monthsDelayed() }}
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-9">
                  Monthly Payment: 
                </div>
                <div class="col-xs-3">
                  &#8369; 
                  <span class="pull-right">
                    {{ number_format($boarder->monthlyPayment(), 2) }}
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-9">
                  Total Payment: 
                </div>
                <div class="col-xs-3">
                  &#8369; 
                  <span class="pull-right">
                    {{ number_format($boarder->totalPayment(), 2) }}
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-9">
                  Balance: 
                </div>
                <div class="col-xs-3">
                  &#8369; 
                  <span class="pull-right">
                    {{ number_format($boarder->balance(), 2) }}
                  </span>
                </div>
              </div>
            @else
              <h3>Roommates</h3>
              <hr class="my-2">
              @foreach($boarder->roommates() as $roommate) 
              {{ $roommate->first_name . ' ' . $roommate->last_name }}
              <hr class="my-0">
              @endforeach
            @endif
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <h3>Payments</h3>
              <hr class="my-2">
              <table class="table">
                <thead>
                  <tr>
                    <td style="padding-top: 0px"><small>Date Paid</small></td>
                    <td style="padding-top: 0px"><small>Month</small></td>
                    <td style="padding-top: 0px"><small>Amount</small></td>
                  </tr>
                </thead>
                @php
                  $payments = $boarder->payments()->get();
                  $month = $boarder->created_at->subMonth();
                  $amount = 0;
                  $counter = 0;
                  $temp = 0;
                @endphp
                @foreach($payments as $payment)
                
                  @php
                    if($amount == 0) {
                      $counter += !$loop->first ? 1 : 0;
                      $temp = $month->addMonth();
                    }
                    $amount += $payment->amount;
                    if($amount / $boarder->monthlyPayment() >= 1) {
                      $temp = $temp->addMonths(($amount / $boarder->monthlyPayment()) - 1);
                      $amount = 0;
                    }
                    $month = $counter < 1 ? 'Down Payment' : $temp;
                  @endphp
                  
                  <tr>
                    <td>{{ $payment->created_at->format('F d, Y') }}</td>
                    <td>{{ is_string($month) ? $month : $month->format('F, Y') }}</td>
                    <td>&#8369; <span class="pull-right">{{ number_format($payment->amount, 2) }}</span></td>
                  </tr>
                  @php
                    $month = $counter < 1 ? $temp : $month;
                  @endphp
                @endforeach
                
              </table>
          </div>
        </div>
      </div>
      <div class="col-md-5">
          <h3>Boarder's Info</h3>
          <hr class="my-2">
          <div class="row">
            <div class="col-xs-6">
              Full name:
            </div>
            <div class="col-xs-6">
              {{ $boarder->first_name . ' ' . $boarder->last_name }}
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              Boarder Type:
            </div>
            <div class="col-xs-6">
              {{ $boarder->room->type }}
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
                Occupation:
            </div>
            <div class="col-xs-6">
              {{ $boarder->occupation }}
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
                Contact no.:
            </div>
            <div class="col-xs-6">
              {{ $boarder->contact_no }}
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
                Agreement:
                <br>
                <img class="col-xs-12" src="{{ $boarder->getAgreementImg() }}" alt="">
            </div>
          </div>
          <hr class="my-2">
          <a href="{{route('students.edit', $boarder->id)}}" class="btn btn-sm btn-warning">Edit  <em class="fa fa-edit"></em></a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      {!! Form::open(['action' => ['PaymentsController@store', $boarder->id], 'method' => 'POST']) !!}
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
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
</script>
@endsection