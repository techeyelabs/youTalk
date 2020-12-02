@extends('layouts.email')
@section('content')

{{$data['name']}}様

<p>talktome運営局です。</p>
<p>この度は、下記プロジェクトへご支援をいただき</p>
<p>誠にありがとうございました。</p><br>

<p>----------------------------------------------------------</p><br>

<p>起案者：{{$data['founder']}}様</p>
<p>プロジェクト名：{{$data['project_name']}}</p>
<p>支援コース：{{$data['support_course']}}円</p>
<p>リターン：{{$data['return']}}</p><br>

<p>----------------------------------------------------------</p><br>

<p>支援プロジェクトの進捗状況はマイページよりご確認いただけます。</p>
<p>起案者様へメッセージを送ることもできますので、</p>
<p>応援メッセージをお伝えいただけると起案者様の励みになると思います。</p>
<p>URL:{{$data['name']}} ttp://bitpeboot.com/ab223HxacyZyl/public/user/my-page</p><br>

<p>それでは、今後とも変わらぬご支援のほどよろしくお願いします。</p>

@endsection