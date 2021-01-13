@extends('navbar')

@section('custom_css')
@stop

@section('content')
        @if (session('status')) 
            <div class="alert alert-success text-center" style="font-size: 18px;">
                {{ session('status') }}
            </div>
        @endif
    @include('template.wallettop')
   
    <div class="col-md-12 text-center" style="font-size: 16px">
        <form action="{{route('add-wallet')}}"><button class="my-white">入金する</button></form>
    </div>
    <br/>
    <div class="col-md-12 text-center" style="font-size: 16px">入金履歴</div>
    <br/>
    <div class="col-md-12 alternates">
    @php $index = 1; @endphp
        <div class="col-md-12 col-sm-12 remove-pads hscroll" style="font-size: 15px !important">
            <table width="100%">
                <tbody>
                    <tr>
                        <td class="index_cells" style="width: 45%">日付</td>
                        <td class="table_cells">ポイント</td>
{{--                        <td class="table_cells">取引内容</td>--}}
                    </tr>
                    @foreach($wallet as $w)
                        <tr>
                            <td class="index_cells">{{$w->created_at}}</td>
                            <td class="table_cells">{{number_format($w->amount)}}</td>
{{--                            deposit table type column hide as all deposits are credit card deposit--}}
{{--                            <td class="table_cells">--}}
{{--                                <?php--}}
{{--                                    if($w->expense_type ==1)--}}
{{--                                        echo '電話通話料';--}}
{{--                                    else if($w->expense_type == 2)--}}
{{--                                        echo 'クレジット入金';--}}
{{--                                    else--}}
{{--                                        echo '銀行振込';--}}
{{--                                ?>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br/>
    <br/>
    <br/>
@stop
@section('custom_js')
@stop
