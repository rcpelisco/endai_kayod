@extends('layouts.master')

@section('title', 'Products')

@section('header', 'Products')

@section('sidebar')
    @include('layouts.product_sidebar')
@endsection

@section('create_button')
    <a href="products/create" class="btn btn-sm btn-primary" style="margin-bottom:15px; margin-left:10px;">Add Product</a>
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
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price}}</td>
                        <td><a href="products/{{ $product->id }}/buy" class="btn btn-success btn-sm" id="buy_btn">Buy Item</a>
                            <a href="products/{{ $product->id }}/add_stock" class="btn btn-warning btn-sm" id="add_stock_btn">Add Stock</a>
                        {{-- {!! Form::open(['action' => ['ProductsController@destroy', $product->id], 'method' => 'POST']) !!}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::button('<em class="fa fa-trash"></em>', ['type' => 'submit', 'class'=>'btn btn-danger btn-sm'])}}
                    {!! Form::close() !!} --}}
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
    $(document).ready( function () {
        $('#datatable').DataTable();
    });
</script>
@endsection