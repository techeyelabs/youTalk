@extends('navbar')

@section('custom_css')
@stop

@section('content')
    
<div class="col-md-12 alternates" style="min-height: 850px">
    <div class="col-md-12 col-sm-12">
        <div class="col-md-12 mb-5 pt-3" style="border: 1px solid #a2a2a280">
            <div class="mb-2 text-16"><span>電話通話内容</span></div>
            <div class="row col-md-12" style="padding-left: 0px!important;">
                <div class="col-md-3" style="padding-right: 0px!important; padding-left: 0px!important;">
                    <a class="anchorColor" href="{{route('user-display-service', ['id' => $service->id])}}">
                        <img class="img-thumbnail" src="{{Request::root()}}/assets/service/{{$service->thumbnail}}" style="object-fit: cover; width: 150px; height: 120px">
                    </a>
                </div>
                <div class="col-md-9 p-2 text-14 mt-3" style="padding-left: 0px!important;">
                    <div class="col-md-12 row pl-3" style=""><a class="anchorColor" href="{{route('user-display-service', ['id' => $service->id])}}">{{$service->title}}</a></div>
                    <div class="row pl-3">
                        <div class="row col-md-8 p-0">
                            @if($service->free_mint_iteration > 0)
                                <div class="row">
                                    <div>お試し通話機能あり</div><div>（開始から{{$service->free_min}}分までを{{$service->free_mint_iteration}}回無料）</div>
                                </div>
                            @endif
                            <div class="row col-md-12 pl-0 mt-2"><a class="anchorColor" href="{{route('user-page-profile', ['id' => $service->seller_id])}}">{{$service->createdBy->name}} {{$service->createdBy->last_name}}</a></div>
                        </div>
                        <div class="col-md-4 text-center p-0">
                            <span style="font-size: 35px">{{$service->price}}</span><span> 円 / 分</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <?php 
                    if($available_mins == 0){
                ?>  
                <div><span style="color: red">ポイント残高  {{$balance}} P, {{$available_mins}}分通話可能です</span></div>
                <br/>
                <br/>
                <div class="col-md-12 text-center mb-3">
                    <button id="button-of-no-worth" class="btn buttons btn-size justify-content-center mb-1 mt-1" style="width: 200px; margin-right: 2%" disabled>出品者を呼び出します</button>
                    <a class="btn buttons btn-size justify-content-center mb-1 mt-1" href="{{ url()->previous() }}" style="width: 200px; margin-right: 2%; color: #7f9098 !important">キャンセル</a>
                </div>
                <?php
                    } else {
                ?>
                <div><span>ポイント残高  {{$balance}} P, {{$available_mins}}分通話可能です</span></div>
                <br/>
                <br/>
                <div class="col-md-12 text-center mb-3">
                    <button id="send_payment" class="btn buttons btn-size justify-content-center mb-1 mt-1" style="width: 200px; margin-right: 2%">出品者を呼び出します</button>
                    <a class="btn buttons btn-size justify-content-center mb-1 mt-1" href="{{ url()->previous() }}" style="width: 200px; margin-right: 2%; color: #7f9098 !important">キャンセル</a>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>

        <div class="col-md-12" style="display: none">
            <div class="mb-2 text-16"><span>支払方法</span></div>
            <div class="p-2" style="border: 2px solid rgba(158, 148, 148, 0.5)">
                <div class="row">
                    <form class="col-md-12 pl-0 pt-2" id="payment_form" action="{{route('payment-option')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" id="available_mins" name="available_mins" value="{{$available_mins}}"/>
                        <div class="form-check form-check-inline text-14">
                            <div class="col-md-12">
                                
                                <input class="form-check-input" type="radio" name="paymentOptions" id="inlineRadio1" value="point" checked <?php if($available_mins == 0){ echo 'disabled';} ?>>
                                <label class="form-check-label" for="inlineRadio1"><span>ポイント支払</span></label>
                                <div class="ml-4 mb-4">
                                    <div style="">ポイント残高  {{$balance}} P</div>
                                    <div style="">{{$available_mins}}分通話可能です</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-check text-14">
                            <div class="col-md-12">
                                <input class="form-check-input" type="radio" name="paymentOptions" id="inlineRadio2" value="credit_card">
                                <label class="form-check-label" for="inlineRadio2"><span>クレジット支払</span></label>
                                <div class="ml-4 mb-4">
                                    <input type="hidden" name="service_id" value="{{$service->id}}">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-3 col-form-label">カード名義</label>
                                        <div class="col-sm-9">
                                          <input id="name" type="text" name="name"class="form-control" id="inputName" placeholder="Name">
                                          <div class="text-10" id="name_error" style="color: red; display: none"><span>カード名義を入力してください！</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputCardNumber" class="col-sm-3 col-form-label">カード番号</label>
                                        <div class="col-sm-9">
                                          <input id="card_number" name="card_number" type="text" class="form-control" id="inputCardNumber" placeholder="Card Number">
                                          <div class="text-10" id="card_number_error" style="color: red; display: none"><span>カード番号を入力してください！</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">	
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">有効期限</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="card_expire" class="form-control" name="card_expire" placeholder="Card Expired Date" readonly/>
                                            <div class="text-10" id="card_expire_error" style=" color: red; display: none"><span>カード有効期限を選択してください！</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">	
                                        <label for="inputCVC" class="col-sm-3 col-form-label">CVCコード</label>
                                        <div class="col-sm-9">
                                            <input id="cvc" name="cvc" type="text" class="form-control" id="inputCVC" placeholder="CVC">
                                            <div class="text-10" id="cvc_error" style="color: red; display: none"><span>cvcを入力してください！</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> 
            </div>
            <div class="text-10" id="payment_error" style="color: red; display: none"><span>*決済方法を選択してください！</span></div>
        </div>
    </div>
</div>
@stop
@section('custom_js')

<script>
    $(document).ready(function() {
        $("#send_payment").click(function(){
            var flag = 0;
            var hh = $("input[name='paymentOptions']:checked").val();

            if(hh == undefined){
                flag = 1;
                $('#payment_error').show();
            }

            if(hh === 'credit_card'){
                if($('#name').val() == '' || $('#name').val() == null){
                flag = 1;
                $('#name_error').show();
                }
                if($('#card_number').val() == '' || $('#card_number').val() == null){
                    flag = 1;
                    $('#card_number_error').show();
                }
                if($('#card_expire').val() == '' || $('#card_expire').val() == null){
                        flag = 1;
                        $('#card_expire_error').show();
                }
                if($('#cvc').val() == '' || $('#cvc').val() == null){
                    flag = 1;
                    $('#cvc_error').show();
                }
            }

            if(flag == 0){
                if(confirm("こちらの内容でよろしいですか！")){    //Are you sure you want this content?
                    $("#send_payment").prop('disabled',true);
                    $("#payment_form").submit();
                } else {
                    $("#send_payment").prop('disabled',false);
                }
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#card_expire').datepicker({
            autoclose: true,
            minViewMode: 1,
            format: 'mm/yyyy'
        }).on('changeDate', function(selected){
            startDate = new Date(selected.date.valueOf());
            startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
            $('.to').datepicker('setStartDate', startDate);
        });
    });
</script>
@stop