@extends('navbar')

@section('custom_css')
    <style>
        .button_holder{
            border: 1px solid #e0e0e0;
            padding-top: 25px;
            padding-bottom: 25px;
            padding-left: 0px !important;
            padding-right: 0px !important;
        }

        .button_div{
                width: 100%; 
                text-align: center; 
                padding: 20px
            }
    </style>
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
    <div class="col-md-12 row pl-0 pr-0">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <!-- whole service detail page  -->
           <div class=" row">
            <div class="col-md-12">
                <!-- title and buttons -->
                <div class="col-md-12 row mt-4">
                    <div class="col-md-9 text-left">
                        <div class="mb-5" style="font-size: 18px"><b>{{$service->title}}</b></div>
                        <div class="text-left">
                            {{--<div class="mb-3">
                                <table style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td style="width: 33%; text-align: center"><a href="#details">Search</a></td>
                                            <td style="width: 33%; text-align: center"><a href="#paymentmethod">Payment Instructions</a></td>
                                            <td style="width: 33%; text-align: center"><a href="#faq">FAQ</a></td>
                                        </tr>
                                    <tbody>
                                </table>
                            </div>--}}
                            <div class="mb-5" id="details" style="font-size: 16px">
                                <span>
                                    {!! nl2br($service->details) !!}
                                </span>
                            </div>
                            {{--<hr>
                            <div class="mt-5" id="paymentmethod">
                                <div><b>Payment Method</b></div>
                                <br/>
                                <div><span>{!!nl2br($service->payment_instructions)!!}</span></div>
                            </div>
                            <hr>
                            <div class="mt-5" id="faq">
                                <div><b>FAQ</b></div>
                                <br/>
                                @foreach($service->faqs as $f)
                                    <div><span>Q: {{$f->question}}</span></div>
                                    <div><span>A: {!!nl2br($f->ans)!!}</span></div>
                                @endforeach
                            </div>--}}
                        </div>
                    </div>
                    @if(isset(Auth::user()->id))
                        <div class="col-md-3">
                            <div class="text-center button_holder">
                                <div class="mb-2">{{$service->price}} 円 / 分</div>
                                @if($service->seller_id == Auth::user()->id && $service->seller_status == 1)
                                    <form action="{{route('change-status', ['stat' => 2, 'id' => $service->id])}}"><button type="submit" class="buttons" style="background-color: #fdba58 !important">📞 電話受付 OFF</button></form>
                                @elseif($service->seller_id == Auth::user()->id && $service->seller_status == 2)
                                    <form action="{{route('change-status', ['stat' => 1, 'id' => $service->id])}}"><button type="submit" class="buttons" style="background-color: #949ea2 !important">🚫 電話受付 ON</button></form>
                                @elseif($service->seller_id != Auth::user()->id && $service->seller_status == 1)
                                    <button id="call" type="submit" class="buttons" style="background-color: #fdba58 !important">Call Now</button>
                                @else
                                    <button type="submit" class="buttons" style="background-color: #949ea2 !important">offline</button>
                                @endif
                    
                                <br/>
                                @if($service->seller_id == Auth::user()->id && $service->reservation_status == 1)
                                    <form action="{{route('change-reservation', ['stat' => 2, 'id' => $service->id])}}"><button type="submit" class="buttons" style="background-color: #949ea2!important">🚫 予約受付 ON</button></form>
                                @elseif($service->seller_id == Auth::user()->id && $service->reservation_status == 2)
                                    <form action="{{route('change-reservation', ['stat' => 1, 'id' => $service->id])}}"><button type="submit" class="buttons" style="background-color: #7BB3AE !important">🗓 予約受付 OFF</button></form>
                                @elseif($service->seller_id != Auth::user()->id && $service->reservation_status == 1)
                                    <form action="{{route('make-reservation', ['id' => $service->id])}}">
                                        <button type="submit" class="buttons" style="background-color: #7BB3AE !important">Reservation</button>
                                    </form>
                                @else
                                    <button type="submit" class="buttons" style="background-color: #949ea2 !important">No reservation</button>
                                @endif
                                <br/>
                                <form action="{{route('edit-service', ['id' => $service->id])}}">
                                    <button class="buttons">サービス編集</button>
                                </form>
                            </div>
                            <div style="height: 50px"><br/></div>
                            

                        </div>
                    @else
                        <div class="col-md-3 text-center button_holder">
                            <div class="mb-2">{{$service->price}} 円 / 分</div>
                                <button type="submit" class="buttons" style="background-color: #949ea2 !important">offline</button>
                            <br/>
                            <br/>
                                <button type="submit" class="buttons" style="background-color: #949ea2 !important">No reservation</button>
                        </div>
                        
                    @endif
                </div>
                <!-- body and seller intro -->
                <div class="col-md-12 row mt-4">
                
                </div>
            </div>
        </div>  
            <!-- service detail ends -->
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/>
    <br/>
    <br/>
@stop



@section('custom_js')
@stop