@extends('layouts.email')
@section('content')

<!-- <p>株式会社{{$data['name']}}</p> -->
<p>{{$data['name']}}様|</p><br>

<p>talktome運営局です。</p>
<p>この度は数あるクラウドファンディングの中から、</p>
<p>Crofunをお選びいただき、誠にありがとうございました。</p><br>

<p>いただいた申請書は厳正に審査を行い、</p>
<p>５営業日以内に結果を通知いたします。</p>
<p>今しばらくお待ちください。</p>


@endsection    