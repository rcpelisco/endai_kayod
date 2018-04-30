@extends('layouts.master')

@section('title', 'Lessons')

@section('header', $data->tutorial->title)

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
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->students as $student)
                    <tr>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        @if($student->enrolled)
                        <td><button class="btn btn-primary btn-sm" disabled>Enrolled</button>
                            <button class="btn btn-danger btn-sm">Drop</button></td>
                        @else
                        <td>
                            {!! Form::open(['action' => 'EnrolledController@store' , 'method' => 'POST']) !!}
                            {{ Form::hidden('student_id', $student->id) }}
                            {{ Form::hidden('tutorial_id', $data->tutorial->id) }}
                            {{ Form::submit('Enroll', ['class' => 'btn btn-primary btn-sm enroll-btn']) }}
                            {!! Form::close() !!}
                        </td>
                        @endif
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('#datatable').DataTable()
    });
</script>
@endsection