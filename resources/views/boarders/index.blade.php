@extends('layouts.master')

@section('title', 'Boarding House')

@section('header', 'Boarders')

@include('layouts.boarding_house_sidebar')

@section('create_button')
    <a href="{{route('boarders.create')}}" class="btn btn-sm btn-primary" style="margin-bottom:15px; margin-left:10px;">Add Boarder</a>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                      <th>Name</th>
                      <th>Room Occupied</th>
                      <th>Occupation</th>
                      <th>Contact No</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($boarders as $boarder)
                   <tr>
                    <td><a href="{{ route('boarders.show', $boarder->id) }}">{{ $boarder->first_name . ' ' . $boarder->last_name }}</a></td>
                    <td><a href="#">({{ $boarder->room->location }})</a> {{ $boarder->room->name }}</td>
                    <td>{{ $boarder->occupation }}</td>
                    <td>{{ $boarder->contact_no }}</td>
                    <td></td>
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