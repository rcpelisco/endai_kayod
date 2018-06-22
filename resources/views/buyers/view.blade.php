@extends('layouts.master')

{{-- Whoo Kabibo --}}

section('title', 'Buyers')

@section('header', 'Buyer')


    @include('layouts.product_sidebar')
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <h3>{{ $buyer->name }} | <small>{{ $buyer->address }}</small> | <small>{{ $buyer->contact_no }}</small></h3>
        <hr>
        <div class="row">
            <div class="col-md-6 border-right">
                <h4>Products Bought</h4>
                @foreach($buyer->products_bought as $product)
                <div class="row border-bottom">
                    <div class="col-xs-3">{{ $product->name }}</div>
                    <div class="col-xs-3">{{ $product->total_bought }} <small>pcs</small></div>
                    <div class="col-xs-3"><small>Php</small> {{ $product->price }} </div>
                    <div class="col-xs-3"><small>Total</small> {{ $product->total_bought * $product->price }}</div>
                </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <div>
                    <h4>Unpaid Products <small><button class="btn btn-sm btn-warning" style="">Pay this</button></small></h4>
                </div>
                <div class="col-xs-4">Shingshangfu</div>
                <div class="col-xs-4">5pcs</div>
                <div class="col-xs-4">2000php</div>
                <hr>
                <div class="col-xs-8">
                    <h4>total</h4>
                </div>
                <div class="col-xs-4">
                    <h4>12000</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(() => {
        let sessions_group = $('#sessions_group')
        $('#type').change(() => {
            let selected = $('#type option:selected').val()
            sessions_group.show()
            if(selected == 'academic') {
                sessions_group.hide()
            }
        })
    })
</script>
@endsection