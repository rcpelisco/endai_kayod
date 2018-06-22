@extends('layouts.master')

@section('title', 'Students')

@section('header', 'Enroll student')


    @include('layouts.tutorial_sidebar')
@endsection

@section('create_button')
    <a href="/students/create?tutorial_id=1" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Student</a>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->guardian->first_name }} {{ $student->guardian->last_name }}</td>
                        <td><button class="btn btn-success btn-sm">Enroll</button></td>
                        
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