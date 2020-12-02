{{-- @extends('navbar')

@section('custom_css')
    
@stop



@section('custom_js')
@stop --}}



@extends('navbar')

@section('custom_css')
    
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
    <div class="col-md-12 alternates" style="min-height: 850px">
            <div class="col-md-12 p-0">
                <div class="col-md-12 col-sm-12 row p-0 mb-5">
                    <div class="col-md-6 pr-0" style="font-size: 16px">
                        <div class="row p-0 mb-2">
                            <div class="col-md-2 text-14">
                                <span>氏名</span>
                            </div>
                            <div class="col-md-10 text-14">
                                <span>{{$personal->name}}{{$personal->last_name}}</span>
                            </div>
                        </div>
                        <div class="row p-0 mb-2">
                            <div class="col-md-2 text-14">
                                <span>メール</span>
                            </div>
                            <div class="col-md-10 text-14">
                                <span>{{$personal->email}}</span>
                            </div> 
                        </div>
                        <div class="row p-0 mb-2">
                            <div class="col-md-2 text-14">
                                <span>電話番号</span>
                            </div>
                            <div class="col-md-10 text-14">
                                <span>{{$profile_info->phone}}</span>
                            </div> 
                        </div>
                        <div class="row p-0 mb-2">
                            <div class="col-md-2 text-14">
                                <span>性別</span>
                            </div>
                            <div class="col-md-10 text-14">
                                @if($profile_info->gender == 1)
                                    <span>男性</span>
                                @elseif($profile_info->gender == 2)
                                    <span>女性</span>
                                @elseif($profile_info->gender == 3)
                                    <span>末記入</span>
                                @else 
                                    <span></span>
                                @endif
                            </div> 
                        </div>
                        <div class="row p-0 mb-2">
                            <div class="col-md-2 text-14">
                                <span>誕生日</span>
                            </div>
                            <div class="col-md-10 text-14">
                                @if($profile_info->dob == null)
                                <span></span>
                                @else 
                                <span>{!!date('M j, Y', strtotime($profile_info->dob))!!}</span>
                                @endif
                                
                            </div> 
                        </div>
                        <div class="row p-0 mb-2">
                            <div class="col-md-2 text-14">
                                <span>住所</span>
                            </div>
                            <div class="col-md-10 text-14">
                                <span>{!!nl2br($profile_info->address)!!}</span>
                            </div> 
                        </div>                        
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="row">
                            <div class="col-md-2 col-lg-3">
                            </div>
                            <div class="col-md-10 col-lg-9 p-0">
                                <div class="expandable">
                                    <img src="{{Request::root()}}/assets/user/{{$profile_info->picture}}" class="card-img" alt="..." style="height:250px; width:250px; object-fit: cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 row p-0 mb-5">
                    <div class="col-md-1 text-14 pr-0">
                        <span style="padding: 15px; padding-right: 0px">自己紹介</span>
                    </div>
                    <div class="col-md-11 text-14" style="justify-content: center; padding-left: 22px">
                        <span style="">{{$profile_info->bio}}</span>
                    </div> 
                </div>
                <hr style="height:1px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40)" />
                <div class="col-md-12 mt-2 mb-2 text-16 text-center" style="width: 100%"><span><b>銀行口座情報</b></span></div>
                <div class="col-md-12 row" style="font-size: 16px">
                    <div class="col-md-6 px-0">
                        <div class="row p-0 mb-2">
                            <div class="col-md-2">
                                <span class="text-14">銀行名</span>
                            </div>
                            <div class="col-md-10 text-14">
                                <span>{!!nl2br($profile_info->bank_name)!!}</span>
                            </div>
                        </div>
                        <div class="row p-0 mb-2">
                            <div class="col-md-2 text-14">
                                <span>支店名</span>
                            </div>
                            <div class="col-md-10 text-14">
                                <span>{!!nl2br($profile_info->branch_name)!!}</span>
                            </div> 
                        </div>
                        <div class="row p-0 mb-2">
                            <div class="col-md-2 text-14">
                                <span>種類  </span>
                            </div>
                            <div class="col-md-10 text-14">
                                @if($profile_info->acc_type == 1)
                                    <span>普通</span>
                                @elseif($profile_info->acc_type == 2)
                                    <span>当座</span>
                                @elseif($profile_info->acc_type == 3)
                                    <span>貯蓄</span>
                                @else
                                    <span></span>
                                @endif
                            </div> 
                        </div>
                        <div class="row p-0 mb-2">
                            <div class="col-md-2 text-14">
                                <span>口座番号</span>
                            </div>
                            <div class="col-md-10 text-14">
                                <span>{!!nl2br($profile_info->acc_number)!!}</span>
                            </div> 
                        </div>
                        <div class="row p-0 mb-2">
                            <div class="col-md-2 text-14">
                                <span>口座名義</span>
                            </div>
                            <div class="col-md-10 text-14">
                                <span>{!!nl2br($profile_info->acc_name)!!}</span>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                </div>
                
            </div>
    </div>
@stop



@section('custom_js')
@stop