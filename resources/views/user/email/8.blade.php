@extends('layouts.email')
@section('content')

<p>株式会社{{$data['company_name']}}</p>
<p>代表取締役社長{{$data['name']}}様</p><br>

<p>talktome運営局です。</p><br>

<p>下記の方からの商品発注を承りましたので、</p>
<p>下記の住所へ商品の発送をお願いいたします。</p><br><br>


<p>----------------------------------------------------------</p><br>

<p>商品名　：{{$data['product_name']}}</p><br>

<p>お名前　：{{$data['buyer_name']}}様</p>
<p>ご住所　：〒 {{$data['buyer_home1']}}</p>
<p>　        {{$data['buyer_home2']}} ,  {{$data['buyer_home3']}} , {{$data['buyer_home4']}} , {{$data['buyer_home5']}}</p>
<p>電話番号：{{$data['buyer_phone_number']}}</p><br>

<p>----------------------------------------------------------</p>
<p>尚、お手数ですが、</p>
<p>発送の手配が完了しましたら、運営局宛にメールまたはお電話で</p>
<p>お知らせくださいますようお願い申し上げます。</p>

@endsection    