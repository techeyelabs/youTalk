@extends('layouts.email')
@section('content')

<!-- <p>株式会社{{$data['name']}}</p> -->
<p>{$data['name']}}様</p><br>

<p>talktome運営局です。</p><br>

<p>先日は、お忙しい中、カタログ掲載商品として</p>
<p>御社の商品の掲載申請をいただき、ありがとうございました。</p><br>

<p>選考の結果、掲載することに決定いたしましたのでご連絡いたします。</p>
<p>掲載URL：{{$data['name']}}</p><br><br>


<p>リターンとしての商品提供が</p>
<p>○○様の商品の新たなビジネス展開になれることを、一同大変嬉しく思っております。</p>
<p>何かご不明点やご質問がございましたら、お気軽にお問合せください。</p>

@endsection    