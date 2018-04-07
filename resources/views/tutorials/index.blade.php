@extends('layouts.master')

@section('title', 'Lessons')

@section('header', 'Lessons')
@section('create_button')
    <a href="tutorials/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Lesson</a>
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
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tutorials as $tutorial) 
                    <tr>
                        <td>{{ $tutorial->title }}</td>
                        <td>{{ $tutorial->description }}</td>
                        <td>{{$tutorial->type}}</td>
                        <td>{{$tutorial->price}}</td>
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