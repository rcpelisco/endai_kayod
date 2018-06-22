@extends('layouts.master')

@section('title', 'Products')

@section('header', 'Buy Product')

@include('layouts.product_sidebar')

@section('content')
{{-- @include('layouts.product_alert') --}}
<div class="panel">
    <div class="panel-body">

        <h2>{{ $data->product->name }} <small>({{ $data->product->quantity }} items left )</small></h2>
        
        {!! Form::open(['action' => ['ProductsExtraController@update_quantity', $data->product->id], 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{Form::label('quantity', 'Quantity')}}
                    {{Form::text('quantity', '', ['class' => 'form-control', 'id' => 'quantity', 'placeholder' => 'Quantity'])}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{Form::label('sold_to' , 'Buyer')}}
                    {{Form::select('sold_to', $data->buyers, null, ['class' => 'form-control select-form-control'])}}
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-4 col-sm-12">
                {{Form::label('payment_method', 'Payment Method')}}
                <br>
                <label for="installment" class="radio-inline">
                    {{ Form::radio('payment_method', 'installment', true, ['id' => 'installment']) }} Installment
                </label>
                <label for="full" class="radio-inline">
                    {{ Form::radio('payment_method', 'full', false, ['id' => 'full']) }} Full
                </label>
            </div>
        </div> --}}
        <h3><small>Price: <strong>{{ $data->product->price }}</strong></small></h3>
        <h3><small>Total: <strong data-quantity="{{ $data->product->quantity}}" 
            data-price="{{ $data->product->price }}" id="total_payment">0</strong></small></h3>
        {{ Form::hidden('product_id', $data->product->id) }}
        {{ Form::hidden('type', 'buy') }}
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'id' => 'submit_btn'])}}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('scripts')
<script src="/js/moment.js"></script>
<script src="/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function() {
        $('.error_close').click(() => $(this).hide())
        $('#quantity').on('input', function() {
            let total_payment = $('#total_payment')
            let price = total_payment.attr('data-price')
            let total = $(this).val() * price
            total_payment.html(total)
            $('#submit_btn').attr('disabled', false);
            if($(this).val() > parseInt(total_payment.attr('data-quantity'))) {
                $('#submit_btn').attr('disabled', true);
            }
        })
        $('.datetimepicker').datetimepicker({
            format: 'MMMM DD, YYYY',
            useCurrent: false,
            sideBySide: true,
        });
        $('input[name="payment_method"]').change(() => {
            $('#payment-date').show()
            if($('#full').is(':checked')) {
                $('#payment-date').hide()
            }
        })
    })
</script>
@endsection