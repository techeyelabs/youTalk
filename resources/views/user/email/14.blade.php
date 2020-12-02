@extends('layouts.email')
@section('content')

<p>Crofun管理者用</p><br>

<p>下記、新規プロジェクトの申請です。</p><br>

<p>お名前：{{$data['person_name']}}</p>
<p>プロジェクト名：{{$data['project_name']}}</p>
<p>プロジェクト申請日：{{$data['project_application_date']}}</p>
<p>プロジェクトURL：{{$data['project_url']}}</p>

<p>5営業日以内に結果通知をしてください。</p>

@endsection    