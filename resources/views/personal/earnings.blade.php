@extends('navbar')

@section('custom_css')
<style>
    .butt{
        color: rgb(68, 68, 68);
        cursor: pointer;
        height: 35px;
        border: 1px solid rgb(204, 204, 204);
        border-radius: 6px
    }

    .request_amount_entry{
        width: 100%;
        border: 1px solid gray;
        border-radius: 5px;
        height: 35px;
        padding: 9px;
    }
    
</style>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@stop


@section('content')
   
    <br/>
    <div class="col-md-12 alternates" style="max-width: 700px !important; padding-left: 10px !important; padding-right: 10px !important">
    @php $index = 1; @endphp
        <div class="col-md-12 col-sm-12 text-center remove-pads" style="padding-top: 30px; padding-bottom: 30px; padding-left: 50px; padding-right: 50px; border: 1px solid gray">
            <div class="text-16"><span>売上金残高</span></div>
            <div><h3>¥ {{$balance}}</h3></div>
            <br/>
            <div style="padding-bottom: 20px; border-bottom: 1px solid"><button class="butt" onclick="shoeRequestForm()">振込申請する</button></div>
            <div class="">
                <table style="margin: 0 auto; width: 100%">
                    <tr>
                        <td class="remove-pads" style="border-right: 1px solid; border-bottom: none; width: 50%; padding: 30px; text-align: center">
                            <div class="text-16">今月の累積売上</div>
                            <div><h3>¥ {{$last_month_earning}}</h3></div>
                        </td>
                        <td class="remove-pads" style="border-left: 1px solid; border-bottom: none; width: 50%; padding: 30px; text-align: center">
                            <div class="text-16">累積売上</div>
                            <div><h3>¥ {{$lifetime_earning}}</h3></div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="text-center pt-3 pb-3">
                <span>ステータスが評価または入力されていない場合は、売上に記録されます</span>
            </div>
            <div class="text-left pb-2 text-16" style="border-bottom: 1px solid gray">
                <span>売上金の振替</span>
            </div>
            <div class="text-left pb-2 pt-2 text-12" style="">
                <span>. 3000円以上から振込みを申し込むことができます。別途振込手数料として756円かかります</span>
            </div>
            <div class="text-left pb-2 pt-2 text-12" style="">
                <span>. 振込の申請が同月の1日から31日に行われる場合は、翌々月5日に支払われます.（金融機関休業日の場合は翌営業日）</span>
            </div>
            <div class="text-left pb-2 pt-2 text-12" style="">
                <span>. 代金の振込みを申請するには、会員情報と振込口座の登録が必要です。</span>
            </div>
        </div>
        <br/>
        <br/>
        <div class="col-md-12 col-sm-12 text-center remove-pads" style="padding-top: 30px; padding-bottom: 30px; padding-left: 50px; padding-right: 50px; border: 1px solid gray">
            <div class="text-center text-16">
                <span>振込申請履歴</span>
            </div>
            <br/>
            <div style="padding-bottom: 5px">
                <table style="width: 100%">
                    @if(count($requests) > 0)
                    <tr style="border-bottom: 1px solid gray">
                        <th style="text-align: left; padding: 10px">日付</th>
                        <th style="text-align: left; padding: 10px">金額</th>
                        <th style="text-align: left; padding: 10px">状況</th>
                    </tr>
                    @endif
                    @foreach($requests as $req)
                        <tr>
                            <td style="text-align: left">{{$req->created_at}}</td>
                            <td style="text-align: left">{{$req->amount}}</td>
                            @if($req->status == 1)
                                <td style="text-align: left">申請中</td>
                            @elseif($req->status == 2)
                                <td style="text-align: left">完了</td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="w3-container">
        <div id="id02" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
                <div class="w3-section pl-4 pt-2 pb-2 text-16" style="">
                    <button onclick="document.getElementById('id02').style.display='none'" type="button" class="close">
                        <span style="padding-right: 10px" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="p-4 text-14">
                    <span style="padding-bottom: 4px">金額</span><br/>
                    <input onchange="removeErr()" class="request_amount_entry" id="amount" name="amount"/>
                    <input type="hidden" id="available" name="available" value="{{$balance}}"/>
                    <span class="text-10" style="color: red; display: none" id="min3000">3000円以上から申請可能です！</span>
                    <span class="text-10" style="color: red; display: none" id="noinput">金額を入力して下さい！</span>
                    <span class="text-10" style="color: red; display: none" id="notEnough">残高を不足しています！</span>
                </div>
    
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey text-center">
                    <button onclick="sendReq()" type="button" class="w3-button w3-white buttons btn-size" style="color: gray !important">ok</button>
                </div>
            </div>
        </div>
    </div>
@stop



@section('custom_js')
<script>
    function shoeRequestForm(){
        var available = parseInt($('#available').val());
        if(available >= 3000){
            document.getElementById('id02').style.display='block';
        }
    }
</script>
<script>
     function sendReq(){
        var amount = parseInt($('#amount').val());
        var available = parseInt($('#available').val());
        if(!(amount > 0)){
            $('#noinput').show();
            $('#min3000').hide();
            $('#notEnough').hide();
        } else if(amount < 3000){
            $('#min3000').show();
            $('#noinput').hide();
            $('#notEnough').hide();
        } else if(amount > available){
            $('#notEnough').show();
            $('#noinput').hide();
            $('#min3000').hide();
        } else {
            var ajaxurl = "{{route('withdraw-req-submit')}}";
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                        '_token': "{{ csrf_token() }}",
                        'amount': amount
                },
                success: function(data){
                    if(data.status == 200)
                        window.location.reload();
                    else    
                        alert("データ習得できませんでした！");
                },
                complete: function (data) {    
                }
            });
        }
    }

    function removeErr(){
        var amount = $('#amount').val();
        if(amount > 3000){
            $('#min3000').hide();
        } else if(amount <= available){
            $('#notEnough').hide();
        }
    }
</script>
@stop