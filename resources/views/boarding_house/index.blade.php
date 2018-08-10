@extends('layouts.master')

@section('title', 'Boarding House')

@section('header', 'Rooms')

@include('layouts.boarding_house_sidebar')

@section('create_button')
    <a href="{{route('boarding_house.create')}}" class="btn btn-sm btn-primary" 
        style="margin-bottom:15px; margin-left:10px;">Add Room</a>
@endsection

@section('stylesheets')
<style>
  img {
    width: 250px;
  }
</style>
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-body tabs">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab1" data-toggle="tab" aria-expanded="true">Magallanes</a></li>
            <li class="">
                <a href="#tab2" data-toggle="tab" aria-expanded="false" id="tab-2-link">North Town Subd.</a></li>
            <li class="">
                <a href="#tab3" data-toggle="tab" aria-expanded="false" id="tab-3-link">Josephine Homes</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab1">
                <table class="table" id="magallanesTable">
                    <thead>
                        <tr>
                          <th>Room Name</th>
                          <th>Maximum Capacity</th>
                          <th>Type</th>
                          <th>Price</th>
                          <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms->where('location', 'magallanes') as $room)
                        <tr>
                          <td><a href="{{ route('boarding_house.show', $room->id) }}">{{ $room->name }}</a></td>
                          <td>@php if($room->boarders->where('active', 1)->count() > 0) {echo $room->type == 'trancient' 
                            ? $room->boarders->count() . '/' . $room->max_cap 
                            : '<a href="' . route('boarders.show', $room->boarders->last()->id) . '">' 
                              . $room->boarders->where('active', 1)->first()->first_name 
                              . ' ' . $room->boarders->where('active', 1)->first()->last_name
                              . '</a>';}
                          @endphp</td>
                          <td>{{ $room->type }}</td>
                          <td>{{ $room->price }}</td>
                          <td>
                            <button data-roomID="{{ $room->id }}" class="btn btn-primary btn-xs addBorderButton">
                              Add Boarder
                            </button>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="tab2">
                <table class="table" id="nTownTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Maximum Capacity</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($rooms->where('location', 'nTown') as $room)
                      <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->max_cap }}</td>
                        <td>{{ $room->type }}</td>
                        <td>{{ $room->price }}</td>
                        <td></td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="tab3">
                <table class="table" id="jHomesTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Maximum Capacity</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($rooms->where('location', 'jHomes') as $room)
                        <tr>
                          <td>{{ $room->name }}</td>
                          <td>{{ $room->max_cap }}</td>
                          <td>{{ $room->type }}</td>
                          <td>{{ $room->price }}</td>
                          <td></td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addBoarderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="boarding_house/{room}/create_boarder" method="POST" id="createBoarderForm" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Border</h4>
        </div>
        {{ csrf_field() }}
        <div class="modal-body">
            <div class="form-group">
                {{Form::label('first_name' , 'First name')}}
                {{Form::text('first_name' , '', ['class' => 'form-control' , 'placeholder' => 'First name'])}}
            </div>

            <div class="form-group">
                {{Form::label('last_name' , 'Last name')}}
                {{Form::text('last_name' , '', ['class' => 'form-control' , 'placeholder' => 'Last name'])}}
            </div>

            <div class="form-group">
                {{Form::label('occupation' , 'Occupation')}}
                {{Form::text('occupation' , '', ['class' => 'form-control' , 'placeholder' => 'Occupation'])}}
            </div>

            <div class="form-group">
                {{Form::label('contact_no' , 'Contact No.')}}
                {{Form::text('contact_no' , '', ['class' => 'form-control' , 'placeholder' => 'Contact No.'])}}
            </div>

            <div class="form-group">
                {{ Form::label('agreement' , 'Agreement') }}
                {{ Form::file('agreement', ['class' => 'form-control-file', 
                      'id' => 'logo_input', 'onchange' => 'handleFiles(this.files)',
                      'accept' => 'image/*']) }}
            </div>
            <div class="form-group">
              <img src="#" alt="" id="agreement">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
    function handleFiles(file) {
      let reader = new FileReader();
      reader.readAsDataURL(file[0])
      reader.onload = function(e) {
        $('#agreement').attr('src', e.target.result)
      }
    }

    $(function() {
      let magallanes = $('#magallanesTable').DataTable()
      let nTown = $('#nTownTable').DataTable()
      let jHomes = $('#jHomesTable').DataTable()
      $('.addBorderButton').click(function() {
        let roomID = $(this).attr('data-roomID');
        console.log(roomID);
        $('#createBoarderForm').attr('action', 'boarding_house/' + roomID + '/create_boarder')
        $('#addBoarderModal').modal();
      })
    })
</script>
@endsection