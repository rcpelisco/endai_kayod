@extends('layouts.master')

@section('title', 'Students')

@section('header', 'Students')

@section('sidebar')
    @include('layouts.tutorial_sidebar')
@endsection

@section('create_button')
    <a href="students/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Student</a>
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
                        <th>Enrolled in</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student) 
                    <tr>
                        <td><a href="/students/{{ $student->id }}">{{ $student->first_name }}</a></td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->guardian->first_name }} {{ $student->guardian->last_name }}</td>
                        <td style="background-color:azurex;">
                            Interest ({{ $student->interest_count }}) -
                            Academic ({{ $student->academic_count }})
                        </td>
                        <td><a href="/students/{{$student->id}}/edit" class="btn btn-sm btn-danger"><em class="fa fa-trash"></em></a></td>
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
        $('#datatable').DataTable({
            "columns": [
                null,
                null,
                null,
                null,
                { "width": "10%" }
            ]
        });
    });
</script>
@endsection