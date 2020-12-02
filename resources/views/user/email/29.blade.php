@extends('layouts.email')
@section('content')

<p>Crofun管理者用</p><br>

<p>下記、アカウント解除・退会です。</p><br>

<p>----------------------------------------------------------</p>
<p>お名前　：{{$data['user_name']}}様</p>
<p>生年月日：{{$data['birthday']}}</p>
<p>住所　　：〒{{$data['address']}}</p>
<p>電話番号：{{$data['phone_number']}}</p>
<p>ご職業　：{{$data['occupation']}}</p>
<p>----------------------------------------------------------</p>


@endsection    