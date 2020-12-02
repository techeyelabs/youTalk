@extends('navbar')

@section('custom_css')
    <style>

    .btn-style{
        height: 100%;
        width: 80px;
        border: 1px solid gray;
        background-color: white;
        color: #31BBEE;
        font-size: 14px;
        font-weight: bold;
        padding: 0px;
    }

    .facebook{
        /* background-image: url('../assets/icons/facebook.png'); */
        background-image:url({{url('assets/icons/facebook.png')}});
    }

    
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

        
    </style>
@stop


@section('content')
    {{-- @include('template.mytop')
    <div class="col-md-12 row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-right pr-5">
            <form action="{{route('profile-edit')}}">
                <button type="submit" class="buttons" style="background-color: #7BB3AE !important">プロフィール更新 / 編集</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/> --}}
    <div class="col-md-12 row remove-pads" style="min-height: 850px">
        {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-12 mobile  alternates" >
                <div class="col-md-12 row p-0" style="font-size: 16px">
                    <div class="col-md-7 px-0">
                        <div class="p-0 mb-2">
                            <span>{{$personal->name}}</span>
                        </div>
                        <div class="p-0 mb-2">
                            @if($profile_info->gender == 1)
                                <span>男性</span>
                            @elseif($profile_info->gender == 2)
                                <span>女性</span>
                            @elseif($profile_info->gender == 3)
                                <span>末記入</span>
                            @endif
                        </div>
                        <div class="p-0 mb-2">
                            <span>{!!nl2br($profile_info->address)!!}</span>
                        </div>
                        <div class="p-0 mb-2">
                            <table>
                                <tr>
                                    <td style="padding-left: 0px; padding-top: 0px; padding-bottom: 0px; border: none; pading-right: 10px">
                                        <span>{!!nl2br($follow_count)!!}人フォロワー</span>
                                    </td>
                                    <td style="padding: 0px; border: none">
                                        <div>
                                            @if(Auth::user()->id != $profile_info->user_id)
                                                @if(!$follow || $follow->status == 1)
                                                    <form action="{{route('follow', ['user_id' => $profile_info->user_id])}}"><button type="submit" class="btn-style">Follow</button></form>
                                                    <?php
                                                    // echo '<pre>';
                                                    // print_r($profile_info->user_id);
                                                    // exit;
                                               ?>
                                                @elseif($follow->status == 2)
                                                    <form action="{{route('follow', ['user_id' => $profile_info->user_id])}}"><button type="submit" class="btn-style" style="color: #EB7A79">Unfollow</button></form>
                                                   
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="p-0 mb-2">
                            <table>
                                <tr>
                                    <td style="padding-left: 0px; padding-top: 0px; padding-bottom: 0px; border: none; pading-right: 10px">販売実績  {{$completed_services}}</td>
                                    <td style="padding: 0px; border: none">@php
                                        $starTotal = 5;
                                        $starPercentage = $avg_rating / $starTotal * 100; 
                                        $starPercentage = $starPercentage."%";
                                        @endphp
                                        <span> 
                                            <div class="stars-outer">
                                                <div class="stars-inner" style="width:{{$starPercentage}}"></div>
                                            </div>
                                            {{$avg_rating}}({{$total_ratings}})
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="p-0 mb-2">   
                            @if( $profile_info->facebook != null)
                                <a href="{{$profile_info->facebook}}" target="_blank">
                                    <img src="{{Request::root()}}/assets/icons/facebook.png" title="facebook" style="height: 25px; width: 25px"/>
                                </a>
                            @endif    

                            @if($profile_info->twitter != null)
                                <a href="{{$profile_info->twitter}}" target="_blank">
                                    <img src="{{Request::root()}}/assets/icons/twitter.png" title="twitter" style="height: 25px; width: 25px"/>
                                </a>
                            @endif

                            @if( $profile_info->instagram != null)
                                <a href="{{$profile_info->instagram}}" target="_blank">
                                    <img src="{{Request::root()}}/assets/icons/instagram.png" title="instagram" style="height: 25px; width: 25px"/>
                                </a>
                            @endif 

                            @if( $profile_info->youtube != null)
                                <a href="{{$profile_info->youtube}}" target="_blank">
                                    <img src="{{Request::root()}}/assets/icons/youtube.png" title="youtube" style="height: 25px; width: 25px"/>
                                </a>
                            @endif

                            @if( $profile_info->ameblo != null)
                                <a href="{{$profile_info->ameblo}}" target="_blank">
                                    <img src="{{Request::root()}}/assets/icons/abema.png" title="ameblo" style="height: 25px; width: 25px"/>
                                </a>
                            @endif 

                            @if( $profile_info->note != null)
                                <a href="{{$profile_info->note}}" target="_blank">
                                    <img src="{{Request::root()}}/assets/icons/note.png" title="note" style="height: 25px; width: 25px"/>
                                </a>
                            @endif
                        </div>
                        
                        
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-10 p-0">
                                <div class="expandable" >
                                    <img src="{{Request::root()}}/assets/user/{{$profile_info->picture}}" class="card-img" alt="..." style="height:250px; width:250px; object-fit:cover !important">
                                </div>         
                            </div>
                        </div>
                    </div>
                </div>
                @if($profile_info->bio != '' && $profile_info->bio != null)
                    <div class="col-md-12 row p-0 mt-5" style="font-size: 16px">
                        <div>
                            <span><b>自己紹介</b></span>
                        </div>
                        <div style="text-align: justify">  
                            <span>{!! nl2br($profile_info->bio) !!}</span>
                        </div>
                    </div>
                @endif
                

                <div class="col-md-12 row mt-5 ml-1 mr-1 pb-2" style="border-bottom: 1px solid #e2e2e2">
                    <div class="text-16"><span class="mt-4"><b>サービス一覧</b></span></div>
                </div>

                <div class="row p-0 text-14">
                    @foreach($services as $service)
                        <div class="col-md-12 mt-2 ml-1 mr-1 pb-2" style="border-bottom: 1px solid #e2e2e2">
                            <a class="anchorColor" href="{{route('user-display-service', ['id' => $service->id])}}"><span>{{$service->title}}</span></a>
                        </div>
                    @endforeach
                </div>

                @if(count($reviews) > 0)
                    <div class="col-md-12 my-5 text-14">
                        <div class="p-3 mb-4" style="border: 2px solid rgba(158, 148, 148, 0.5); word-break: break-word;">
                            @foreach($reviews as $k => $review)
                                <div class="row col-md-12 p-0">
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

                                <div class="col-md-12 row p-0">
                                    <a class="anchorColor" style="font-size: 12px" href="{{route('user-display-service', ['id' => $review->service_id])}}">
                                        {{$review->service->title}} 
                                    </a>
                                </div>
            
                                <div class="row col-md-12 p-0 mb-3">
                                    <div class="col-md-12 p-0" style="text-align:justify; font-size:12px">
                                        {!!nl2br($review->review)!!}                          
                                    </div>
                                    <div class="row col-md-12 sp-leftpad-review" style="text-align:justify; font-size:10px; padding-left:90px; margin-top:25px">
                                        @if($review->reply == '')
                                        
                                        @else 
                                            <div class="col-md-6 pl-0" style="height: 18px">
                                                <a class="anchorColor" style="font-size: 10px" href="{{route('user-page-profile', ['id' => $review->seller_id])}}">{{"by ".$review->seller->name}} {{$review->seller->last_name}}</a>
                                            </div>
                                            <div class="col-md-6 text-right pr-0" style="height: 18px">
                                                @php 
                                                $date_timestamp = strtotime($review->updated_at);  
                                                $day = date("d", $date_timestamp);
                                                $month = date("m", $date_timestamp);
                                                $year = date("Y", $date_timestamp);
                                                $time = date("H:i:s", $date_timestamp);
                                                @endphp
                                                <span style="font-size: 10px"><p>{{$year}}年{{$month}}月{{$day}}日   {{$time}}</p></span>
                                            </div>
                                            <span style="font-size: 12px">
                                                {!!nl2br($review->reply)!!}
                                            </span>
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
        {{-- <div class="col-md-2"></div> --}}
    </div>
@stop



@section('custom_js')
@stop

