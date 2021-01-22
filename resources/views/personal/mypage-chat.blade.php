@extends('navbar')

@section('custom_css')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@stop


@section('content')
    <div class="col-md-12 row">
    @php $index = 1; @endphp
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center">
            <table style="width: 100%">
            <tbody>
                <tr>
                    <td></td>
                    <td style="text-align: left">メッセージ一覧</td>
                </tr>
                @foreach($messages as $th)
                    @if($th->other_side == 0)
                        <tr onclick="show_conv({{Auth::user()->id}}, 0, '管理者')">
                            <td><img style="border-radius: 50%; height: 50px; width: 50px" src="{{Request::root().'/assets/systemimg/admin.png'}}"/></td>
                            <td  style="width: 65%; font-size: 16px; color: gray; cursor: pointer; vertical-align: middle; text-align: left">
                                <span id="{{$th->other_side}}" class="badge badge-pill badge-primary badge-noti" style="margin-bottom:-10px;display: none; margin-top: 0px !important">0</span>
                                <span class="anchorColor">管理者メッセージ</span>
                            </td>
                        </tr>
                    @else
                        <tr onclick="show_conv({{Auth::user()->id}}, {{$th->other_side}}, '{{$th->threads_all->name}}')">
                            <td style="width: 35%; text-align: center"><img style="border-radius: 50%; height: 50px; width: 50px;" src="{{Request::root().'/assets/user/'.$th->threads_all->profile->picture}}" >&nbsp;</td>
                            <td  style="width: 65%; font-size: 16px; color: gray; cursor: pointer; vertical-align: middle; text-align: left">
                                <span id="{{$th->other_side}}" class="badge badge-pill badge-primary badge-noti" style="margin-bottom:-10px;display: none; margin-top: 0px !important">0</span>
                                <span class="anchorColor">{{$th->threads_all->name}}</span>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/>
    <br/>
    <br/>
    <div class="w3-container">
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
                <input type="hidden" id="scroll_flag" name="scroll_flag" value= 0 />
                <div class="row modal-header w3-light-grey">
                    <div class="col-md-11">
                        <h4 class="text-center" id="name"></h4>
                    </div>
                    <div class="col-md-1">
                        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button text-danger font-weight-bold">X</button>
                    </div>
                </div>
                <form class="w3-container" action="{{route('send-message')}}" method="post">
                    <div class="w3-section p-4" id="conversation" style="height: 300px; overflow-y: auto">
                    </div>
                    <div style="padding: 20px">

                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input type="hidden" id="sender" name="sender"/>
                        <input type="hidden" id="receiver" name="receiver"/>
                        <textarea id="message_text" name="message_text" style="border: 1px solid #a8c2ce; width: 100%; border-radius: 10px; padding: 10px"></textarea>
                    </div>
                </form>
                <div class="button_div">
                    <button class="msg_send_button" id="send_message" onclick="send_msg()">Send</button>
                </div>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <h4></h4>
                </div>
            </div>
        </div>
    </div>
@stop



@section('custom_js')
<script>
    function show_conv(id1, id2, name){
        var from = id1;
        var to = id2;
        $('#sender').val(from);
		$('#receiver').val(to);
		$('#name').html(name);
        $('#conversation').html(' ');
        document.getElementById('id01').style.display='block';
    }

    let modal = document.getElementById('id01');
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>
    function send_msg()
    {
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
</script>
<script>
    var interval = 500;  // 1000 = 1 second, 3000 = 3 seconds
    var flag = 0;
    function doAjax() {
        var from = $('#sender').val();
        var to = $('#receiver').val();
        let readStatus = 0;
        if($('#id01').css('display') === 'block'){
            readStatus = 1;
        }
		
        var ajaxurl = "{{route('user-get-conversation')}}";

        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                    '_token': "{{ csrf_token() }}",
                    'from': from,
                    'to': to,
                    'readStatus': readStatus
            },
            success: function(data){
                    $data = $(data); // the HTML content that controller has produced
                    {{--$('#item-container').hide().html($data).fadeIn();--}}
                    $('#conversation').html($data);
                    setTimeout(doAjax, interval);
                    if($('#scroll_flag').val() == 0){ 
                        updateScroll();
                        //scrollToBottomFunc();
                    }
                    
                    // else if($('#id01').style.display == 'none'){
                    //     scrollToBottomFunc();
                    // }
            },
            complete: function (data) {
                    // Schedule the next
                    
            }
        });
    }
    setTimeout(doAjax, interval);

    // function scrollToBottomFunc(){
    //     $('#conversation').animate({
    //         scrollTop: $('#conversation').get(0).scrollHeight
    //     },50);
    // }

    function updateScroll(){
        var element = document.getElementById("conversation");
        element.scrollTop = element.scrollHeight;
        //$('#scroll_flag').val(1);
        setTimeout(function(){ 
            $('#scroll_flag').val(1); 
            }, 
        6000);
    }

    function modalDisplayNone(){
        //$('#id01').style.display = 'block'
        $('#conversation').html(' ');
        document.getElementById('id01').style.display='none';
    }
</script>

<script>
    function unread_count()
    {
        var threads = @json($messages);
        threads.forEach(element => {
            var ajaxurl = "{{route('unread-count-ind')}}";
            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                        '_token': "{{ csrf_token() }}",
                        'sender': element.other_side,
                },
                success: function(data){
                    if(data > 0){
                        $('#' + element.other_side).html(data);
                        $('#' + element.other_side).show();
                    }
                },
            });
        });
        return;
    }

    $(document).ready(function(){
        all_notification();
        unread_count();
    });
</script>
@stop