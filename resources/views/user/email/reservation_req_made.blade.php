@extends('layouts.email')
@section('content')


{{$data['name'] }}様
<br/>
<br/>
<span>このたびは、YouTalk をご利用いただきまして、誠にありがとうございます。</span><br/>
<br>
<span>{{$data['buyer_name']}}様から電話予約の希望を受け付けました。</span><br/>
<span>マイページにて確認お願いします。</span>
<br>
<br> 

@endsection    