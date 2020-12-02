
<div class="col-md-12 mt-2" id="mes" style="font-size: 16px">
    <input type="hidden" value="{{$count_mes}}" id="count">
    @foreach($messages as $data)
    <div class="row col-md-12 p-0">
        <div class="col-md-6 p-0">
            @if($data->sender_id != 0)
                <p clas="text-14">{{$data->sender->name}} {{$data->sender->last_name}}</p>
            @else
                <p clas="text-14">管理者</p>
            @endif
        </div>
        <div class="col-md-6 text-right">
            @php 
                $date_timestamp = strtotime($data->created_at->timezone('Asia/Tokyo'));  
                $day = date("d", $date_timestamp);
                $month = date("m", $date_timestamp);
                $year = date("Y", $date_timestamp);
                $time = date("h:i:s", $date_timestamp);
            @endphp
            <p class="text-12">{{$year}}年{{$month}}月{{$day}}日   {{$time}}</p>
        </div>
    </div>
    
    <p style="font-size: 12px">
        {!!nl2br($data->message)!!}
    </p>
    <div class="pt-2 mb-3" style="border-bottom: 1px solid #ababab80"></div>
    

    @endforeach
    

</div> 
