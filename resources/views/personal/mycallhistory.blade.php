@extends('navbar')

@section('custom_css')
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
    
    <div class="col-md-12 minHeight alternates">
        <div class="col-md-12 col-sm-12 remove-pads" style="">
            @if($totalReservation > 0)
            <a href="#" onclick="show_reservations({{$personal->id}})"><h6 class="text-center mb-4 text-danger">通話予約は {{$totalReservation}} 件あります!</h6></a>
            @else 
            @endif
            
            <h4 class="text-center mb-5">通話履歴</h4>
            @foreach ($history as $data)
                <div class="col-md-12 row pl-3" style="font-size: 16px"><a class="anchorColor" href="{{ route('talk-room-close', ['talkroom_id' => $data->id])}}">{{$data->service->title}}</a></div>
                
                <a class="anchorColor" href="{{ route('talk-room-close', ['talkroom_id' => $data->id])}}">
                    <div class="row pl-3 pr-3">
                        <div class="col-md-12 p-0">
                            @php 
                                $date_timestamp = strtotime($data->created_at);  
                                $day = date("d", $date_timestamp);
                                $month = date("m", $date_timestamp);
                                $year = date("Y", $date_timestamp);
                                $time = date("H:i:s", $date_timestamp);
                            @endphp
                            <div style="font-size: 16px">{{$year}} 年 {{$month}} 月 {{$day}} 日   {{$time}}</div>
                        </div>
                    </div>
                </a>
                <hr style="height:1px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40)" />      
            @endforeach
            
        </div>
    </div>


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
@stop

@section('custom_js')
<script>
    function show_reservations(id1){
        var reservation_id = id1;
        document.getElementById('id01').style.display='block';
        var ajaxurl = "{{route('user-reservations')}}";
        
        $.ajax({
            url: ajaxurl,
            type: "GET",
            data: {
                '_token': "{{ csrf_token() }}",
                'reservation_id': reservation_id
            },
            success: function(data){
                $data = $(data); // the HTML content that controller has produced
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

    function cancelReservation(id2){
        var reservation_id = id2;
        var ajaxurl = "{{route('cancel-reservation')}}";
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
                    location.reload();
                },
                complete: function (data) {    
                }
            });
        }
        
    }
</script>
@stop










