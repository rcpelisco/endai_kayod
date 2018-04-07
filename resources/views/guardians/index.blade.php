@extends('layouts.master')

@section('title', 'Guardians')

@section('header', 'Guardians')
@section('create_button')
    <a href="guardians/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Guardian</a>
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
                        <th>Contact no.</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guardians as $guardian)
                    <tr>
                        <td>{{ $guardian->first_name }}</td>
                        <td>{{ $guardian->last_name }}</td>
                        <td>{{ $guardian->contact_number }}</td>
                        <td>{{ $guardian->address }}</td>
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