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
</style>
@endsection

@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-6">
        <h3 class="display-inline-block">Type</h3>
        <h4 class="pull-right display-inline-block">
          {{ $room->type }}
        </h4>
        <hr class="my-2">
        <h3 class="display-inline-block">Location</h3>
        <h4 class="pull-right display-inline-block">
          {{ $room->location }}
        </h4>
        <hr class="my-2">
        <h3 class="display-inline-block">Price</h3>
        <h4 class="pull-right display-inline-block">
          {{ $room->price }}
        </h4>
        <hr class="my-2">
        {!! Form::open(['action' => ['BoardingHouseController@destroy', $room->id], 'method' => 'POST']) !!}
          <a href="{{route('boarding_house.edit', $room->id)}}" class="btn btn-sm btn-warning">Edit  <em class="fa fa-edit"></em></a>
          {{ Form::hidden('_method', 'DELETE') }}
          {{ Form::button('<em class="fa fa-trash"></em>', ['type' => 'submit', 'class'=>'btn btn-danger btn-sm'])}}
        {!! Form::close() !!}
      </div>
      <div class="col-xs-6">
        @if($room->type == 'monthly')
          <h3>In Charge</h3>
        @else
          <h3>Boarders</h3>
        @endif
        <hr class="my-2">
        @foreach($room->boarders->where('active', 1) as $boarder) 
          {{ $boarder->first_name . ' ' . $boarder->last_name }}
          <hr class="my-0">
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
</script>
@endsection