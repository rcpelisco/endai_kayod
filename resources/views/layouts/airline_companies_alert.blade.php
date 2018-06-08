@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert bg-danger error_close" role="alert" style="float:center;">
            <em class="fa fa-lg fa-warning error_btn">&nbsp;</em>{{$error}}
            <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a>
        </div>
    @endforeach
@endif

@if(session('success'))
<div class="alert bg-success success_close" role="alert">
    <em class="fa fa-lg fa-warning">&nbsp;</em>{{session('success')}}
    <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a>
</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif