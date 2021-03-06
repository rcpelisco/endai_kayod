@extends('layouts.master')

@section('title', 'Products')

@section('header', 'Add Product')

@include('layouts.product_sidebar')
    
@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <div>
            @include('layouts.product_alert')
        </div>
        {!! Form::open(['action' => 'ProductsController@store' , 'method' => 'POST']) !!}
                <div class="col-6">
                    {{Form::label('name' , 'Product name')}}
                    {{Form::text('name' , '', ['class' => 'form-control' , 'placeholder' => 'Product name'])}}
                </div>

                <div class="col-6">
                        {{Form::label('description' , 'Description')}}
                        {{Form::textarea('description' , '', ['class' => 'form-control' , 'placeholder' => 'Description'])}}
                </div>

                <div class="col-6">
                    {{Form::label('quantity' , 'Quantity')}}
                    {{Form::text('quantity' , '', ['class' => 'form-control' , 'placeholder' => 'Quantity'])}}
                </div>

            <div class="form-group">
                {{Form::label('price' , 'Price')}}
                {{Form::text('price' , '', ['class' => 'form-control' , 'placeholder' => 'Price'])}}
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