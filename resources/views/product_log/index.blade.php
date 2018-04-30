@extends('layouts.master')

@section('title', 'Logs')

@section('header', 'Product logs')

@section('sidebar')
    @include('layouts.product_sidebar')
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Product name</th>
                        <th>Quantity</th>
                        <th>sold by</th>
                        <th>Total</th>
                        <th>Transaction</th>
                        <th>Sold date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product_logs as $product_log)
                    <tr>
                            <td>{{ $product_log->product->name }}</td>
                            <td>{{ $product_log->quantity }}</td>
                            <td>{{ $product_log->user->name }}</td>
                            <td>{{ $product_log->total_sold }}</td>
                            <td>{{ $product_log->type }}</td>
                            <td>{{ $product_log->created_at }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready( function () {
                $('#datatable').DataTable();
            });
        </script>
    @endsection
@endsection
