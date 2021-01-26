@extends('navbar')

@section('custom_css')
<style>
    .select_input{
        border: 1px solid #c7c7c7;
        border-radius: 4px;
        width: 180px;
        height: 30px;
    }

    .payment_options_td{
        text-align: left;
        border: none;
        padding: 0px;
    }

</style>
@stop


@section('content')
    @if (session('status'))
        <div class="alert alert-danger text-center" style="font-size: 18px;">
            {{ session('status') }}
        </div>
    @endif
    @include('template.wallettop')
    <br/>
    <div class="col-md-12 row">
    @php $index = 1; @endphp
        <div class="col-md-2"></div>
        <div class="col-md-8 remove-pads hscroll text-center" style="padding-left: 40px; padding-right: 40px; font-size: 15px !important">
            <div class="text-center">
                <form id="deposit_form" action="{{route('add-wallet-action')}}" method="post">
                    {{ csrf_field() }}
                    <div>
                        <span>入金額</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select class="custom-select" style="width: 225px !important; height:38px !important; color: gray" id="amount" name="amount">
                            <option value=""><span style="">購入ポイント選択</span></option>
                            @foreach($dep_amounts as $ams)
                                <option value="{{$ams->amount}}">{{$ams->display_text}}</option>
                            @endforeach
                        </select> 円
                    </div>
                    <br/>
                    {{--<div>入金方法</div>
                    <br/>
                    <div>入金する方法を選択してください</div>--}}
                    <br/>
                    <div class="col-md-12 row text-center">
                        <table style="margin:0 auto">
                            <tbody>
                                <tr><td class="payment_options_td">
                                    <input type="radio" id="credit" name="method" value="1" checked>
                                    <label for="credit">クレジットカード</label><br/>
                                </td></tr>
                                <tr><td class="payment_options_td">
                                    <input type="radio" id="bank" name="method" value="2">
                                    <label for="bank">銀行振込 </label><br>
                                </td></tr>
                            </tbody>
                        </table>
                        
                        
                    </div>
                    <div id="bank_info_div" class="col-md-12 row" style="display: none">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <table style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td style="width: 35%">銀行名</td>
                                        <td style="width: 65%; text-align: left">XXXXXXXXXXXXX</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 35%">支店名</td>
                                        <td style="width: 65%; text-align: left">YYYYYYYYYYYYY</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 35%">口座種別</td>
                                        <td style="width: 65%; text-align: left">ZZZZZZZZZZZZZ</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 35%">口座番号</td>
                                        <td style="width: 65%; text-align: left">IIIIIIIIIIIIII</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 35%">口座名義</td>
                                        <td style="width: 65%; text-align: left">JJJJJJJJJJJJJJ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </form>
                <br/>
                <button class="btn buttons btn-size white_buttons" id="deposit" style="background-color: white; border: gray">入金する</button>
                <div class="mt-5">
                    <div>銀行振込を行われた場合、メッセージでお知らせください。</div>
                    <div>入金確認できましたらウォレットに追加されます。</div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/>
    <br/>
    <br/>

    <!-- form for gateway -->
    <div style="display: none">
        <form id="formForGateway" action ="https://www.pv-pay.com/service/credit/input.html" method = "post">
          
            <input type = "hidden" name = "SiteId" value = "{{$SiteId}}"> 
            <input type ="hidden" name = "SitePass" value = "{{$SitePass}}">
            <input type = "hidden" name ="Amount" id="Amount" value = ""> 
            <input type = "hidden" name ="mail"  value = "{{$mail}}"> 
            <input type = "hidden" name ="CustomerId"  value = "{{$CustomerId}}"> 
            <input type = "hidden" name = "name" value = "{{$name}}"> 
            <input type ="hidden" name = "TransactionId" value ="{{$TransactionId}}"> 
            <input type ="hidden" name = "language" value ="{{$language}}"> 
        </form>
    </div>
@stop



@section('custom_js')
<script>
    $(document).ready(function() {
        $("#deposit").click(function(){
            flag = 0;
            if($("#amount").val() == '' || $('input[name=method]:checked').val() == '')
                flag = 1;
            if(flag == 0){
                $('#Amount').val($("#amount").val());
                if(confirm("入金よろしいですか？")){
                    $("#formForGateway").submit();
                }
            }
        }); 
    });

    $('input[type=radio][name=method]').change(function() {
        if(this.value == 1){
            $('#bank_info_div').hide();
        } else {
            $('#bank_info_div').show();
        }
    });
</script>
@stop