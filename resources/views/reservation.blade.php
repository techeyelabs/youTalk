@extends('navbar')

@section('custom_css')
<style>
    .input_box {
        border-radius: 4px;
        border: 1px solid #cecece;
        padding: 1%;
        width: 70%;
    }

    .submit_button {
        background-color: white !important;
        border: 1px solid #d4d4d4;
        font-size: 15px;
        color: gray;
    }

    .slot_date_box {
        border: 1px solid gray;
        border-radius: 4px;
        width: 150px;
    }

    .slot_time_box {
        width: 110px;
        border: 1px solid gray;
        border-radius: 4px;
        height: 27px;
    }

    .first {
        width: 10%
    }

    .second {
        width: 40%
    }

    .third {
        width: 40%
    }

    select {

        /* styling */
        background-color: white;
        border: 1px solid #cecece;
        border-radius: 4px;
        display: inline-block;
        font: inherit;
        line-height: 12px;
        padding: 0.5em 3.5em 0.5em 1em;
        width: 100%;

        /* reset */

        margin: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    .custom-select{
    margin-top: 0px !important;
    }

 
</style>
@stop


@section('content')
<div class="col-md-12 alternates" style="max-width: 900px !important">
    <div class="col-md-12 col-sm-12">
        <div class="col-md-12 text-center mb-2 text-16">電話予約する</div>
        <div class="mb-2">サービス詳細</div>
        <div class="info-div col-md-12 row mb-5">
            <div class="col-md-3 text-left">
                <div><b>サービスID</b></div>
                <div>{{$service->id}}</div>
            </div>
            <div class="col-md-6 text-left">
                <div><b>サービスタイトル</b></div>
                <div>{{$service->title}}</div>
            </div>
            <div class="col-md-3 text-left">
                <div><b>通話料/分</b></div>
                <div>{{$service->price}}</div>
            </div>
        </div>

        <form style="width: 100%" id="reservation_form" action="{{route('post-schedule')}}"
            enctype="multipart/form-data" method="post">
            @if($available_mins > 0)
            <div style="text-align: center">ポイント残高 {{$balance}} P, {{$available_mins}}分通話可能です</div>
            @else
            <div style="text-align: center; color: red">ポイント残高 {{$balance}} P, {{$available_mins}}分通話可能です</div>
            @endif
            <div class="mb-2" style="display: none">支払情報</div>
            <div class="info-div col-md-12 mb-5" style="display: none">
                <input type="hidden" id="service_id" name="service_id" value="{{$service->id}}" />
                <div class="col-md-12 row">
                    <div class="col-md-3">クレジットカード名義</div>
                    <div class="col-md-9">
                        <input type="text" id="cardname" name="cardname" placeholder="name" class="input_box"
                            onblur="removeAlert('cardname','name_error')" />
                        <div id="name_error" style="font-size: 11px; color: red; display: none"><span>カード名義必須です！</span>
                        </div>
                    </div>
                </div>
                <br />
                <div class="col-md-12 row">
                    <div class="col-md-3">クレジットカード番号</div>
                    <div class="col-md-9">
                        <input type="text" id="cardnumber" name="cardnumber" placeholder="card numeber"
                            class="input_box" onblur="removeAlert('cardnumber','number_error')"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                        <div id="number_error" style="font-size: 11px; color: red; display: none">
                            <span>カード番号必須です！</span></div>
                    </div>
                </div>
                <br />
                <div class="col-md-12 row">
                    <div class="col-md-3">有効期限</div>
                    <div class="col-md-9">
                        <input id="validity" name="validity" placeholder="card validity" class="input_box datepick"
                            onblur="removeAlert('validity','validity_error')" readonly />
                        <div id="validity_error" style="font-size: 11px; color: red; display: none">
                            <span>有効期限必須です！</span></div>
                    </div>
                </div>
                <br />
                <div class="col-md-12 row">
                    <div class="col-md-3">セキュリティーコード</div>
                    <div class="col-md-9">
                        <input type="text" id="cvv" name="cvv" placeholder="cvv" class="input_box"
                            onblur="removeAlert('cvv','cvv_error')"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                        <div id="cvv_error" style="font-size: 11px; color: red; display: none"><span>CVV必須です！</span>
                        </div>
                    </div>
                </div>
                <br />
            </div>
            {{ csrf_field() }}
            <div class="mb-2">予約希望日程</div>
            <div class="info-div col-md-12 mb-5">
                <div class="col-md-12 row">
                    <table style="width: 100%">
                        <tr>
                            <td class="first">
                                <div>1.</div>
                            </td>
                            <td style="width: 90%">
                                <div class="col-md-12 row">
                                    <div class="col-md-2 pb-2">
                                        <span>第一希望</span>
                                    </div>
                                    <div class="col-md-4 pb-2">
                                        <input class="datepickres slot_date_box" name="d_1" id="d_1"
                                            onblur="removeAlert('d_1','d_1_error')" readonly />
                                        <div id="d_1_error" style="font-size: 11px; color: red; display: none">
                                            <span>この項目必須です</span></div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" id="slot_1" name="slot_1"  
                                        onblur="removeAlert('d_1','d_1_error')">
                                             <option value="">-------</option>
                                            <option value="12">0時</option>
                                            <option value="1">1時</option>
                                            <option value="2">2時</option>
                                            <option value="3">3時</option>
                                            <option value="4">4時</option>
                                            <option value="5">5時</option>
                                            <option value="6">6時</option>
                                            <option value="7">7時</option>
                                            <option value="8">8時</option>
                                            <option value="9">9時</option>
                                            <option value="10">10時</option>
                                            <option value="11">11時</option>
                                            <option value="12">12時</option>
                                            <option value="13">13時</option>
                                            <option value="14">14時</option>
                                            <option value="15">15時</option>
                                            <option value="16">16時</option>
                                            <option value="17">17時</option>
                                            <option value="18">18時</option>
                                            <option value="19">19時</option>
                                            <option value="20">20時</option>
                                            <option value="21">21時</option>
                                            <option value="22">22時</option>
                                            <option value="23">23時</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                </div>

                <br />
                <div class="col-md-12 row">
                    <table style="width: 100%">
                        <tr>
                            <td class="first">
                                <div>2.</div>
                            </td>
                            <td style="width: 90%">
                                <div class="col-md-12 row">
                                    <div class="col-md-2 pb-2">
                                        <span>第二希望</span>
                                    </div>
                                    <div class="col-md-4 pb-2">
                                        <input class="datepickres slot_date_box" name="d_2" id="d_2"
                                            onblur="removeAlert('d_2','d_2_error')" readonly />
                                        <div id="d_2_error" style="font-size: 11px; color: red; display: none">
                                            <span>この項目必須です</span></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" id="slot_2" name="slot_2"  
                                            onblur="removeAlert('d_2','d_2_error')">
                                                <option value="">-------</option>
                                                <option value="12">0時</option>
                                                <option value="1">1時</option>
                                                <option value="2">2時</option>
                                                <option value="3">3時</option>
                                                <option value="4">4時</option>
                                                <option value="5">5時</option>
                                                <option value="6">6時</option>
                                                <option value="7">7時</option>
                                                <option value="8">8時</option>
                                                <option value="9">9時</option>
                                                <option value="10">10時</option>
                                                <option value="11">11時</option>
                                                <option value="12">12時</option>
                                                <option value="13">13時</option>
                                                <option value="14">14時</option>
                                                <option value="15">15時</option>
                                                <option value="16">16時</option>
                                                <option value="17">17時</option>
                                                <option value="18">18時</option>
                                                <option value="19">19時</option>
                                                <option value="20">20時</option>
                                                <option value="21">21時</option>
                                                <option value="22">22時</option>
                                                <option value="23">23時</option>
                                            </select>
                                           
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <br />
                <div class="col-md-12 row">
                    <table style="width: 100%">
                        <tr>
                            <td class="first">
                                <div>3.</div>
                            </td>
                            <td style="width: 90%">
                                <div class="col-md-12 row">
                                    <div class="col-md-2 pb-2">
                                        <span>第三希望</span>
                                    </div>
                                    <div class="col-md-4 pb-2">
                                        <input class="datepickres slot_date_box" name="d_3" id="d_3"
                                            onblur="removeAlert('d_3','d_3_error')" readonly />
                                        <div id="d_3_error" style="font-size: 11px; color: red; display: none">
                                            <span>この項目必須です</span></div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" id="slot_3" name="slot_3"  
                                        onblur="removeAlert('d_3','d_3_error')">
                                            <option value="">-------</option>
                                            <option value="12">0時</option>
                                            <option value="1">1時</option>
                                            <option value="2">2時</option>
                                            <option value="3">3時</option>
                                            <option value="4">4時</option>
                                            <option value="5">5時</option>
                                            <option value="6">6時</option>
                                            <option value="7">7時</option>
                                            <option value="8">8時</option>
                                            <option value="9">9時</option>
                                            <option value="10">10時</option>
                                            <option value="11">11時</option>
                                            <option value="12">12時</option>
                                            <option value="13">13時</option>
                                            <option value="14">14時</option>
                                            <option value="15">15時</option>
                                            <option value="16">16時</option>
                                            <option value="17">17時</option>
                                            <option value="18">18時</option>
                                            <option value="19">19時</option>
                                            <option value="20">20時</option>
                                            <option value="21">21時</option>
                                            <option value="22">22時</option>
                                            <option value="23">23時</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <br />
            </div>
        </form>

        @if($available_mins > 0)
        <div class="col-md-12 text-center mb-5"><button id="send_res" class="submit_button buttons">予約する</button></div>
        @else
        <div class="col-md-12 text-center mb-5"><button id="send_res_disabled" class="submit_button buttons"
                disabled>予約する</button></div>
        @endif
    </div>
</div>



@stop



@section('custom_js')
<script>
    $(document).ready(function () {
        $("#send_res").click(function () {
            var flag = 0;
            if ($('#d_1').val() == '' || $('#d_1').val() == null) {
                flag = 1;
                console.log("Here1");
                $('#d_1_error').show();
            }
            if ($('#d_2').val() == '' || $('#d_2').val() == null) {
                flag = 1;
                $('#d_2_error').show();
                console.log("Here2");
            }
            if ($('#d_3').val() == '' || $('#d_3').val() == null) {
                flag = 1;
                $('#d_3_error').show();
                console.log("Here3");
            }
            if ($('#slot_1').val() == '' || $('#slot_1').val() == null) {
                flag = 1;
                $('#d_1_error').show();
                console.log("Here4");
            }
            if ($('#slot_2').val() == '' || $('#slot_2').val() == null) {
                flag = 1;
                $('#d_2_error').show();
                console.log("Here5");
            }
            if ($('#slot_3').val() == '' || $('#slot_3').val() == null) {
                flag = 1;
                $('#d_3_error').show();
                console.log("Here6");
            }
            // if($('#description').val() == '' || $('#description').val() == null){
            //     flag = 1;
            //     $('#detail_error').show();
            // }
            if (flag == 0) {
                if (confirm("こちらの内容でよろしいですか！")) {
                    $("#reservation_form").submit();
                }
            }
        });


    });
</script>
<script>
    function removeAlert(b, a) {
        error = document.getElementById(a);
        input_val = document.getElementById(b);
        setTimeout(function () {
            console.log(input_val.value);
            if (input_val.value != '' && input_val.value != null)
                // error.style.display = "block";
                error.style.display = "none";
        }, 100);
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $('#validity').datepicker({
            autoclose: true,
            minViewMode: 1,
            format: 'mm/yy',
            startDate: '+1d'
        }).on('changeDate', function (selected) {
            startDate = new Date(selected.date.valueOf());
            startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
            $('.to').datepicker('setStartDate', startDate);
        });

        $('.datepickres').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: '+1d'
        }).change(function () {
            var form = $(this).val().split("-");
            var datestr = form[0] + '年 ' + form[1] + '月 ' + form[2] + '日';
            $(this).val(datestr);
        });
    });
</script>
<script>
    $(document).ready(function () {
       $('.selectpicker').selectpicker({
          iconBase: 'fa',
          tickIcon: 'fa-check',
       });
    });

 </script>
@stop