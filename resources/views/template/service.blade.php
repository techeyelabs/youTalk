<!-- local styles -->
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 p-1 expandable text-center" style="">
                @if($s->thumbnail)
                    <img src="{{Request::root()}}/assets/service/{{$s->thumbnail}}" class="" alt="..." style="object-fit: cover; width: 150px; height: 120px">
                @else
                    <img src="{{Request::root()}}/assets/service/default.png" class="" alt="..." style="object-fit: cover; width: 150px; height: 120px">
                @endif
            </div>
            <div class="col-md-9 col-sm-9 col-lg-9 col-xl-9 mobile">
                <div class="service_title expandable">
                    <a class="anchorColor" href="{{route('user-display-service', ['id'=>$s->id])}}">
                        <h5 class="card-title">{{$s->title}}</h5>
                    </a>
                </div>
                <div class="service_title compressable">
                    <a class="anchorColor" href="{{route('user-display-service', ['id'=>$s->id])}}">
                        <h5 class="mb-0">{{$s->title}}</h5>
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-6 p-0">
                        @if($s->free_mint_iteration > 0)
                            <div style="font-size: 12px; height: auto;">お試し通話機能あり（開始から{{$s->free_min}}分までを{{$s->free_mint_iteration}}回無料）</div>
                        @endif
                        @if(isset(Auth::user()->id))
                            <div class="row col-md-10 pb-2" style="font-size: 12px; height: auto;padding-left: 0px">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="seller_rating_tds expandable"><a class="anchorColor" href="{{route('user-page-profile', ['id' => $s->seller_id])}}">{{$s->createdBy->name}}{{$s->createdBy->last_name}}</a></td>
                                            <td class="seller_rating_tds expandable" style="padding-left: 8px !important"><span class="fa fa-star checked"></span></td>
                                            <td class="seller_rating_tds expandable"><span>{{$ratingsSeller[$s->seller_id]}}</span></td>
                                            <td class="seller_rating_tds expandable"><span>({{count($s->userServicesAllCallCount)}})</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="mb-2 row pb-2" style="font-size: 12px; height: auto; padding-left: 0px">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="seller_rating_tds expandable">{{$s->createdBy->name}}{{$s->createdBy->last_name}}</td>
                                            <td class="seller_rating_tds expandable" style="padding-left: 8px !important"><span class="fa fa-star checked"></span></td>
                                            <td class="seller_rating_tds expandable"><span>{{$ratingsSeller[$s->seller_id]}}</span></td>
                                            <td class="seller_rating_tds expandable"><span>({{count($s->userServicesAllCallCount)}})</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col pl-0">
                                <div class="compressable" style="font-size: 14px;">
                                    @php
                                        $starTotal = 5;
                                        $starPercentage = $ratings[$s->id] / $starTotal * 100;
                                        $starPercentage = $starPercentage."%";
                                    @endphp
                                    <div class="stars-outer">
                                        <div class="stars-inner" style="width:{{$starPercentage}}"></div>
                                    </div>
                                    <span>{{$ratings[$s->id]}}</span>
                                    <span>({{count($s->serviceAllCallCount)}})</span>
                                </div>
                                <div class="row pl-0 pr-0">
                                    <div class="row col-md-12 compressable mobile pb-2">
                                        <span class="mobile_price" style="line-height: 0.8">{{$s->price}}  </span>
                                        <span class="pt-1">円 / 分</span>
                                    </div>
                                    <div class="row compressable pl-0 pr-0">
                                        <div class="col-md-12 pl-0 pr-0">
                                            @if($seller_status[$s->seller_id] == 1)
                                                <div class="mr-2 pb-2" >
                                                    <span class="text-success" style="border:1px solid #0452ff;padding:3px; color: #0452ff !important">電話中</span>
                                                </div>
                                            @elseif($s->seller_status == 1)
                                                <div class="mr-2 pb-2"  >
                                                    <span class="text-success" style="border:1px solid #28a745;padding:3px">今すぐ電話可能</span>
                                                </div>
                                            @else
                                                <div class="mr-2 pb-2">
                                                    <span class="text-danger" style="border:1px solid #dc3545;padding:3px">離席中</span>
                                                </div>
                                            @endif
                                            @if($s->reservation_status == 1)
                                                <div class="">
                                                    <span class="text-success" style="border:1px solid #28a745;padding:3px">予約受付中</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row expandable">
                                        @if($seller_status[$s->seller_id] == 1)
                                            <div class="mr-2 pb-2" >
                                                <span class="text-success" style="border:1px solid #0452ff;padding:3px; color: #0452ff !important">電話中</span>
                                            </div>
                                        @elseif($s->seller_status == 1)
                                            <div class="mr-2 pb-2"  >
                                                <span class="text-success" style="border:1px solid #28a745;padding:3px">今すぐ電話可能</span>
                                            </div>
                                        @else
                                            <div class="mr-2 pb-2">
                                                <span class="text-danger" style="border:1px solid #dc3545;padding:3px">離席中</span>
                                            </div>
                                        @endif
                                        @if($s->reservation_status == 1)
                                            <div class="">
                                                <span class="text-success" style="border:1px solid #28a745;padding:3px">予約受付中</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col pr-0 pl-0 compressable justify-content-end text-right">
                                <a href="{{route('user-page-profile', ['id' => $s->seller_id])}}">
                                    <img src="{{Request::root()}}/assets/user/{{$s->createdBy->profile->picture}}"  style="height: 100px; width: 120px;"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-12 col-sm-12 text-right p-0 mobile">
                        <div class="compressable">
                            <div class="row justify-content-end">
                                <span class="seller_rating_tds"><a class="anchorColor" href="{{route('user-page-profile', ['id' => $s->seller_id])}}">{{$s->createdBy->name}}{{$s->createdBy->last_name}}</a></span>
                                <span class="seller_rating_tds" style="padding-left: 8px !important"><span class="fa fa-star checked"></span></span>
                                <span class="seller_rating_tds"><span>{{$ratingsSeller[$s->seller_id]}}</span></span>
                                <span class="seller_rating_tds"><span>({{count($s->userServicesAllCallCount)}})</span></span>
                            </div>
                        </div>

                        <div class="expandable row justify-content-end">
                            <div class="col-md-12 col-6">
                                <span class="mobile_price" style="font-size: 35px">{{$s->price}}  </span><span>円 / 分</span>
                            </div>
                            <div class="col-md-12 col-6 mobile_rate my-auto">
                                @php
                                    $starTotal = 5;
                                    $starPercentage = $ratings[$s->id] / $starTotal * 100;
                                    $starPercentage = $starPercentage."%";
                                @endphp
                                <div class="stars-outer">
                                    <div class="stars-inner" style="width:{{$starPercentage}}"></div>
                                </div>
                                <span>{{$ratings[$s->id]}}</span>
                                <span>({{count($s->serviceAllCallCount)}})</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>