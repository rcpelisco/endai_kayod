@extends('layouts.master')

@section('title', 'Lessons')

@section('header', 'Lessons')

@include('layouts.tutorial_sidebar')

@section('create_button')
    <a href="tutorials/create" class="btn btn-sm btn-success" 
        style="margin-bottom:15px; margin-left:10px;">Add Lesson</a>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab" aria-expanded="true">Interests</a></li>
                <li class="">
                    <a href="#tab2" data-toggle="tab" aria-expanded="false" id="tab-2-link">Academics</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab1">
                    <table class="table" id="tutorialsTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>No. of Enrollees</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tutorials as $tutorial) 
                                @if($tutorial->type == 'interest')
                                    <tr>
                                        <td>{{ $tutorial->title }}</td>
                                        <td>{{ $tutorial->description }}</td>
                                        <td>{{ count($tutorial->enrolled) }}</td>
                                        <td>{{ $tutorial->price }}</td>
                                        <td>
                                            <a href="tutorials/{{ $tutorial->id }}/enroll" 
                                                class="btn btn-primary btn-sm">Enroll Student</a>
                                        </td>
                                        <td>
                                            <a href="/tutorials/{{$tutorial->id}}/edit">
                                                <button class="btn btn-sm btn-warning">
                                                    <em class="fa fa-edit"></em>
                                                </button>
                                            </a>
                                            <a href="#">
                                                <button class="btn btn-sm btn-danger">
                                                    <em class="fa fa-trash">
                                                    </em>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tab2">
                    <table class="table" id="academicsTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>No. of Enrollees</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tutorials as $tutorial) 
                                @if($tutorial->type == 'academic')
                                    <tr>
                                        <td>{{ $tutorial->title }}</td>
                                        <td>{{ $tutorial->description }}</td>
                                        <td>{{ count($tutorial->enrolled) }}</td>
                                        <td>{{ $tutorial->price }}</td>
                                        <td>
                                            <a href="tutorials/{{ $tutorial->id }}/enroll" class="btn btn-primary btn-sm">Enroll Student</a>
                                        </td>
                                        <td>
                                            <a href="#"><button class="btn btn-sm btn-warning"><em class="fa fa-edit"></em></button></a>
                                            <a href="#"><button class="btn btn-sm btn-danger"><em class="fa fa-trash"></em></button></a>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('a[data-toggle="tab"]').on('shown.bs.tab', () => {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
        })
        let academics = $('#academicsTable').DataTable({
            "columns": [
                null,
                null,
                null,
                { "width": "15%" }
            ]
        })
        let tutorials = $('#tutorialsTable').DataTable({
            "columns": [
                null,
                null,
                null,
                { "width": "15%" }
            ]
        })
    })
</script>
@endsection