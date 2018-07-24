@extends('layouts.master')

@section('title', 'Lessons')

@section('header', 'Lessons')

@include('layouts.tutorial_sidebar')

@section('create_button')
    <a href="{{route('tutorials.create')}}" class="btn btn-sm btn-success" 
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tutorials as $tutorial) 
                                @if($tutorial->type == 'interest')
                                    <tr>
                                        <td><a href="{{route('tutorials.show', ['tutorial' => $tutorial->id])}}">{{ $tutorial->title }}</a></td>
                                        <td>{{ $tutorial->description }}</td>
                                        <td>{{ count($tutorial->enrolled->where('active', 1)) }}</td>
                                        <td>{{ $tutorial->price }}</td>
                                        <td>
                                            <a href="{{route('tutorials.enroll', ['tutorial' => $tutorial->id])}}" 
                                                class="btn btn-primary btn-sm">Enroll Student</a>
                                        </td>
                                        <td>
                                            {!! Form::open(['action' => ['TutorialsController@destroy', $tutorial->id], 'method' => 'POST']) !!}
                                                <a href="{{route('tutorials.edit', ['tutorial' => $tutorial->id])}}" class="btn btn-sm btn-warning"><em class="fa fa-edit"></em></a>
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::button('<em class="fa fa-trash"></em>', ['type' => 'submit', 'class'=>'btn btn-danger btn-sm'])}}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tab2">
                    <table class="table" id="academicsTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>No. of Enrollees</th>
                                <th>Price</th>
                                <th>Actions</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tutorials as $tutorial) 
                                @if($tutorial->type == 'academic')
                                    <tr>
                                        <td>{{ $tutorial->title }}</td>
                                        <td>{{ $tutorial->description }}</td>
                                        <td>{{ count($tutorial->enrolled->where('active', 1)) }}</td>
                                        <td>{{ $tutorial->price }}</td>
                                        <td>
                                            <a href="{{route('tutorials.enroll', ['tutorial' => $tutorial->id])}}" class="btn btn-primary btn-sm">Enroll Student</a>
                                        </td>
                                        <td>
                                            {!! Form::open(['action' => ['TutorialsController@destroy', $tutorial->id], 'method' => 'POST']) !!}
                                                <a href="{{route('tutorials.edit', ['tutorial' => $tutorial->id])}}" class="btn btn-sm btn-warning"><em class="fa fa-edit"></em></a>
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::button('<em class="fa fa-trash"></em>', ['type' => 'submit', 'class'=>'btn btn-danger btn-sm'])}}
                                            {!! Form::close() !!}
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
        // $('a[data-toggle="tab"]').on('shown.bs.tab', () => {
        //     $($.fn.dataTable.tables(true)).DataTable()
        //         .columns.adjust()
        // })
    
        let tutorials = $('#tutorialsTable').DataTable({
            "columns": [
                null,
                null,
                { "width": "15%" },
                { "width": "10%" },
                null,
                null
            ]
        })
        let academics = $('#academicsTable').DataTable({
            "columns": [
                null,
                null,
                { "width": "15%" },
                { "width": "10%" },
                null,
                null
            ]
        })
    })
</script>
@endsection