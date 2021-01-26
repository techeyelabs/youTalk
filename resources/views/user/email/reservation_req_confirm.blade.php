@extends('layouts.email')
@section('content')
    {{$data['buyer_name'] }}様
    <br/>
    <br/>
    <span>ご希望の日程で予約を確定されました。</span><br/>
    <br>
    <span>マイページにて確認お願いします。</span>
    <br>
    <br>

@endsection