@extends('emailtemplates.email')
@section('content')

<p>
YouTalk 運営局です。
</p>
<p>
この度は、YouTalk にご登録いただき、ありがとうございます。
<br>
下記の情報でアカウントの仮登録が完了しています。
</p>
<p>
メールアドレス：{{$data['email']}}
</p>
<p>
情報に誤りがなければ下記URLをクリックし、本登録をお願いいたします。
<br>
URL：<a href="{{$data['root']}}/register/{{$data['register_token']}}">{{$data['root']}}/register/{{$data['register_token']}}</a>
</p>
<P>
何かご不明な点やご質問がございましたら、
<br>
お気軽にお問合せください。
</P>
        

@endsection    