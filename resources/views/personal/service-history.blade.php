@extends('navbar')

@section('custom_css')
@stop


@section('content')
    {{-- @include('template.mytop')
    <div class="col-md-12 row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-right" style="padding-left: 40px; padding-right: 40px">
            <form action="{{route('new-service')}}">
                <button type="submit" class="buttons" style="background-color: #7BB3AE !important">新規サービス作成</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div> --}}
    
    <div class="col-md-12 alternates" style="min-height: 850px; max-width: 1000px !important">
        <div class="col-md-12 col-sm-12 remove-pads" style="">
            
            <div class="col-md-12 text-center pb-3"><span class="text-16">通話履歴</span></div>
            <div class="text-14">
                <table style="width: 100%">
                    @foreach ($history as $data)
                        <tr>
                            <td><a class="anchorColor" href="{{ route('talk-room-close', ['talkroom_id' => $data->id])}}">{{$data->buyer->name}} {{$data->buyer->last_name}}</a></td>
                            <td><a class="anchorColor" href="{{ route('talk-room-close', ['talkroom_id' => $data->id])}}">{{$data->created_at}}</a></td>
                            <td><a class="anchorColor" href="{{ route('talk-room-close', ['talkroom_id' => $data->id])}}">{{$data->cost}}円</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
                {{--<div class="col-md-12" style="font-size: 16px"><a class="anchorColor" href="{{route('user-display-service', ['id' => $data->service->id])}}">{{$data->service->title}}</a></div>
                
                <a class="anchorColor text-14" href="{{ route('talk-room-close', ['talkroom_id' => $data->id])}}">
                    <div class="row pl-3 pr-3">
                        <div class="col-md-6 p-0">
                            <div style="">Call Duration {{$data->duration}} min</div>
                            <div style="">{{$data->created_at}}</div>
                        </div>
                    
                    <div class="col-md-6 text-center p-0">
                        <div style="">{{' '.$data->cost.'jpy'}}</div>
                    </div>
                    </div>
                </a>--}}
                {{--<hr style="height:1px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40)" />--}}    
            
        </div>
    </div>
@stop



@section('custom_js')
<script>
    
</script>

@stop

