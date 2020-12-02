


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
                                <tr>
                                    <td class="index_cells">#</td>
                                    <td class="index_cells">通話相手</td>
                                    <td class="index_cells">通話予約日程</td>
                                </tr>
                            @foreach($list as $s)
                                <tr>
                                    <form id="request_form" action="{{route('reservation-accept')}}" enctype="multipart/form-data" method="post" style="width: 100%">
                                        <td class="index_cells">{{$index}}</td>
                                        <td class="table_cells" style="width: 28% !important">{{$s->buyer}}</td>
                                        <td class="table_cells" style="width: 35% !important">
                                                <span>{{$s->slots[0]->day}}, </span>
                                            @if($s->slot == 1)
                                                <span>11:00:00AM</span>
                                            @elseif($s->slot == 2)
                                                <span>02:00:00PM</span>
                                            @else
                                                <span>04:00:00PM</span>
                                            @endif
                                        
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






































