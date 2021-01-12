@extends('navbar')

@section('custom_css')
<style>
    .reply_button{
        background-color: #FFFFFF;
        color: #7f9098;
        border-radius: 4px;
        padding: 5px;
        box-shadow: 1px 1px 1px 1px #7f9098;
        width: 140px !important;
    }
    .buttons{
        border: 1px solid #ffffff;;
        border-radius: 4px;
        background-color: #ffffff;;
        width: 150px;
        padding: 5px;
        box-shadow: 2px 2px #7f9098;
        border: 1px solid #ececec
    }
    .button-before-login{
        border: 1px solid #ffffff;;
        border-radius: 4px;
        background-color: #949ea2;
        width:70%;
        padding: 5px;
        height:40px;
        box-shadow: 1px 1px #7f9098;
        font-size:18px;
    }
    .button_holder{
        /* border: 1px solid #e0e0e0; */
        padding-top: 0px;
        padding-bottom: 0px;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    .button_div{
        width: 100%; 
        text-align: center; 
        padding: 20px
    }
    .msg_send_button{
        padding: 6px;
        border: 1px solid #618ca9;
        background-color: #618ca9;
        border-radius: 25px;
        color: white;
        width: 100px;
        cursor: pointer
    }
    .chat_button{
        border: 1px solid #d4d4d4;
        background-color: #eaeaea;
        border-radius: 4px;
        box-shadow: 1px 1px grey;
        outline: none !important;
    } 
  /* image resize */
  .profile-image{
            max-height: 303px!important;
            margin-left: -5px;

        }
        .frame {
            height: 305px;      /* equals max image height */
            width: auto;
            border: 1px solid #cccccc;
            white-space: nowrap;
            text-align: center;
        }
        .helper {
            display: inline-block;
            height: 100%;
            vertical-align: middle;
        }
        .button-before-login{
            border: 1px solid #64b7f9;
            border-radius: 4px;
            background-color: #949ea2;
            width:100%;
            padding: 5px;
            height:43px;
            box-shadow: 1px 1px #7f9098;
            font-size:22px;
        }
        .price-before-login{
            font-size:37px;
        }
        .margin-bottom-before-login{
            margin-bottom: 30px!important;
        }
        .price-after-login{
            font-size:35px;
        }
        .margin-bottom-after-login{
            margin-bottom: 35px!important;
        }

    
        /*---------- general ----------*/


        .stars-outer {
        display: inline-block;
        position: relative;
        font-family: FontAwesome;
        }

        .stars-outer::before {
        content: "\f006 \f006 \f006 \f006 \f006";
        }

        .stars-inner {
        position: absolute;
        top: 0;
        left: 0;
        white-space: nowrap;
        overflow: hidden;
        width: 0;
        }

        .stars-inner::before {
        content: "\f005 \f005 \f005 \f005 \f005";
        color: #f8ce0b;
        }

        .attribution {
        font-size: 12px;
        color: #444;
        text-decoration: none;
        text-align: center;
        position: fixed;
        right: 10px;
        bottom: 10px;
        z-index: -1;
        }
        .attribution:hover {
        color: #1fa67a;
        }

        button:focus,
        textarea:focus,
        select:focus,
        input:focus {
            outline: 0 !important;
        }

        .form-control:focus {
            border-color: #ccc;
            -webkit-box-shadow: none;
            box-shadow: none;
        }




</style>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@stop

@section('content')
<div class=" row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @include('message')
    </div>
    <div class="col-md-2"></div>
</div>
    <div class="col-md-12 alternates px-0 remove-pads" style="min-height: 850px">
        <div class="row col-md-12">
            <div class="col-md-8">
                <div class="text-center title-before-login " style="font-size: 18px"><b>{{$service->title}}</b></div>
                @if($service->free_mint_iteration > 0)
                    <div class="text-center description-before-login" style="font-size: 15px;">お試し通話機能あり（開始から{{$service->free_min}}分までを{{$service->free_mint_iteration}}回無料）</div>
                @endif
            </div>
            <div class="col-md-4 justify-content-end">
                @if(isset(Auth::user()->id))
                    @if($service->seller_id != Auth::user()->id)
                        <div class="text-right description-before-login anchorColor" style="font-size: 15px;">
                            <a href="{{route('user-page-profile', ['id' => $service->seller_id])}}">
                                {{$service->createdBy->name}}{{$service->createdBy->last_name}}
                                <img src="{{Request::root()}}/assets/user/{{$service->createdBy->profile->picture}}" style="height: 35px; width: 35px; border-radius: 50%"/>
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="col-md-12 px-0">
            <div class="row col-md-12 mt-4 align-items-end">
                <div class="col-xs-12 col-lg-6 text-lg-left text-center">
                    <img class="img-thumbnail thumb profile-image" src="{{Request::root()}}/assets/service/{{$service->thumbnail}}">
                </div>
                @if(isset(Auth::user()->id))
                    <div class="col-xs-12 col-lg-6">
                        <div class="text-right ">
                            <div class="mb-2 margin-bottom-after-login price-after-login"><span style="font-size: 42px">{{$service->price}}</span> <span style="font-size: 15px !important">円 / 分</span></div>
                            
                            @if($service->seller_id == Auth::user()->id && $service->seller_status == 1)
                                @if($call_possible_seller > 0 || $call_possible_buyer > 0)
                                <button type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important;color:white">電話中</button>
                                @else
                                <form action="{{route('change-status', ['stat' => 2, 'id' => $service->id])}}"><button type="submit" class="buttons button-before-login" style="background-color: #92D050 !important;color:white">📞 電話受付OFFする</button></form>
                                @endif
                                
                            @elseif($service->seller_id == Auth::user()->id && $service->seller_status == 2)
                                @if($call_possible_seller > 0 || $call_possible_buyer > 0)
                                <button type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important;color:white">電話中</button>
                                @else 
                                <form action="{{route('change-status', ['stat' => 1, 'id' => $service->id])}}"><button type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important;color:white">🚫 電話受付ONする</button></form>
                                @endif
                            @elseif($service->seller_id != Auth::user()->id && $service->seller_status == 1)
                                @if($call_possible_seller > 0 || $call_possible_buyer > 0)
                                <button id="" type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important;color:white">電話中</button>
                                @else 
                                <form action="{{route('payment-method', ['id' => $service->id])}}"><button id="" type="submit" class="buttons button-before-login" style="background-color: #92D050 !important;color:white">📞 電話する</button></form>
                                @endif
                            @else
                                <button type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important;color:white">🚫 電話する</button>
                            @endif

                            <div class="after-login-br" style="height: 30px"><br/></div>
                            @if($service->seller_id == Auth::user()->id && $service->reservation_status == 1)
                                <form action="{{route('change-reservation', ['stat' => 2, 'id' => $service->id])}}"><button type="submit" class="buttons button-before-login" style="background-color: #9DC3E6 !important">🗓 予約受付OFFする</button></form>
                            @elseif($service->seller_id == Auth::user()->id && $service->reservation_status == 2)
                                <form action="{{route('change-reservation', ['stat' => 1, 'id' => $service->id])}}"><button type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important">🚫 予約受付ONする</button></form>
                            @elseif($service->seller_id != Auth::user()->id && $service->reservation_status == 1)
                                <form action="{{route('make-reservation', ['id' => $service->id])}}">
                                    <button type="submit" class="buttons button-before-login" style="background-color: #9DC3E6 !important; color:white">🗓 電話予約する</button>
                                </form>
                            @else
                                <button type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important; color:white">🚫 電話予約する</button>
                            @endif

                            <div class="after-login-br" style="height: 30px; text-align: right"><br class="before-login-br"></div>
                            @if($service->seller_id != Auth::user()->id)
                                <div>
                                    <button type="submit" onclick="show_conv({{Auth::user()->id}}, {{$service->createdBy->id}})" class="button-before-login" style="background-color: #84bdb8; color: white; border: 1px solid #84bdb8">メッセージをする</button>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="col-md-5 text-center button_holder" >
                        <br>
                        <div class="mb-3 margin-bottom-before-login price-before-login" ><span style="font-size: 42px">{{$service->price}}</span> <span style="font-size: 15px !important">円 / 分</span></div>
                        
                        @if($service->seller_status == 1)
                            <form action="{{route('service-login', ['id' => $service->id])}}"><button id="" type="submit" class="buttons button-before-login" style="background-color: #92D050 !important;color:white">📞 電話する</button></form>
                        @else
                            <button type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important;color:white">🚫 電話する</button>
                        @endif

                        <div class="after-login-br" style="height: 30px"><br/></div>
                        @if($service->reservation_status == 1)
                            <form action="{{route('service-login', ['id' => $service->id])}}">
                                <button type="submit" class="buttons button-before-login" style="background-color: #9DC3E6 !important; color:white">🗓 電話予約する</button>
                            </form>
                        @else
                            <button type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important; color:white">🚫 電話予約する</button>
                        @endif
                        
                        <div class="after-login-br" style="height: 30px; text-align: right"><br class="before-login-br"></div>
                        <a href="{{route('service-login', ['id' => $service->id])}}" style="background-color: #FFFF00 !important; color:white"><button type="submit" class="button-before-login" style="background-color: #84bdb8; color: white; border: 1px solid #84bdb8">メッセージをする</button></a>
                    </div>
                    
                @endif
            </div>

            <div class="row mt-5">
                <div class="col-md-12" style="font-size: 16px; text-align:justify">
                    {{-- {!! strip_tags($service->details) !!} --}}
                    @php
                        print($service->details)
                    @endphp
                    
                </div>
            </div>

            {{-- <div class="col-md-8 mt-4">
                 <div class="mb-5 description-before-login" id="details" style="font-size: 16px">
                    <span>
                        {!!nl2br($service->details)!!}
                    </span>
                </div>
            </div> --}}
            <!-- body and seller intro -->
            <div class="col-md-12 row mt-4">
               
            </div>

            @if($reviews->count() > 0)
                <div class="col-md-12 my-5">
                    <h5>評価&nbsp;⭐️&nbsp;&nbsp;{{$avg_rating}} ({{$total_ratings}})</h5>
                        <div class="p-3 mb-4" style="border: 2px solid rgba(158, 148, 148, 0.5)">
                            @foreach($reviews as $k => $review)
                                <div class="row col-md-12 p-0" style="word-break: break-all;">
                                    <div class="col-md-6 pl-0">
                                        <span style="font-size: 18px">
                                            @php
                                                $starTotal = 5;
                                                $starPercentage = $review->rating / $starTotal * 100; 
                                                $starPercentage = $starPercentage."%";
                                            @endphp
                                            <div class="stars-outer">
                                                <div class="stars-inner" style="width:{{$starPercentage}}"></div>
                                            </div>
                                        </span>
                                        <span style="font-size: 10px">
                                            {{"by ".$review->buyer->name}} {{$review->buyer->last_name}}
                                        </span>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4 text-right pl-0">
                                        @php 
                                            $date_timestamp = strtotime($review->created_at);  
                                            $day = date("d", $date_timestamp);
                                            $month = date("m", $date_timestamp);
                                            $year = date("Y", $date_timestamp);
                                            $time = date("H:i:s", $date_timestamp);
                                        @endphp
                                        <span style="font-size: 10px"><p>{{$year}}年{{$month}}月{{$day}}日   {{$time}}</p></span>
                                    
                                    </div>
                                </div>
                                
            
                                <div class="row col-md-12 p-0 mb-3" style="word-break: break-all;">
                                    <div class="col-md-12 p-1 mb-3" style="font-size: 12px; text-align:justify">
                                        {!!nl2br($review->review)!!}                 
                                    </div>
                                    <div class="col-md-12 sp-leftpad-review" style="font-size: 16px; text-align:justify; padding-left:100px">

                                        @if(isset(Auth::user()->id))
                                            @if($service->seller_id == Auth::user()->id)
                                                @if($review->reply == '')
                                                <div class="text-right mb-2">
                                                    <button id="reply" onclick="replyButton({{$review->id}})" class="btn reply_button" data-toggle="modal" data-target="#myModal">返信する</button>
                                                </div>
                                                @else 
                                                    <div class="row col-md-12 pl-0 pr-0" style="height: 20px">
                                                        <div class="col-md-6 pl-0">
                                                            <a class="anchorColor" style="font-size: 10px" href="{{route('user-page-profile', ['id' => $review->seller_id])}}">{{"by ".$review->seller->name}} {{$review->seller->last_name}}</a>
                                                        </div>
                                                        <div class="col-md-6 text-right pr-0">
                                                            @php 
                                                            $date_timestamp = strtotime($review->updated_at);  
                                                            $day = date("d", $date_timestamp);
                                                            $month = date("m", $date_timestamp);
                                                            $year = date("Y", $date_timestamp);
                                                            $time = date("H:i:s", $date_timestamp);
                                                            @endphp
                                                            <span style="font-size: 10px"><p>{{$year}}年{{$month}}月{{$day}}日   {{$time}}</p></span>
                                                        </div>
                                                        <div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <span style="font-size: 12px">
                                                            {!!nl2br($review->reply)!!}
                                                        </span>
                                                    </div>
                                                @endif
                                            @else 
                                                @if($review->reply == '')
                                                
                                                @else 
                                                <div class="row col-md-12 pl-0 pr-0" style="height: 20px">
                                                    <div class="col-md-6 pl-0">
                                                        <a class="anchorColor" style="font-size: 10px" href="{{route('user-page-profile', ['id' => $review->seller_id])}}">by {{$review->seller->name}} {{$review->seller->last_name}}</a>
                                                    </div>
                                                    <div class="col-md-6 text-right pr-0">
                                                        @php 
                                                        $date_timestamp = strtotime($review->updated_at);  
                                                        $day = date("d", $date_timestamp);
                                                        $month = date("m", $date_timestamp);
                                                        $year = date("Y", $date_timestamp);
                                                        $time = date("H:i:s", $date_timestamp);
                                                        @endphp
                                                        <span style="font-size: 10px"><p>{{$year}}年{{$month}}月{{$day}}日   {{$time}}</p></span>
                                                    </div>
                                                </div>
                                                <div class="pt-4">
                                                    <span style="font-size: 12px">{!!nl2br($review->reply)!!}</span>
                                                </div>
                                                
                                                @endif
                                            @endif
                                        @endif
                                                        
                                    </div>
                                </div>
                                @if($k < sizeof($reviews) - 1)
                                <hr style="height:2px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40); margin:10px 0px" />
                                @endif
                            @endforeach
                            
                        </div>
                </div>
            @endif
        </div>
    </div>
    
    <div class="w3-container">
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
            <input type="hidden" id="scroll_flag" name="scroll_flag" value= 0 />
            <form class="w3-container" action="{{route('send-message')}}" method="post">
                <div class="w3-section p-4" id="conversation" style="height: 300px; overflow-y: auto">
                    <span></span>
                </div>
                <div style="padding: 20px">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <input type="hidden" id="sender" name="sender"/>
                    <input type="hidden" id="receiver" name="receiver"/>
                    <textarea id="message_text" name="message_text" style="border: 1px solid #a8c2ce; width: 100%; border-radius: 10px; padding: 10px"></textarea>
                </div>
            </form>
            <div class="button_div"><button class="msg_send_button" type="submit" id="send_message" onclick="send_msg()">send</button></div>

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
            </div>

            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                   
                    <div class="col-md-12 mt-2">
                        <form id="post_reply_form" action="{{route('reply')}}" method="post">
                            {{ csrf_field() }}
                            <input id="review" type="hidden" name="review_id" value="">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1"><h6>コメントに返信</h6></label>
                                <textarea class="form-control rounded-0" id="replying" name="reply" placeholder="コメントを書く．．" rows="10"></textarea>
                                <div id="reply_error" style="font-size: 10px; color: red; display: none"><span>コメントを入力してください。</span></div>
                            </div>
                        </form>
                        <div class="col-md-12 text-center">
                            <button id="post_reply" class="btn buttons btn-size" style="margin-top: 10px">送信</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
@stop



@section('custom_js')


<script type="text/javascript">

    function replyButton(r_id){
        //console.log("shiam");
        //var review_id = $('#reply').attr('name');
        console.log(r_id);
        $('#review').val(r_id);
    }

    $('#post_reply').click(function(){
        //console.log('from from:');
        //var name = $('#review').val();
        console.log($('#replying').val());
        var flag = 0;
        if($('#replying').val() == '' || $('#replying').val() == null){
            $('#reply_error').show();
            flag = 1;
        }
        if(flag == 0){
            if(confirm("こちらの内容でよろしいですか！")){
                $("#post_reply_form").submit();
            }
        }
    });
    
    options.callback_url = '{{request()->root()}}/service-terminate-kick';
    options.callback_data = {
        id: 1,
        name: 'test',
        serviceId: '{{$service->id}}',
        sellerId: '{{$service->createdBy->id}}',
        buyerId: '{!!isset(Auth::user()->id)?Auth::user()->id:1!!}',
        price: '{{$service->price}}'
    };
    
    
    document.getElementById('call').addEventListener('click', () => {
        let options = {
            id: '{{$service->createdBy->id}}',
            name: '{{$service->createdBy->first_name.' '.$service->createdBy->last_name}}',
            pic: ''
        }
        chat.call(options);
    });
</script>

<!-- text chat -->
<script>
    function show_conv(id1, id2){
        var from = id1;
        var to = id2;
        $('#sender').val(from);
		$('#receiver').val(to);
      
        document.getElementById('id01').style.display='block'
    }
</script>

<!-- frequent ajax calls -->
<script>
    var interval = 1000;  // 1000 = 1 second, 3000 = 3 seconds
    var flag = 0;
    function doAjax() {
        console.log("here");
        var from = $('#sender').val();
        var to = $('#receiver').val();
		
        var ajaxurl = "{{route('user-get-conversation')}}";
        {{--ajaxurl = ajaxurl.replace(':id1', from);
        ajaxurl = ajaxurl.replace(':id2', to);
        alert(ajaxurl);--}}
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                    '_token': "{{ csrf_token() }}",
                    'from': from,
                    'to': to 
            },
            success: function(data){
                    $data = $(data); // the HTML content that controller has produced
                    {{--$('#item-container').hide().html($data).fadeIn();--}}
                    $('#conversation').html($data);
                    setTimeout(doAjax, interval);
                    if($('#scroll_flag').val() == 0){
                        updateScroll();
                    }
            },
            complete: function (data) {
                    // Schedule the next
                    
            }
        });
    }
    setTimeout(doAjax, interval);

    function send_msg(){
        var ajaxurl = "{{route('send-message')}}";
        var sender = $('#sender').val();
        var receiver = $('#receiver').val();
        var message_text = $('#message_text').val();
        if(message_text == '')
            return;
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                    '_token': "{{ csrf_token() }}",
                    'sender': sender,
                    'receiver': receiver, 
                    'message_text': message_text 
            },
            success: function(data){
                $('#message_text').val('');
                var element = document.getElementById("conversation");
                element.scrollTop = element.scrollHeight;
            },
            complete: function (data) {    
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
</script>
@stop