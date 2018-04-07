@extends('layouts.master')

@section('title', 'Students')

@section('header', 'Students')

@section('create_button')
    <a href="students/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Student</a>
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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Guardian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student) 
                    <tr>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->guardian->first_name }} {{ $student->guardian->last_name }}</td>
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