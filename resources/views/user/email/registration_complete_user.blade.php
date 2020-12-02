@extends('layouts.email')
@section('content')


<span><?php echo $data['name']; ?> 様</span><br/>
<br/>
<span>このたびは、YouTalkにご登録いただきまして、</span><br/>
<span>誠にありがとうございます。</span><br/>
<br>
<span>お客様の登録が完了いたしましたのでご連絡申し上げます。</span><br/>
<br>
<span>ご不明な点やご質問などございましたら、お気軽にお問い合せください。</span><br/>
<br>
<span>それでは、早速、YouTalk をご利用ください。</span><br/>
<span>URL： https://YouTalk.tel</span><br/>
<br>
----------------------------------------------------------
<p>
©YouTalk.tel
<br/>
@endsection    