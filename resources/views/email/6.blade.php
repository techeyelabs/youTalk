@extends('layouts.email')
@section('content')

<p>Crofun管理者用</p><br>

<p>下記アカウントの情報が変更されました。</p><br>

<p>----------------------------------------------------------</p><br>

<p>お名前　：{{$data['person_name']}}様</p>
<p>生年月日：{{$data['birth_date']}}</p>
<p>住所　　：〒 {{$data['address1']}}</p>
<p>　        {{$data['address2']}} ,  {{$data['address3']}} , {{$data['address4']}} , {{$data['address5']}}</p>
<p>電話番号：{{$data['phone_number']}}</p><br>

<p>---------------------------------------------------------</p>

@endsection    