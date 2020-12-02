@extends('layouts.email')
@section('content')

<p>Crofun管理者用</p>

<p>期間終了プロジェクト</p><br>

<p>プロジェクト名：{{$data['project_name']}}</p>
<p>ＵＲＬ　　　　：{{$data['project_url']}}</p><br><br>


<p>以上</p>

@endsection    