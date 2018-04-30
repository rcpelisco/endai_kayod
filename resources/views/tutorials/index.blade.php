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
        <div class="panel-body tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Interests</a></li>
                <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false">Academics</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab1">
                    <table class="table" id="tutorialsTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
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
                                        <td>{{ $tutorial->price }}</td>
                                        <td>
                                            <a href="tutorials/{{ $tutorial->id }}/enroll" class="btn btn-primary btn-sm">Enroll Student</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tab2">
                    <table class="table" id="academicsTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
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
                                        <td>{{ $tutorial->price }}</td>
                                        <td>
                                            <a href="tutorials/{{ $tutorial->id }}/enroll" class="btn btn-primary btn-sm">Enroll Student</a>
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
        $('#tutorialsTable').DataTable()
        $('#academicsTable').DataTable()
    })
</script>
@endsection