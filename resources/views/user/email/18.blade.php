@extends('layouts.email')
@section('content')

<p>Crofun管理者用</p>

<p>下記、新規商品申請を承りました。</p><br>

<p>お名前：{{$data['user_name']}}</p>
<p>商品名：{{$data['product_name']}}</p>
<p>申請日：{{$data['application_date']}}</p>
<p>詳細URL：{{$data['detailed_url']}}</p><br>

<p>厳正に審査を行い、5営業日以内に結果通知をしてください。</p>

@endsection    