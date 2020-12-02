@extends('layouts.email')
@section('content')

<!-- <p>株式会社{{$data['name']}}</p> -->
<p>{{$data['name']}}様</p><br>

<p>talktome運営局です。</p><br>

<p>下記の方への商品発送の件、承りました。</p>
<p>ご連絡ありがとうございます。</p><br><br>



<p>♦商品情報　</p>
<p>----------------------------------------------------------</p><br>

<p>商品名　：{{$data['product_name']}}</p>
<p>ポイント：{{$data['point']}}</p><br>

<p>----------------------------------------------------------</p><br>

<p>♦配送情報</p>
<p>----------------------------------------------------------</p><br>

<p>お名前　：{{$data['user_name']}}</p>
<p>お届け先：{{$data['delivery_address']}}</p><br>

<p>配送会社：{{$data['shipping_company']}}</p>
<p>手配日時：{{$data['date_and_time_of_arrangement']}}</p>
<p>伝票番号：{{$data['voucher_number']}}</p><br>

<p>----------------------------------------------------------</p><br>

<p>今後とも、よろしくお願申し上げます。</p>



@endsection    