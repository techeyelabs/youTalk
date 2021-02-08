@extends('navbar')

@section('custom_css')
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-5">
                <h4 class="title">You have already setup line notification.</h4>
                <h6>Still not getting any notification?Scan the following QR code using line app.</h6>
                <img src="/line/952hqpgv" alt="">
            </div>
            <div class="text-center">
                <a href="{{$redirectUrl}}" class="btn btn-info btn-lg">Setup again</a>
            </div>
        </div>
    </div>    
</div>
@stop

@section('custom_js')

@stop
