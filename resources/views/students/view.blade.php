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

                    {!! Form::open(['action' => ['StudentsController@destroy', $student->id], 'method' => 'POST']) !!}
                        <a href="{{route('students.edit', ['student' => $student->id])}}" class="btn btn-sm btn-warning">Edit  <em class="fa fa-edit"></em></a>
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::button('<em class="fa fa-trash"></em>', ['type' => 'submit', 'class'=>'btn btn-danger btn-sm'])}}
                    {!! Form::close() !!}
                    {{-- <button class="btn btn-warning btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button> --}}
                </div>
                <div class="col-xs-6">
                    <h3>Payments<small></small></h3>
                    <div class="row">
                        <div class="col-xs-12">
                            @foreach($student->tutorials->where('active', 1) as $tutorial)
                            <div class="row row-lessons">
                                <div class="col-xs-7">
                                    <h4>
                                        <a href="#" class="recordsModalButton" data-enrolled-id="{{ $tutorial->enrolled_id }}">
                                        @php
                                        echo $student->enrolled_logs
                                            ->where('enrolled_id', $tutorial->enrolled_id)
                                            ->where('transaction_type', 'credit')->sum('amount') <=
                                            $student->enrolled_logs
                                                ->where('enrolled_id', $tutorial->enrolled_id)
                                                ->where('transaction_type', 'pay')->sum('amount')?
                                            '<s>' . $tutorial->title .'</s>'
                                            : $tutorial->title
                                        @endphp
                                        </a>
                                        <small>({{ $tutorial->type }})</small>
                                    </h4>
                                </div>
                                <div class="col-xs-5">
                                    {!! Form::open(['action' => 'TutorialsExtraController@drop' , 'method' => 'POST']) !!}
                                    <div class="text-right">{{ $tutorial->credit }} <small>
                                        ({{ $student->enrolled_logs
                                            ->where('enrolled_id', $tutorial->enrolled_id)
                                            ->where('transaction_type', 'credit')->sum('amount') - 
                                            $student->enrolled_logs
                                                ->where('enrolled_id', $tutorial->enrolled_id)
                                                ->where('transaction_type', 'pay')->sum('amount') }})</small>
                                        
                                        {{ Form::hidden('student_id', $student->id) }}
                                        {{ Form::hidden('tutorial_id', $tutorial->id) }}
                                        @php
                                            echo $student->enrolled_logs
                                            ->where('enrolled_id', $tutorial->enrolled_id)
                                            ->where('transaction_type', 'credit')->sum('amount') <=
                                            $student->enrolled_logs
                                                ->where('enrolled_id', $tutorial->enrolled_id)
                                                ->where('transaction_type', 'pay')->sum('amount') ? 
                                                '<a href="" class="btn btn-xs btn-primary disabled">Paid</a>'
                                                : '<a href="#" class="btn btn-xs btn-primary payModalButton" data-enrolled-id="'. $tutorial->enrolled_id .'">Pay</a>'
                                        @endphp
                                        {{ Form::submit('Drop', ['class' => 'btn btn-danger btn-xs']) }}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            @endforeach
                            <hr class="hr-total">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h3>Total</h3>
                                </div>
                                <div class="col-xs-6">
                                <h3 class="text-right">{{ $student->tutorials->where('active', 1)->sum('price')}}
                                    <small>
                                        ({{ $student->enrolled_logs
                                            ->where('transaction_type', 'credit')->sum('amount') - 
                                            $student->enrolled_logs
                                                ->where('transaction_type', 'pay')->sum('amount')}})
                                    </small>
                                </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            {!! Form::open(['action' => 'StudentExtraController@pay_tutorial' , 'method' => 'POST']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {{Form::label('amount', 'Amount')}}
                            {{Form::text('amount', '', ['class' => 'form-control', 'placeholder' => 'Amount', 'autocomplete' => 'off'])}}
                        </div>
                    </div>
                    {{Form::hidden('enrolled_id')}}
                    {{Form::hidden('credit')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{ Form::submit('Pay', ['class' => 'btn btn-primary', 'id' => 'submit_pay']) }}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="modal fade" id="recordsModal" tabindex="-2" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6">Enroll Date</div>
                        <div class="col-xs-6">Due Date</div>
                    </div>
                    <hr style="margin-bottom: 10px; margin-top: 0px">
                    <div id="dates">
                    </div>
                    <hr style="margin-bottom: 10px; margin-top: 20px">
                    <div class="row">
                        <div class="col-xs-12">Payments</div>
                    </div>
                    <hr style="margin-bottom: 10px; margin-top: 0px">
                    <div id="payments">
                    </div>
                    <hr style="margin-bottom: 0px;">
                    <div class="row">
                        <div class="col-xs-6"><h2 style="margin-bottom: 0px;">Bayronon</h2></div>
                        <div class="col-xs-6"><h2 style="margin-bottom: 0px;" id="total">12000</h2></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="" class="btn btn-primary" id="reEnrollButton">Re-enroll</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let amount = undefined
    let credit = undefined

    $('.payModalButton').click(function() {
        let enrolledID = $(this).attr('data-enrolled-id')
        get_tutorial_info(enrolledID)
        $('#payModal').modal()
    })

    $('.recordsModalButton').click(function() {
        let enrolledID = $(this).attr('data-enrolled-id')
        get_tutorial_due(enrolledID)
        $('#recordsModal').modal()
    })

    $('form').submit(function(e) {
        if(amount > credit) {
            e.preventDefault()
        }
    })

    $('input[name="amount"]').on('input', function() {
        amount = parseInt($(this).val())
        credit = parseInt($('input[name="credit"]').val())
        
        if(amount > credit) {
            $('#submit_pay').addClass('disabled')
            return
        }

        $('#submit_pay').removeClass('disabled')
    }) 

    function get_tutorial_info(enrolledID) {
        $.ajax({
            type:'GET',
            url:'get_tutorial/' + enrolledID,
            data:'_token = <?php echo csrf_token() ?>',
            success: (data) => {
                console.log(data)
                $('#date').html();
                $('.modal-title').html(data.tutorial.title)
                $('input[name="enrolled_id"]').val(data.id)
                $('input[name="credit"]').val(data.credit)
                
            }
        })
    }
    
    function get_tutorial_due(enrolledID) {
        $.ajax({
            type:'GET',
            url:'get_tutorial_due/' + enrolledID,
            data:'_token = <?php echo csrf_token() ?>',
            success: (data) => {
                $('.modal-title').html(data.tutorial.title)
                $('input[name="enrolled_id"]').val(data.id)
                $('input[name="credit"]').val(data.credit)
                $('#enrollDate').html(data.formattedEnrollDate)
                $('#dueDate').html(data.formattedDueDate)
                $('#total').html(data.totalDue - data.totalPaid)
                let payments = ''
                let dates = ''
                data.enrolled_logs.forEach(element => {
                    if(element.transaction_type == 'pay') {
                        payments += '<div class="row"><div class="col-xs-6">' + element.formattedPayDate + '</div>'
                            +'<div class="col-xs-6">' + element.amount + '</div></div>'
                        return
                    }
                    dates += '<div class="row"><div class="col-xs-6">' + element.formattedEnrollDate + '</div>'
                        + '<div class="col-xs-6' 
                    if(element.paid == true) {
                        dates += ' text-primary'
                    }
                    dates += '">' + element.formattedDueDate +  '</div></div>'
                })
                $('#payments').html(payments)
                $('#dates').html(dates);
                $('#reEnrollButton').attr('href', 're_enroll/' + data.id)
            }
        })
    }
</script>
@endsection