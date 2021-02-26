@extends('navbar')

@section('custom_css')
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="text-center pt-4">
                <h4 class="title">LINE通話設定済み</h4>
                <h6>アカウント変更したい場合は下記のボタンから設定をし直して下さい。</h6>
                <img src="/line/952hqpgv" alt="">
            </div>
            <div class="text-center pb-4">
                <a href="{{$redirectUrl}}" class="btn buttons btn-size white_buttons" style="color: black">アカウント変更</a>
            </div>
        </div>
    </div>    
</div>
@stop

@section('custom_js')

@stop
