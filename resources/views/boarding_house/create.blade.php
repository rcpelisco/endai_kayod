@extends('layouts.master')

@section('title', 'Boarding House')

@section('header', 'Add Room')

@include('layouts.boarding_house_sidebar')

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <div>
            @include('layouts.product_alert')
        </div>
        {!! Form::open(['action' => 'BoardingHouseController@store' , 'method' => 'POST']) !!}
            <div class="col-6">
                <div class="form-group">
                    {{Form::label('name' , 'Room name')}}
                    {{Form::text('name' , '', ['class' => 'form-control' , 'placeholder' => 'Room name'])}}
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    {{Form::label('max_cap' , 'Maximum Capacity')}}
                    {{Form::number('max_cap' , '', ['class' => 'form-control' , 'placeholder' => 'Maximum Capacity'])}}
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    {{Form::label('type' , 'Type')}}
                    {{Form::select('type' , ['trancient' => 'Trancient', 'monthly' => 'Monthly'], null, ['class' => 'form-control select-form-control'])}}
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    {{Form::label('location' , 'Location')}}
                    {{Form::select('location' , ['magallanes' => 'Magallanes', 'nTown' => 'North Town Subd.', 'jHomes' => 'Josephine Homes'], null, ['class' => 'form-control select-form-control'])}}
                </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                  {{Form::label('price' , 'Price')}}
                  {{Form::number('price' , '', ['class' => 'form-control' , 'placeholder' => 'Price'])}}
              </div>
            </div>
            {{ Form::submit('Submit' , ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(() => $('.error_close').click(() => $(this).hide()))
</script>
@endsection