@extends('layouts.master')

@section('title', 'Students')

@section('header', 'Students')

@include('layouts.tutorial_sidebar')

@section('create_button')
    <a href="/students/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Student</a>
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
                        <td>

                            {!! Form::open(['action' => ['StudentsController@destroy', $student->id], 'method' => 'POST']) !!}
                                <a href="/students/{{$student->id}}/edit" class="btn btn-sm btn-warning"><em class="fa fa-edit"></em></a>
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::button('<em class="fa fa-trash"></em>', ['type' => 'submit', 'class'=>'btn btn-danger btn-sm'])}}
                            {!! Form::close() !!}
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