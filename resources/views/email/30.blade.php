@extends('layouts.email')
@section('content')

<p>{{$data['name']}}様</p><br>

<p>talktome運営局です。</p><br>

<p>いつも大変お世話になっております。</p><br>

<p>----------------------------------------------------------</p>
<p>商品名　 ：{{$data['product_name']}}</p>
<p>発送件数 ：{{$data['number_of_shipments']}} 件</p><br>

<p>合計　　 ：{{$data['total']}} 円</p><br>

<p>---------------------------------------------------------</p><br>

<p>誤りがある場合は、お手数ですが弊社までご連絡ください。</p>
<p>今後ともよろしくお願い申し上げます。</p>

@endsection    