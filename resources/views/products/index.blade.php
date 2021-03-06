@extends('layouts.master')

@section('title', 'Products')

@section('header', 'Products')

@include('layouts.product_sidebar')

@section('create_button')
    <a href="{{route('products.create')}}" class="btn btn-sm btn-primary" style="margin-bottom:15px; margin-left:10px;">Add Product</a>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Product name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product) 
                        @php
                            if($product->quantity <= 50 && $product->quantity > 10) {
                                echo '<tr class="warning">';
                            } else if($product->quantity <= 10 && $product->quantity > 0) {
                                echo '<tr class="danger">';
                            } else if($product->quantity == 0) {
                                echo '<tr class="active">';
                            } else {
                                echo '<tr>';
                            }
                        @endphp
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            {!! Form::open(['action' => ['ProductsController@destroy', $product->id], 'method' => 'POST']) !!}

                                <a href="{{route('products.buy', ['product' => $product->id])}}" class="btn btn-success btn-sm fa fa-shopping-cart {{ $product->quantity == 0 ? 'disabled' : '' }}" id="buy_btn"></a>
                                <a href="{{route('products.add_stock', ['product' => $product->id])}}" class="btn btn-primary btn-sm fa fa-plus" id="add_stock_btn"></a>
                                <a href="{{route('products.edit', ['product' => $product->id])}}" class="btn btn-sm btn-warning fa fa-edit"></a>
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::button('<em class="fa fa-trash"></em>', ['type' => 'submit', 'class'=>'btn btn-danger btn-sm'])}}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(() => {
        $('#datatable').DataTable({
            'columnDefs': [{
                'targets': 1,
                'render': (data, type, row) => {
                    return data.length > 70 ?
                        data.substr(0, 70) +'…' :
                        data;
                }
            }]
        })
    })
</script>

@endsection