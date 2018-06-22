@extends('layouts.master')

@section('title', 'Buyers')

@section('header', 'Add Buyer')

@include('layouts.product_sidebar')

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <div>
            @include('layouts.product_alert')
        </div>
        {!! Form::open(['action' => ['BuyersController@update', $buyers->id ], 'method' => 'POST']) !!}
            <div class="col-6">
                <div class="form-group">
                    {{Form::label('name' , 'Buyer name')}}
                    {{Form::text('name' , $buyers->name, ['class' => 'form-control' , 'placeholder' => 'Product name'])}}
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    {{Form::label('address' , 'Address')}}
                    {{Form::text('address' , $buyers->address, ['class' => 'form-control' , 'placeholder' => 'Address'])}}
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    {{Form::label('contact_no' , 'Contact no')}}
                    {{Form::text('contact_no' , $buyers->contact_no, ['class' => 'form-control' , 'placeholder' => 'Contact no'])}}
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