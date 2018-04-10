@extends('layouts.master')

@section('title', 'Lessons')

@section('header', 'Lessons')

@section('sidebar')
    @include('layouts.tutorial_sidebar')
@endsection

@section('create_button')
    <a href="tutorials/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Lesson</a>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tutorials as $tutorial) 
                    <tr>
                        <td>{{ $tutorial->title }}</td>
                        <td>{{ $tutorial->description }}</td>
                        <td class="text-capitalize">{{ $tutorial->type }}</td>
                        <td>{{ $tutorial->price }}</td>
                        <td>
                            <a href="enrolled\{{ $tutorial->id }}" class="btn btn-primary btn-sm">Enroll Student</a>
                            <a href="enrolled\{{ $tutorial->id }}" class="btn btn-info btn-sm">View Enrolled</a>
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