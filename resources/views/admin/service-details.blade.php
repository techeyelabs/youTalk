@extends('admin.layouts.main-admin')
<style>
    .reply_button{
        background-color: #FFFFFF;
        color: #7f9098;
        border-radius: 4px;
        padding: 5px;
        box-shadow: 1px 1px 1px 1px #7f9098;
        width: 140px !important;
    }
    .buttons{
        border: 1px solid #ffffff;;
        border-radius: 4px;
        background-color: #ffffff;;
        width: 150px;
        padding: 5px;
        box-shadow: 2px 2px #7f9098;
        border: 1px solid #ececec
    }
    .button-before-login{
        border: 1px solid #ffffff;;
        border-radius: 4px;
        background-color: #949ea2;
        width:70%;
        padding: 5px;
        height:40px;
        box-shadow: 1px 1px #7f9098;
        font-size:18px;
    }
    .button_holder{
        /* border: 1px solid #e0e0e0; */
        padding-top: 0px;
        padding-bottom: 0px;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    .button_div{
        width: 100%; 
        text-align: center; 
        padding: 20px
    }
    .msg_send_button{
        padding: 6px;
        border: 1px solid #618ca9;
        background-color: #618ca9;
        border-radius: 25px;
        color: white;
        width: 100px;
        cursor: pointer
    }
    .chat_button{
        border: 1px solid #d4d4d4;
        background-color: #eaeaea;
        border-radius: 4px;
        box-shadow: 1px 1px grey;
        outline: none !important;
    } 
  /* image resize */
  .profile-image{
            max-height: 303px!important;
            margin-left: -5px;

        }
        .frame {
            height: 305px;      /* equals max image height */
            width: auto;
            border: 1px solid #cccccc;
            white-space: nowrap;
            text-align: center;
        }
        .helper {
            display: inline-block;
            height: 100%;
            vertical-align: middle;
        }
        .button-before-login{
            border: 1px solid #64b7f9;
            border-radius: 4px;
            background-color: #949ea2;
            width:100%;
            padding: 5px;
            height:43px;
            box-shadow: 1px 1px #7f9098;
            font-size:22px;
        }
        .price-before-login{
            font-size:37px;
        }
        .margin-bottom-before-login{
            margin-bottom: 30px!important;
        }
        .price-after-login{
            font-size:35px;
        }
        .margin-bottom-after-login{
            margin-bottom: 35px!important;
        }

        /*---------- general ----------*/

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

        button:focus,
        textarea:focus,
        select:focus,
        input:focus {
            outline: 0 !important;
        }

        .form-control:focus {
            border-color: #ccc;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .alternates{
            margin: 0 auto !important; 
            max-width: 1150px !important;
        }
        @media screen and (max-width: 770px) {
        .expandable {
            display: none !important;
        }
        .less-height{
            height: 60px !important
        }
        .remove-pads{
            padding-left: 5px !important;
            padding-right: 5px !important
        }

        .sp-leftpad-review{
            padding-left: 25px !important;
        }
        .alternates {
            padding-left: 0px !important;
            padding-right: 0px !important
        }
    
        .hscroll {
            overflow-x: auto; /* Horizontal */
        }
        
        .small-screen-input-width{
            width: 200px !important;
        }
        .small-screen-input-width-profile{
            width: 90% !important;
        }
    }
</style>

@section('content')
<div class="white-box">
    <div class="clear"></div><hr/>
    <div class="table-responsive col-mod-12">
        <div class="col-md-12 alternates px-0 remove-pads" style="min-height: 850px">
            <div class="col-md-12">
                <!-- title and buttons -->
                <div class="text-center title-before-login" style="font-size: 18px"><b>{{$service->title}}</b></div>
                <div class="text-center description-before-login" style="font-size: 15px;">無料通話回数{{$service->free_mint_iteration}}回（毎回{{$service->free_min}}分)</div>
                <a href="{{route('user-details', ['id' => $service->createdBy->id])}}">
                    <div class="text-center description-before-login" style="font-size: 15px;">{{$service->createdBy->name}}{{$service->createdBy->last_name}}</div>
                </a>
            </div>
            <div class="col-md-12 px-0">
                <div class="row col-md-12 mt-4 align-items-end">
                    <div class="col-xs-12 col-lg-6 text-lg-left text-center">
                        <img class="img-thumbnail thumb profile-image" src="{{Request::root()}}/assets/service/{{$service->thumbnail}}">
                    </div>
                    <div class="col-xs-12 col-lg-6">
                        <div class="text-right ">
                            <div class="mb-2 margin-bottom-after-login price-after-login"><span style="font-size: 42px">{{$service->price}}</span> <span style="font-size: 15px !important">円 / 分</span></div>

                            @if($service->seller_status == 1)
                                @if($call_possible_seller > 0)
                                <button id="" type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important;color:white">電話中</button>
                                @else
                                <button id="" type="submit" class="buttons button-before-login" style="background-color: #92D050 !important;color:white">📞 電話する</button>
                                @endif
                            @else
                                <button type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important;color:white">🚫 電話する</button>
                            @endif

                            <div class="after-login-br" style="height: 30px"><br/></div>
                            @if($service->reservation_status == 1)
                                <button type="submit" class="buttons button-before-login" style="background-color: #9DC3E6 !important; color:white">🗓 電話予約する</button>
                            @else
                                <button type="submit" class="buttons button-before-login" style="background-color: #949ea2 !important; color:white">🚫 電話予約する</button>
                            @endif
                            <div class="after-login-br" style="height: 30px; text-align: right"><br class="before-login-br"></div>
                            <div>
                                <button type="submit" class="button-before-login" style="background-color: #84bdb8; color: white; border: 1px solid #84bdb8">メッセージをする</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12" style="font-size: 16px; text-align:justify">
                        @php
                            print($service->details)
                        @endphp
                    </div>
                </div>
                <div class="col-md-12 row mt-4"></div>
                @if($reviews->count() > 0)
                    <div class="col-md-12 my-5">
                        <h5>評価&nbsp;⭐️&nbsp;&nbsp;{{$avg_rating}} ({{$total_ratings}})</h5>
                        <div style="border: 1px solid #d2d2d280; padding: 20px; overflow:auto;">
                            @foreach($reviews as $k => $review)
                                <div class="row col-md-12 p-0" style="word-break: break-all;">
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
                                <div class="row col-md-12 p-0 mb-3" style="word-break: break-all;">
                                    <div class="col-md-12 p-1 mb-3" style="font-size: 12px; text-align:justify">
                                        {!!nl2br($review->review)!!}
                                    </div>
                                    <div class="col-md-12 sp-leftpad-review" style="font-size: 16px; text-align:justify; padding-left:100px">
                                        <div class="row col-md-12 pl-0 pr-0" style="height: 20px">
                                            <div class="col-md-6 pl-0">
                                                <a class="anchorColor" style="font-size: 10px" href="{{route('user-page-profile', ['id' => $review->seller_id])}}">by {{$review->seller->name}} {{$review->seller->last_name}}</a>
                                            </div>
                                            <div class="col-md-6 text-right pr-0">
                                                @php
                                                $date_timestamp = strtotime($review->updated_at);
                                                $day = date("d", $date_timestamp);
                                                $month = date("m", $date_timestamp);
                                                $year = date("Y", $date_timestamp);
                                                $time = date("H:i:s", $date_timestamp);
                                                @endphp
                                                <span style="font-size: 10px"><p>{{$year}}年{{$month}}月{{$day}}日   {{$time}}</p></span>
                                            </div>
                                        </div>
                                        <div class="pt-4">
                                            <span style="font-size: 12px">{!!nl2br($review->reply)!!}</span>
                                        </div>
                                    </div>
                                </div>
                                @if($k < sizeof($reviews) - 1)
                                    <div class="row col-md-12  mb-3"><hr style="height:1px;border-width:0;color:gray;background-color:#d2d2d280; margin:20px 0px" /></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
@endsection
