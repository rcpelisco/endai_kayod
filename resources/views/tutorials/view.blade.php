@extends('layouts.master')

@section('title', 'Students')

@section('header', $tutorial->title)

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
                    <h3>Description</h3>
                    {{ $tutorial->description}}
                    <hr>
                    <h3>Type</h3>
                    {{ $tutorial->type }}
                    <hr>
                    <h3>Price</h3>
                    {{ $tutorial->price }}
                    <hr>
                </div>
                <div class="col-xs-6">
                    <h3>Students<small></small></h3>
                    <div class="row">
                        <div class="col-xs-6"><small>Name</small></div>
                        <div class="col-xs-3"><small class=" pull-right">Sessions Left</small></div>
                        <div class="col-xs-3"></div>
                    </div>
                    <hr style="margin-top: 5px; margin-bottom: 10px;">
                    <div class="row">
                        @foreach($tutorial->students as $student)
                        <div class="col-xs-6">
                            {{ $student->first_name }} {{ $student->last_name }}
                        </div>
                        <div class="col-xs-3">
                            <div class="pull-right">
                                {{ $student->enrolled->where('tutorial_id', $tutorial->id)->first()->sessions_left }}
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <button class="btn btn-xs btn-primary deductModalButton {{ $student->enrolled->where('tutorial_id', $tutorial->id)->first()->sessions_left > 0 ? '' : 'disabled' }}" 
                                data-enrolled-id="{{ $student->enrolled->where('tutorial_id', $tutorial->id)->first()->id }}">
                                Deduct Session</button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deductSessionsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            {!! Form::open(['action' => 'TutorialsExtraController@deduct_session' , 'method' => 'POST']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Sessions Left</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {{Form::label('amount', 'Amount')}}
                            {{Form::text('amount', '', ['class' => 'form-control', 'placeholder' => 'Amount', 'autocomplete' => 'off'])}}
                        </div>
                    </div>
                    {{Form::hidden('enrolled_id')}}
                    {{Form::hidden('sessions_left')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{ Form::submit('Deduct', ['class' => 'btn btn-primary', 'id' => 'submit_deduction']) }}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
<script>
$(() => {
    let current_sessions_left = 0;
    let amount = 0;

    $('.deductModalButton').click(function() {
        if(($(this).hasClass('disabled')))
            return
        get_tutorial_info($(this).attr('data-enrolled-id'))
        $('#deductSessionsModal').modal()
    })

    $('form').submit(function(e) {
        if(amount > current_sessions_left) {
            e.preventDefault()
        }
    })

    $('input[name="amount"]').on('input', function() {
        amount = parseInt($(this).val())
        current_sessions_left = parseInt($('input[name="sessions_left"]').val())
        
        if(amount > current_sessions_left) {
            $('#submit_deduction').addClass('disabled')
            return
        }

        $('#submit_deduction').removeClass('disabled')
    })

    function get_tutorial_info(enrolledID) {
        $.ajax({
            type:'GET',
            url:'/students/get_tutorial/' + enrolledID,
            data:'_token = <?php echo csrf_token() ?>',
            success: (data) => {
                console.log(data)
                $('input[name="enrolled_id"]').val(data.id)
                $('input[name="sessions_left"]').val(data.sessions_left)
                
            }
        })
    }
    
})
</script>
@endsection