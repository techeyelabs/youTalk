@extends('layouts.email')
@section('content')



YouTalk
</p>
<p>
下記の方より、新規登録がありました。
</p>
----------------------------------------------------------
<table>
    <tr>
        <td>お名前</td>
        <td>: {{$data['name']}}</td>
    </tr>
    {{--<tr>
        <td>メールアドレス</td>
        <td>: {{$data['email']}} </td>
    </tr>--}}
    <tr>
        <td>性別</td>
        <td>: </td>
    </tr>
    <tr>
        <td>住所</td>
        <td>: </td>
    </tr>
    <tr>
        <td>電話番号</td>
        <td>: </td>
    </tr>
</table>


----------------------------------------------------------
<p>
以上
</p>
        

@endsection    