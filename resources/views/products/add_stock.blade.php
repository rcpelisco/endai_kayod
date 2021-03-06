@extends('layouts.master')

@section('title', 'Products')

@section('header', 'Add Stock')

@include('layouts.product_sidebar')

@section('content')

@include('layouts.product_alert')
<div>
    <h2>{{ $product->name }}</h2>
    
    {!! Form::open(['action' => ['ProductsExtraController@update_quantity', $product->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('quantity', 'How Many items to add')}}
        {{Form::text('quantity', '', ['class' => 'form-control', 'id' => 'quantity', 'placeholder' => 'Quantity'])}}
    </div>
    
    {{ Form::hidden('product_id', '$product->id') }}
    {{ Form::hidden('type', 'add_stock') }}
    {{ Form::hidden('_method', 'PUT') }}
    {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'id' => 'submit_btn'])}}
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('.error_close').click(() => $(this).hide())
        $('#quantity').on('input', function() {
            let total_payment = $('#total_payment')
            let price = total_payment.attr('data-price')
            let total = $(this).val() * price
            console.log(total)
            total_payment.html(total)
            $('#submit_btn').attr('disabled', false);
            if($(this).val() > total_payment.attr('data-quantity')) {
                $('#submit_btn').attr('disabled', true);
            }
        })
    })
</script>
@endsection