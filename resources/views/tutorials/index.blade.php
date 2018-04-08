@extends('layouts.master')

@section('title', 'Lessons')

@section('header', 'Lessons')

@section('sidebar')
    @include('layouts.tutorial_sidebar')
@endsection

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">Username</div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        <form role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
        </form>
        <ul class="nav menu">
            <li class="active"><a href="/"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li class=" "><a href="/products"><em class="fa fa-cart-plus">&nbsp;</em> Products</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em> Tutorial <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="" href="/tutorials">
                        <span class="fa fa-arrow-right">&nbsp;</span> Lessons
                    </a></li>
    
                    <li><a class="" href="/students">
                        <span class="fa fa-arrow-right">&nbsp;</span> Students
                    </a></li>
                    <li><a class="" href="/guardians">
                        <span class="fa fa-arrow-right">&nbsp;</span> Guardians
                    </a></li>
                </ul>
            </li>
            <li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div><!--/.sidebar-->	

{{-- -------------------------- --}}
@section('create_button')
    <a href="tutorials/create" class="btn btn-sm btn-success" style="margin-bottom:15px; margin-left:10px;">Add Lesson</a>
@endsection

@section('stylesheets')
    <link href="{{ asset('data_tables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
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
<script src="{{ asset('data_tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('data_tables/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    });
</script>
@endsection