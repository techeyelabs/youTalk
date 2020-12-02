@extends('layouts.email')
@section('content')

<p>Crofun管理者用</p><br>
　
<p>下記、商品購入がありました。</p><br>

<p>＜購入者＞</p>
<p>お名前　：{{$data['buyer_name']}}様</p>
<p>フリガナ：{{$data['buyer_reading']}}</p>
<p>ご住所　：〒 {{$data['buyer_address1']}}</p>
<p>　        {{$data['buyer_address2']}} ,  {{$data['buyer_address3']}} , {{$data['buyer_address4']}} , {{$data['buyer_address5']}}</p>
<p>電話番号：{{$data['buyer_phone_number']}}</p><br>

<p>商品名：{{$data['product_name']}}</p>
<p>ポイント数：{{$data['point']}}</p><br>

<p>＜商品提供者＞</p>
<p>お名前　：{{$data['seller_name']}}様</p>
<p>フリガナ：{{$data['seller_reading']}}</p>
ご住所　：〒 {{$data['seller_address1']}}</p>
<p>　        {{$data['seller_address2']}} ,  {{$data['seller_address3']}} , {{$data['seller_address4']}} , {{$data['seller_address5']}}</p>
<p>電話番号：{{$data['seller_phone_number']}}</p><br>

<p>以上</p>

@endsection 