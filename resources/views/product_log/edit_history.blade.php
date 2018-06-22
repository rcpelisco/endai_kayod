@extends('layouts.master')

@section('title', 'Logs')

@section('header', 'Edit History')

@include('layouts.product_sidebar')

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
                        <th>Liable</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($edit_history as $entry)
                    <tr>
                            <td>{{ $entry->product_name }}</td>
                            <td>{{ $entry->description }}</td>
                            <td>{{ $entry->quantity }}</td>
                            <td>{{ $entry->price }}</td>
                            <td>{{ $entry->user->name }}</td>
                            <td>{{ date('F d, Y H:i A', strtotime($entry->created_at)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready( function () {
                $('#datatable').DataTable({
                    'ordering': false,
                    "columns": [
                        null,
                        { "width": "30%" },
                        null,
                        null,
                        null,
                        null
                    ]
                });
            });
        </script>
    @endsection
@endsection
