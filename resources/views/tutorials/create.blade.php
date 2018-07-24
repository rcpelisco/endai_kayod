@extends('layouts.master')

@section('title', 'Lesson')

@section('header', 'Add Lesson')

@include('layouts.tutorial_sidebar')

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <div>
            @include('layouts.tutorial_alert')
        </div>
        {!! Form::open(['action' => 'TutorialsController@store', 'method' => 'POST']) !!}
            <div class="col-6">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
            
            <div class="col-6">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
            </div>
    
            <div class="form-group">
                {{Form::label('price', 'Price')}}
                {{Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'Price'])}}
            </div>
            <div class="form-group">
                <label for="interest" class="radio-inline">
                    {{ Form::radio('type', 'interest', true, ['id' => 'interest']) }}  Interest
                </label>
                <label for="academic" class="radio-inline">
                    {{ Form::radio('type', 'academic', false, ['id' => 'academic']) }} Academic
                </label>
            </div>

            <div class="form-group" id="sessions_group">
                {{Form::label('sessions', 'Sessions:')}}
                {{Form::text('sessions',  '', ['class' => 'form-control', 'placeholder' => 'Sessions'])}}
            </div>
    
            {{ Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('scriptu')
<script>
    $(function() {
        $('input[name="type"]').change(function() {
        $('#sessions_group').show()
            if ($(this).val() == 'academic'){
                $('#sessions_group').hide()
            }
        })
    })
</script>
@endsection