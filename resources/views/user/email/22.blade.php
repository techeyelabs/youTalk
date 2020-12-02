@extends('layouts.email')
@section('content')

<p>Crofun管理者用</p><br>

<p>下記、問合せがありました。</p><br><br>


<p>お名前　　　　：{{$data['person_name']}}</p>
<p>問い合わせ内容：{{$data['inquiry']}}</p>
<p>問い合わせ日　：{{$data['inquiry_date']}}</p>
<p>問い合わせURL：{{$data['inquiry_url']}}</p><br>

<p>5営業日以内に連絡をお願いいたします。</p>

@endsection    