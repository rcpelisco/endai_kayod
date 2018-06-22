@extends('layouts.master')

@section('title', 'Students')

@section('header', $student->first_name . ' ' . $student->last_name)

@include('layouts.tutorial_sidebar')

@section('stylesheets')
<style>
    .hr-total {
        margin-bottom: 5px;
    }
    .hr-grand-total {
        margin-top: 5px;
    }
    .row-lessons h4 {
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .type-title {
        margin: 0 0 10px 0;
    }
</style>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    <h3>Guardian</h3>
                    {{ $student->guardian->first_name }} {{ $student->guardian->last_name }} 
                    <hr>
                    <h3>Address</h3>
                    {{ $student->guardian->address }}
                    <hr>
                    <h3>Contact no.</h3>
                    {{ $student->guardian->contact_number }}
                    <hr>
                    <button class="btn btn-warning btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </div>
                <div class="col-xs-6">
                    <h3>Subjects</h3>
                    <div class="row">
                        <div class="col-xs-6"><div class="type-title">Interests</div>
                            @foreach($student->tutorials->where('type', 'interest') as $tutorial)
                            <div class="row row-lessons">
                                <div class="col-xs-6">
                                    <h4>{{ $tutorial->title }}</h4>
                                </div>
                                <div class="col-xs-6">
                                    <div class="text-right">{{ $tutorial->price }}</div>
                                </div>
                            </div>
                            @endforeach
                            <hr class="hr-total">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h3>Total</h3>
                                </div>
                                <div class="col-xs-6">
                                <h3 class="text-right">{{ $student->tutorials->where('type', 'interest')->sum('price') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6"><div class="type-title">Academic</div>
                            @foreach($student->tutorials->where('type', 'academic') as $tutorial)
                            <div class="row row-lessons">
                                <div class="col-xs-6">
                                    <h4>{{ $tutorial->title }}</h4>
                                </div>
                                <div class="col-xs-6">
                                    <div class="text-right">{{ $tutorial->price }}</div>
                                </div>
                            </div>
                            @endforeach
                            <hr class="hr-total">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h3>Total</h3>
                                </div>
                                <div class="col-xs-6">
                                    <h3 class="text-right">{{ $student->tutorials->where('type', 'academic')->sum('price') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-grand-total">
                    <div class="row">
                        <div class="col-xs-6">
                            <h2 style="margin-top: 0px;"> Grand Total: </h2>
                        </div>
                        <div class="col-xs-6">
                            <div class="col-xs-6">
                                <h2 style="margin-top: 0px;">{{ $student->tutorials->sum('price') }}</h2> 
                            </div>
                            <div class="col-xs-6">
                                <button class="btn btn-warning">Unpaid</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection