@extends('layouts.email')
@section('content')

<!-- <p>株式会社{{$data['name']}}</p> -->
<p>{{$data['name']}}様</p><br>

<p>talktome運営局です。</p><br>

<p>下記の方からの支援を承りましたので、ご連絡いたします。</p><br>

<p>----------------------------------------------------------</p>
<p>お名前　：{{$data['person_name']}}様</p>
<p>支援金額：{{$data['amount_of_support']}}円</p><br>

<p>----------------------------------------------------------</p><br>

<p>現在のプロジェクト支援金額合計は</p>
<p>掲載URLからご確認いただけます。</p><br>

<p>それでは、プロジェクト終了までがんばっていきましょう。</p>

@endsection  