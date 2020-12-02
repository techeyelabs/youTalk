@extends('navbar')

@section('custom_css')
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }  

        .my-button{
            padding: 5px;
            background-color: white;
            border: 1px solid gray;
            box-shadow: 2px 2px #cccccc;
            border-radius: 4px;
            width: 225px;
            height: 45px;
            font-size: 16px;
        } 
    </style>
@stop   


@section('content')
<div class="col-md-12 alternates" style="min-height: 850px">
    <div class="col-md-12 col-sm-12 p-0">
        <div class="col-md-12 mb-3">
            <div class="mb-2"><span style="font-size: 16px;">電話通話内容</span></div>
            <div class="p-2 text-14" style="border: 2px solid rgba(158, 148, 148, 0.5);">
                <div class="col-md-12 row pl-3" style=""><a class="anchorColor" href="{{route('user-display-service', ['id' => $talkroom->service->id])}}"><h6>{{$talkroom->service->title}}</h6></a></div>
                <div class="row pl-3">
                    <div class="col-md-8 p-0">
                        <div style="height: 30px;">無料通話回数{{$talkroom->service->free_mint_iteration}}回（毎回{{$talkroom->service->free_min}}分)</div>
                        <div style=""><a class="anchorColor" href="{{route('user-page-profile', ['id' => $talkroom->seller_id])}}">{{$talkroom->seller->name}} {{$talkroom->seller->last_name}}</a></div>
                    </div>
                    <div class="col-md-4 text-center p-0">
                        <span style="font-size: 35px">{{$talkroom->service->price}}</span><span>円 / 分</span>
                    </div>
                </div>  
            </div>
            
        </div>

        <div class="col-md-8 mb-5 text-14">
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
                            <td style="width: 65%">通話時間</td>
                            <td style="width: 35%">{{$talkroom->free_mint}}分</td>
                        </tr>
                    </table>
                </div>
                <div class="" style="">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 65%; border: none">通話料</td>
                            <td style="width: 35%; border: none">{{$talkroom->cost}}円</td>
                        </tr>
                    </table>
                </div>
            </div>
            
        </div>

        <div class="col-md-12">
            <div class="p-2 message-wrapper" style="border: 2px solid rgba(158, 148, 148, 0.5); height: 600px; overflow-y:auto">
                <div class="user-wrapper p-0 text-14" id="messages" >

                </div>
                
            </div>
            
        </div>

        <div class="col-md-12 my-3">
            <div class="p-2" style="border: 2px solid rgba(158, 148, 148, 0.5)">
                <div class="mb-2 col-md-12 text-center" style="font-size: 14px"><span>トークルーム終了</span></div>
                @if($talkroom->review_status == 1 && $talkroom->seller_id != Auth::user()->id)
                    <div class="row">
                        <div class="col text-center mb-2">
                            <button id="start_call" class="my-button" data-toggle="modal" data-target="#myModal">出品者の評価を入力</button>
                        </div>
                    </div>  
                @endif
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
                        <div style="font-size: 16px"><span>評価</span></div>
                        <div id="star_error" style="font-size: 10px; color: red; display: none"><span>星を選択してください！</span></div>
                        <form id="post_review_form" action="{{route('review')}}" method="post">
                            {{ csrf_field() }}
                            
                            <div class="rate pl-0">
                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                                <input type="radio" id="star6" name="rate" value="0"  style="display: none" checked/>
                            </div>
                            
                        </div>
                        <div class="col-md-12 mt-2">
                            <input type="hidden" name="talkroom_id" value="{{$talkroom->id}}">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1"><span style="font-size: 16px">評価本文</span></label>
                                <textarea class="form-control rounded-0" id="review" name="review" placeholder="レビューを書く..." rows="10"></textarea>
                            </div>
                            
                        </form>
                            <div class="col-md-12 text-center">
                                <button id="post_review" class="btn buttons btn-size" style="margin-top: 10px">送信</button>
                            </div>
                        
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

</div>    
               
           
        
@stop



@section('custom_js')

<script>
    var seller_id = "{{$talkroom->seller_id}}";
    var buyer_id = "{{$talkroom->buyer_id}}";
    var talkroom_id = "{{$talkroom->id}}";

    var ajaxurl = "{{route('get-message-talkroom')}}";
    function doAjax() {
    $.ajax({
            url: ajaxurl,
            type: "GET",
            data: {
                    '_token': "{{ csrf_token() }}",
                    'sender': buyer_id,
                    'receiver': seller_id,
                    'talkroom': talkroom_id,
                    cache: false,
            },
            success: function(data){
                
                $('#messages').html(data);
                scrollToBottomFunc();
                    
            },
    });
    }

    doAjax();

    function scrollToBottomFunc(){
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        },50);
    }

    $(document).ready(function(){

        $('#send_message').click(function(){
            var flag = 0;

            if($('#message').val() == '' || $('#message').val() == null){
                flag = 1;
                $('#message_error').show();
            }

            if(flag == 0){
                if(confirm("こちらの内容でよろしいですか！")){
                    $("#post_message_form").submit();
                }
            }
        });

        $('#post_review').click(function(){
            var flag = 0;

            var radioValue = $("input[name='rate']:checked"). val();
            console.log(radioValue);
            if(radioValue == 0){
                flag = 1;
                $('#star_error').show();
            }

            if(flag == 0){
                if(confirm("こちらの内容でよろしいですか！")){
                    $("#post_review_form").submit();
                }
            }
        });
    });
</script>

@stop