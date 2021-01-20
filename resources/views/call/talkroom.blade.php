@extends('navbar')

@section('custom_css')
@stop

@section('content')
<div class="col-md-12 alternates" style="min-height: 850px">
    <div class="col-md-12 col-sm-12" style="padding: 0px !important">
        <div class="col-md-12 mb-3 remove-pads">
            @if($talkroom->seller_id != Auth::user()->id)
                <div class="text-center pb-2">
                    <span class="text-16">出品者から電話がかかってきますので、この画面まましばらくお待ちください。</span>
                </div>
            @endif
            <div class="mb-2">
                <span class="text-16">電話通話内容</span>
            </div>
            @if($talkroom->seller_id == Auth::user()->id)
                <div class="pb-2">
                    <span class="text-16">購入者： {{$talkroom->buyer->name}}様</span>
                </div>
            @endif
            <div class="p-2 text-14" style="border: 2px solid rgba(158, 148, 148, 0.5)">
                <div class="col-md-12 row" style="font-size: 14px"><a class="anchorColor" href="{{route('user-display-service', ['id' => $talkroom->service->id])}}"><h6>{{$talkroom->service->title}}</h6></a></div>
                <div class="row pl-3">
                    <div class="col-md-8 p-0">
                        <div style="height: 30px;">無料通話回数{{$talkroom->service->free_mint_iteration}}回（毎回{{$talkroom->service->free_min}}分)</div>
                        <div style=""><a class="anchorColor" href="{{route('user-page-profile', ['id' => $talkroom->service->seller_id])}}">{{$talkroom->service->createdBy->name}} {{$talkroom->service->createdBy->last_name}}</a></div>
                    </div>
                    <div class="col-md-4 text-center p-0">
                        <span style="font-size: 35px">{{$talkroom->service->price}}</span><span> 円 / 分</span>
                    </div>
                </div>  
            </div>  
        </div>

        <div class="col-md-8 mb-3 text-14 remove-pads">
            <div class="p-2" style="border: 2px solid rgba(158, 148, 148, 0.5)">
                <div class="" style="">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 65%">通話時間</td>
                            <td style="width: 35%">{{$talkroom->duration}}分</td>
                        </tr>
                    </table>
                </div>
                <div class="" style="">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 65%">無料時間</td>
                            <td style="width: 35%">{{$talkroom->free_mint}}分</td>
                        </tr>
                    </table>
                </div>
                <div class="" style="">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 65%; border: none">通話料</td>
                            <td style="width: 35%; border: none">{{$talkroom->cost}}円</td>
                            <?php  
                                if($talkroom->available_mins > 0){
                            ?>
                                <input type="hidden" id="limit" name="limit" value="{{$talkroom->available_mins - $talkroom->duration}}" />
                            <?php       
                                } else {
                            ?>
                                <input type="hidden" id="limit" name="limit" value="" />
                            <?php } ?>
                        </tr>
                    </table>
                </div> 
            </div>
        </div>
        <div class="col-md-8 mb-3 text-16 remove-pads">
            <span>
                ※別のアプリでマイクを利用している場合、正常に通話できない場合があります。<br>一度、アプリを終了してから再度おかけなおしください。
            </span>
        </div>

        @if($talkroom->seller_id == Auth::user()->id)
            <div class="col-md-12 mb-5 text-center remove-pads">
                @if($talkroom->duration == $talkroom->available_mins && $talkroom->available_mins > 0)
                    <button id="" class="btn  buttons btn-size" style="margin-top: 10px; display: inline-block; width: 120px; margin-right: 5px" onclick="">電話する</button>
                @elseif($talkroom->call_status == 1 && $talkroom->if_call_disabled == 2)
                    <button id="start_call" class="btn  buttons btn-size" style="margin-top: 10px; display: inline-block; width: 120px; margin-right: 5px" onclick="">電話する</button>
                @else
                    <button id="" class="btn  buttons btn-size" style="margin-top: 10px; display: inline-block; width: 120px; margin-right: 5px" onclick="">電話する</button>
                @endif

                @if($talkroom->call_status == 1)
                    <form id="closeTalkroom" action="{{route('close-talk', ['id' => $talkroom->id])}}" style="display: inline-block">
                        <button id="closetalkroombtn" type="submit" class="btn  buttons btn-size" style="margin-top: 10px; width: 120px">終了する</button>
                    </form>
                @else
                    <button type="" class="btn  buttons btn-size" style="margin-top: 10px; width: 120px">終了する</button>
                @endif
            </div>
        @endif

        <div class="col-md-12 remove-pads">
            <div class="p-2 message-wrapper" style="border: 2px solid rgba(158, 148, 148, 0.5); height: 600px; overflow-y:auto">
                <div class="user-wrapper p-0" id="messages" >
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-5 mt-3 remove-pads">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 p-2" style="border: 2px solid rgba(158, 148, 148, 0.5)">
                    <form id="post_message_form" action="{{route('buyer-message')}}" method="post">
                        {{ csrf_field() }}
                        <textarea id="message" name="message" rows="6" placeholder="type your message here..." 
                        style="border: 1px solid #FFFFFF; width: 100%; border-radius: 10px"></textarea>
                        <div id="message_error" style="font-size: 15px; color: red; display: none; margin-bottom: 10px"><span>type message first</span></div>
                    </form>
                    <div class="col-md-12 text-center">
                        <button id="send_message" class="btn buttons btn-size" style="margin-top: 10px; width: 120px">送信</button>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body" style="background-color: #032035">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 mt-5">
                        <div class="text-center" style="color: white"><h4>User Name</h4></div>
                        <div class="text-center mt-3" style="font-size: 16px; color: white">Dialing...</div>
                        <div class="text-center" style="margin-top: 100px">
                            <img class="img-thumbnail thumb profile-image" style="width:130px; height:130px; border-radius: 50%" src="{{Request::root()}}/assets/service/s-4.jpeg">
                        </div>
                        <div class="text-center mb-5" style="margin-top: 80px">
                            <button class="btn btn-danger" style="width:50px; height:50px;border-radius: 50%" data-dismiss="modal">X</button>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
          </div>
        </div>
      </div>
</div>
        
@stop
@section('custom_js')

<script>
    // ajax setup form csrf token
        //  $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    // var pusher = new Pusher('c0f656a421f83a2c107a', {
    //     cluster: 'ap2',
    //     forceTLS: true
    // });

    // var channel = pusher.subscribe('my-channel');
    // channel.bind('my-event', function(data) {
    //     //console.log(data);
    // });
</script>


<script>
    $(document).ready(function () {
        $("#closeTalkroom").submit(function () {
            $("#closetalkroombtn").attr("disabled", true);
            return true;
        });
    });

    var auth_id = "{{ Auth::id() }}";
    var seller_id = "{{$talkroom->seller_id}}";
    var buyer_id = "{{$talkroom->buyer_id}}";
    var talkroom_id = "{{$talkroom->id}}";

    var flag2 = 0;

    console.log(auth_id);
    console.log(seller_id);
    console.log(buyer_id);

    if(auth_id == buyer_id){
        sender = buyer_id;
        receiver = seller_id;
    }else{
        sender = seller_id;
        receiver = buyer_id;
    }

    $('#send_message').click(function(){
        var flag = 0;

        if($('#message').val() == '' || $('#message').val() == null){
            flag = 1;
            $('#message_error').show();
        }else{
            $('#message_error').hide();
        }

        if(flag == 0){

                var ajaxurl = "{{route('buyer-message')}}";
                var message_text = $('#message').val();
                $('#message').val('');
                if(message_text == '')
                    return;
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                            '_token': "{{ csrf_token() }}",
                            'sender': sender,
                            'receiver': receiver,
                            'talkroom': talkroom_id, 
                            'message': message_text 
                    },
                    success: function(data){
                        flag2 = 0;
                    },
                    complete: function (data) {    
                    }
                });
            
        }
    });
    var temp = 0;
    
    function doAjax() {
        var ajaxurl = "{{route('get-message-talkroom')}}";
        $.ajax({
                url: ajaxurl,
                type: "GET",
                data: {
                        '_token': "{{ csrf_token() }}",
                        'sender': sender,
                        'receiver': receiver,
                        'talkroom': talkroom_id,
                        cache: false,
                },
                success: function(data){
                    $('#messages').html(data);
                    var val = $('#count').val();
                    
                    if(val > temp){
                        scrollToBottomFunc();
                        temp = val;
                    }
                    
                    if(flag2 == 0){
                        scrollToBottomFunc();
                        flag2 = 1;
                    }
                    
                    setTimeout(doAjax, 500);
                },
        });
    }

    doAjax();
    //setTimeout(doAjax, 1000);

    //Talkroom close refresh saga
    function closeRefresh() {
        var ajaxurl = "{{route('get-talkroom-status')}}";
        $.ajax({
                url: ajaxurl,
                type: "GET",
                data: {
                        '_token': "{{ csrf_token() }}",
                        'talkroom': talkroom_id,
                        cache: false,
                },
                success: function(data){
                    console.log(data.url);
                    if(data.status == 1){
                        console.log(data.status);
                        window.location = data.url;
                    } else if(data.call_status == 1) {
                        location.reload();
                    }
                    setTimeout(closeRefresh, 3000);
                },
        });
    }
    closeRefresh();

    function scrollToBottomFunc(){
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        },50);
    }
</script>


<!-- actual call -->
<script type="text/javascript">
    
    options.callback_url = '{{request()->root()}}/service-terminate-kick';
    options.callback_data = {
        id: 1,
        name: 'test',
        talkroom: '{{$talkroom->id}}',
        serviceId: '{{$talkroom->service->id}}',
        sellerId: '{{$talkroom->service->createdBy->id}}',
        buyerId: '{{$talkroom->buyer_id}}',
        price: '{{$talkroom->service->price}}',
    };
    

    function call_him(){
        var time_av = $('#limit').val();
        if(time_av != ''){
            var x = parseInt($('#limit').val());
            time_av = x * 60;
        } 
        let options = {
            id: '{{$talkroom->buyer_id}}',
            name: '{{$talkroom->buyer->name.' '.$talkroom->buyer->last_name}}',
            pic: '',
            limit: time_av
        }
        window.chat.call(options);
    };
</script>

<script>
    document.getElementById('start_call').addEventListener('click', () => {
        call_him();
    });
</script>

@stop