@extends('layouts.email')
@section('content')

<span>{{$data['seller_name'] }}様</span><br/>
<br>
<span>{{$data['buyer_name']}} 待機中の電話相談商品が購入されました。<span><br/>
<span>マイページからご確認お願いします。<span><br/>
<br>
@endsection    