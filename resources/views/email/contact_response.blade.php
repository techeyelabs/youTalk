@extends('user.layouts.email')

@section('custom_css')
@stop

@section('content')


<div class="well">

{{ $data['name']}} 様
<p>
お問い合わせありがとうございました
<br>
Crofun事務局です。
</p>
<p>
下記内容でお問い合わせ承りました。
</p>
<p>
    ----------------------------------
    <br>
    お名前 　{{ $data['name']}}
    <br>
    メールアドレス {{ $data['user_email']}}
    <br>
    お問い合せ内容
    <br>
    {{ $data['details']}}
    <br>
    ----------------------------------
</p>
<p>
内容を確認次第、担当よりご連絡いたします。
</p>
</div>


@stop

@section('custom_js')
@stop