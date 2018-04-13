@extends('layouts.master')

@section('title', 'Products')

@section('header', 'Add Product')

@section('sidebar')
    @include('layouts.product_sidebar')
@endsection

@section('content')
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
@endsection  