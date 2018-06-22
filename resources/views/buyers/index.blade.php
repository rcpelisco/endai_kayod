@extends('layouts.master')

@section('title', 'Buyers')

@section('header', 'Buyers')

@include('layouts.product_sidebar')

@section('create_button')
    <a href="buyers/create" class="btn btn-sm btn-primary" style="margin-bottom:15px; margin-left:10px;">Add Buyer</a>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact No</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buyers as $buyer) 
                    <tr>
                        <td><a href="/buyers/{{ $buyer->id }}">{{ $buyer->name }}</a></td>
                        <td>{{ $buyer->address }}</td>
                        <td>{{ $buyer->contact_no }}</td>
                        <td>
                            {!! Form::open(['action' => ['BuyersController@destroy', $buyer->id], 'method' => 'POST']) !!}
                                <a href="/buyers/{{ $buyer->id }}/edit" class="btn btn-warning btn-sm"><em class="fa fa-edit"></em></a>
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
    $(document).ready( function () {
        $('#datatable').DataTable();
    });
</script>
@endsection