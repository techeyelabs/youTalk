@extends('layouts.email')
@section('content')

    <span>{{$data['buyer_name'] }}様</span><br/>
    <br>
    <span>このたびは、YouTalkをご利用いただきまして、誠にありがとうございます。<span><br/>
<br/>
<span>今回の通話料金は下記になります。<span><br/>
<br>
<span>--------------------------------------------------</span><br/>
<table style="">
    <tbody>
        <tr>
            <td style="width: 130px; text-align: left; vertical-align: top">サービスタイトル</td>
            <td style="width: 10px; text-align: center; vertical-align: top">:</td>
            <td style="width: 330px; text-align: left; vertical-align: top">{{$data['service_title'] }}</td>
        </tr>
        <tr>
            <td style="width: 130px; text-align: left">通話日付</td>
            <td style="width: 10px; text-align: center">:</td>
            <td style="width: 180px; text-align: left">{{$data['date'] }}</td>
        </tr>
        <tr>
            <td style="width: 130px; text-align: left">通話時間</td>
            <td style="width: 10px; text-align: center">:</td>
            <td style="width: 180px; text-align: left">{{$data['duration'] }}分</td>
        </tr>
        <tr>
            <td style="width: 130px; text-align: left">金額</td>
            <td style="width: 10px; text-align: center">:</td>
            <td style="width: 180px; text-align: left">{{$data['amount'] }}円</td>
        </tr>
    </tbody>
</table>
<span>--------------------------------------------------</span><br/>
<br/>
<span><b>10分経過しましたが通話が開始されなかったので、キャンセルとなりました。</b></span><br/>
<span>ご不明な点やご質問などございましたら、【YouTalk】管理局までお問合せください。</span><br/>
<br/>

@endsection