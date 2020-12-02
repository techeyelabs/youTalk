@extends('navbar')

@section('custom_css')
    
@stop


@section('content')
   {{-- @include('template.mytop') --}}
    {{-- <div class="col-md-12 row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-right" style="padding-left: 40px; padding-right: 40px">
            <form action="{{route('my-page-service')}}">
                <button type="submit" class="buttons" style="background-color: #7BB3AE !important">戻る</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/> --}}
    <div class="col-md-12 row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="padding-left: 40px; padding-right: 40px">
        <div class="col-md-12 row">
            @php $index = 1; @endphp
                <div class="col-md-12">
                    <table style="width: 100%">
                        <tbody>
                            @foreach($list as $s)
                                <tr>
                                    <form id="request_form" action="{{route('reservation-accept')}}" enctype="multipart/form-data" method="post" style="width: 100%">
                                        <td class="index_cells" style="vertical-align: middle;">{{$index}}</td>
                                        <td class="table_cells" style="width: 28% !important; vertical-align: middle;">{{$s->buyer}}</td>
                                        <td class="table_cells" style="width: 35% !important; vertical-align: middle;">
                                            @foreach($s->slots as $sl)
                                                <table>
                                                    <tr>
                                                        {{ csrf_field() }}
                                                        <input type="hidden" id="service_id" name="service_id" value={{$service_id}} />
                                                        <input type="hidden" id="reserver_id" name="reserver_id" value={{$s->reserver_id}} />
                                                        <td><input class="radio" type="radio" name="accepted_slot" value="{{$sl->id}}"/>&nbsp;&nbsp;</td>
                                                        <td>{!!date('M j, Y', strtotime($sl->day))!!}, </td>
                                                        <td>
                                                            @if($sl->slot == 1)
                                                                <span>11:00:00AM</span>
                                                            @elseif($sl->slot == 2)
                                                                <span>02:00:00PM</span>
                                                            @else
                                                                <span>04:00:00PM</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        </td>
                                        <td class="table_cells" style="width: 12% !important; border: none !important; vertical-align: middle;">
                                            <button type="submit" class="buttons" style="width: 120px" onclick="confirm('こちらの内容でよろしいですか！')">予約決定</button>
                                        </td>
                                    </form>
                                    <!-- {{$s->slots}} -->
                                </tr>
                                @php $index++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/>
    <br/>
    <br/>
@stop



@section('custom_js')
@stop

















