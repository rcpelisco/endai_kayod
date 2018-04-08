@extends('layouts.master')

@section('title', 'Products')

@section('header', 'Products')

@section('sidebar')
    @include('layouts.product_sidebar')
@endsection

@section('create_button')
    <a href="products/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Product</a>
@endsection

@section('stylesheets')
    <link href="{{ asset('data_tables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Product name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product) 
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price}}</td>
                        <td><a href="products/{{ $product->id }}/buy" class="btn btn-primary btn-sm">Buy Item</a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('data_tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('data_tables/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    });
</script>
@endsection