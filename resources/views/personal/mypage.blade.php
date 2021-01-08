@extends('navbar')

@section('custom_css')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@stop

@section('content')
    <div class="col-md-12 alternates" style="min-height: 850px">
        <div class="col-md-12 col-sm-12 remove-pads">
            <div class="text-16 text-center mb-4">
                <span>サービス一覧</span>
            </div>
            @foreach($myServices as $data)
                @php
                   $countPending = 1;
                   $countConfirmed = 1;
                @endphp
                @foreach($data->reservation as $res)
                    @if($res->status == 1)
                        @php
                            $countPending++
                        @endphp
                    @elseif($res->status == 2)
                        @php
                            $countConfirmed++
                        @endphp
                    @endif
                @endforeach

                <div class="row col-md-12">
                    <div class="col-md-3" style="padding-right: 0px!important;">
                        <a class="anchorColor" href="{{route('user-display-service', ['id' => $data->id])}}">
                            <img class="img-thumbnail" src="{{Request::root()}}/assets/service/{{$data->thumbnail}}" style="max-width: 95%">
                        </a>
                    </div>
                    <div class="col-md-8 mt-1" style="padding-left: 0px!important;">
                        <div class="row col-md-12">
                            <a class="col-md-12 text-14" href="{{route('user-display-service', ['id' => $data->id])}}" style="font-weight: bold; padding-left: 0px!important;">{{$data->title}}</a>
                            @if($data->free_mint_iteration > 0)
                                <div class="mb-2" style="font-size: 12px; height: auto;">お試し通話機能あり（開始から{{$data->free_min}}分までを{{$data->free_mint_iteration}}回無料）</div>
                            @endif
                            <div class="col-md-8 p-0">
                                @if($countPending > 0)
                                    <div style="" class="anchorColor" onclick="show_res_req({{$data->id}})">予約通知{{$countPending}}件</div>
                                @else
                                    <div style="">予約通知{{$countPending}}件</div>
                                @endif

                                @if($countConfirmed > 0)
                                    <div style="" class="anchorColor" onclick="show_accepted_res({{$data->id}})">電話受付予約{{$countConfirmed}}件</div>
                                @else
                                    <div style="">電話受付予約{{$countConfirmed}}件</div>
                                @endif
                            </div>
                            <div class="col-md-4 text-right p-0">
                                <span style="font-size: 35px">{{$data->price}}</span><span>円 / 分</span>
                            </div>
                            <a href="{{route('service-history', ['id' => $data->id])}}" style="border: 2px solid #0000FF"><span class="my-buttons ml-1 mr-1">電話受付履歴</span></a>
                            &nbsp &nbsp
                            <a href="{{route('edit-service', ['id' => $data->id])}}" style="border: 2px solid #0000FF"><span class="my-buttons ml-1 mr-1">更新・編集</span></a>
                        </div>
                    </div>
                    <div class="col-md-12 justify-content-start">
                        <hr style="height:1px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40)" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <div class="w3-container">
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
                <input type="hidden" id="scroll_flag" name="scroll_flag" value= 0 />
                    <div class="w3-section p-4" id="conversation" style="height: 300px; overflow-y: auto">
                    </div>
            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey text-center">
                <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red buttons btn-size">Ok</button>
            </div>

            </div>
        </div>
    </div>

    <div class="w3-container">
        <div id="id02" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
                <input type="hidden" id="scroll_flag" name="scroll_flag" value= 0 />
                    <div class="w3-section p-4" id="accepted_req" style="height: 300px; overflow-y: auto">
                        
                    </div>
    
                
            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey text-center">
                <button onclick="document.getElementById('id02').style.display='none'" type="button" class="w3-button w3-red buttons btn-size">Ok</button>
            </div>

            </div>
        </div>
    </div>
@stop



@section('custom_js')
<script>
    function select_res_req(){
        var selectedOption = $("input:radio[name=option_req]:checked").val()
        var ajaxurl = "{{route('accept-reservation-request')}}";
        var result = confirm("予約を決定でよろしいですか！");
        if (result) {
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'selectedOption': selectedOption
                },
                success: function(data){
                    // console.log(data);
                    // $data = $(data);
                    // show_res_req($data);
                    // var element = document.getElementById("conversation");
                    // element.scrollTop = element.scrollHeight;
                    document.getElementById('id01').style.display='none';
                    location.reload();
                },
                complete: function (data) {    
                }
            });
        }
    }

    function cancelConfirmedReservation(id2){
        var reservation_id = id2;
        var ajaxurl = "{{route('cancel-confirmed-Reservation-request')}}";
        var result = confirm("予約をキャンセルでよろしいですか！");
        if (result) {
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'reservation_id': reservation_id
                },
                success: function(data){
                    // console.log(data);
                    // $data = $(data);
                    // show_res_req($data);
                    // var element = document.getElementById("conversation");
                    // element.scrollTop = element.scrollHeight;
                    document.getElementById('id01').style.display='none';
                    location.reload();
                },
                complete: function (data) {    
                }
            });
        }
        
    }

    function cancelReservation(id2){
        var reservation_id = id2;
        var ajaxurl = "{{route('cancel-reservation-request')}}";
        var result = confirm("予約受付を取消します、よろしいですか！");
        if (result) {
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'reservation_id': reservation_id
                },
                success: function(data){
                    // console.log(data);
                    // $data = $(data);
                    // show_res_req($data);
                    // var element = document.getElementById("conversation");
                    // element.scrollTop = element.scrollHeight;
                    document.getElementById('id01').style.display='none';
                    location.reload();
                },
                complete: function (data) {    
                }
            });
        }
        
    }

    function show_res_req(id1){
        var service_id = id1;
      
        document.getElementById('id01').style.display='block';
        var ajaxurl = "{{route('user-get-reservation')}}";
        
        $.ajax({
            url: ajaxurl,
            type: "GET",
            data: {
                    '_token': "{{ csrf_token() }}",
                    'service_id': service_id
            },
            success: function(data){
                    $data = $(data); // the HTML content that controller has produced
                    {{--$('#item-container').hide().html($data).fadeIn();--}}
                    $('#conversation').html($data);
                    //setTimeout(doAjax, interval);
                    if($('#scroll_flag').val() == 0){
                        updateScroll();
                    }
            },
            complete: function (data) {
                    // Schedule the next
                    
            }
        });
    }

    function show_accepted_res(s_id){
        var service_id = s_id;
        document.getElementById('id02').style.display='block';
        var ajaxurl = "{{route('show-accepted-reservation')}}";
        
        $.ajax({
            url: ajaxurl,
            type: "GET",
            data: {
                    '_token': "{{ csrf_token() }}",
                    'service_id': service_id
            },
            success: function(data){
                    $data = $(data); // the HTML content that controller has produced
                    $('#accepted_req').html($data);
                    //setTimeout(doAjax, interval);
                    if($('#scroll_flag').val() == 0){
                        update2Scroll();
                    }
            },
            complete: function (data) {
                    // Schedule the next
                    
            }
        });
    }

    function updateScroll(){
        var element = document.getElementById("conversation");
        element.scrollTop = element.scrollHeight;
        setTimeout(function(){ 
            $('#scroll_flag').val(1); 
            }, 
        6000);
        
    }
    function update2Scroll(){
        var element = document.getElementById("accepted_req");
        element.scrollTop = element.scrollHeight;
        setTimeout(function(){ 
            $('#scroll_flag').val(1); 
            }, 
        6000);
        
    }
</script>

@stop


