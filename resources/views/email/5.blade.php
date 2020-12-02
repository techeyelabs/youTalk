@extends('layouts.email')
@section('content')

{{$data['your_name']}}様

<p>いつもお世話になっております。</p>
<p>talktome運営局です。</p><br>

<p>アカウント変更を承りました。</p>
<p>あなたのアカウントの新しい情報は下記のとおりです。</p>
<p>ご確認くださいますようお願いいたします。</p><br><br>


<p>----------------------------------------------------------</p><br>

<p>お名前　：{{$data['your_name']}}様</p>
<p>生年月日：{{$data['birth_date']}}</p>
<p>住所　　：〒 {{$data['address1']}}</p>
<p>　        {{$data['address2']}} ,  {{$data['address3']}} , {{$data['address4']}} , {{$data['address5']}}</p>
<p>電話番号：{{$data['phone_number']}}</p><br>

<p>----------------------------------------------------------</p>
<p>{{$data['your_name']}}様のご期待に沿えるよう、これからも邁進してまいりますので、</p>
<p>これからも変わらぬご愛顧を賜りますようお願い申し上げます。</p>
@endsection    