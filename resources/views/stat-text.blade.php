@extends('navbar')

@section('custom_css')

@stop


@section('content')
    <div class=" row" style="padding-top: 28px">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            {!!nl2br($txt)!!}
        </div>
        <div class="col-md-2"></div>
    </div>
@stop



@section('custom_js')

@stop