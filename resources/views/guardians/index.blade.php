@extends('layouts.master')

@section('title', 'Guardians')

@section('header', 'Guardians')

@include('layouts.tutorial_sidebar')
    
@section('create_button')
    <a href="guardians/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Guardian</a>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guardians as $guardian)
                    <tr>
                        <td>{{ $guardian->first_name }}</td>
                        <td>{{ $guardian->last_name }}</td>
                        <td>{{ $guardian->contact_number }}</td>
                        <td>{{ $guardian->address }}</td>
                        <td><a href="/guardians/{{$guardian->id}}/edit"><button class="btn btn-sm btn-warning"><em class="fa fa-edit"></em></button></a></td>
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
        $('#datatable').DataTable()
    });
</script>
@endsection