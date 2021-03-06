@extends('layouts.master')

@section('title', 'Students')

@section('header', 'Create Student')

@include('layouts.tutorial_sidebar')

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
            <div>
               @include('layouts.student_alert') 
            </div>
            {!! Form::open(['action' => 'StudentsController@store' , 'method' => 'POST']) !!}
                <div class="row">
                    <div class="col-xs-6">
                        {{Form::label('first_name' , 'First name')}}
                        {{Form::text('first_name' , '', ['class' => 'form-control' , 'placeholder' => 'First name'])}}
                    </div>
                    
                    <div class="col-xs-6">
                        {{Form::label('last_name' , 'Last name')}}
                        {{Form::text('last_name' , '', ['class' => 'form-control' , 'placeholder' => 'Last name'])}}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        {{Form::label('date_of_birth' , 'Date of Birth')}}
                        {{Form::date('date_of_birth' , '', ['class' => 'form-control' , 'placeholder' => 'Date of Birth'])}}
                    </div>
                    <div class="col-xs-6">
                        {{Form::label('gender', 'Gender')}}
                        {{Form::select('gender', [
                            'male' => 'Male',
                            'female' => 'Female',
                        ], null, ['class' => 'form-control select-form-control'])}}
                    </div>
                </div>    
                <div class="form-group">
                    {{Form::label('guardian_id' , 'Guardian')}}
                    {{Form::select('guardian_id', $guardians, null, ['class' => 'form-control select-form-control'])}}
                </div>
                <a href="/guardians/create?ref=students" class="btn btn-sm btn-success pull-right">Add Guardian</a>
            {{ Form::submit('Submit' , ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(() => $('.error_close').click(() => $(this).hide()))
</script>
@endsection