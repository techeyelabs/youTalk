@extends('admin.layouts.main-admin')


@section('custom_css')
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }   
    </style>
@stop   

@section('content')
<div class="white-box" style="min-height: 1050px">

    <div class="col-mod-12 alternates" style="min-height: 850px">
        <div class="col-mod-12 col-sm-12">
            <div class="col-mod-12 m-b-3">
                <div class="m-b-2" style="margin-bottom: 10px"><span style="font-size: 16px;">電話通話内容</span></div>
                <div class="text-14" style="border: 2px solid rgba(158, 148, 148, 0.5);padding-left:30px; padding-top:10px">
                    <div class="col-md-12 row" style="padding-left: 0px"><h3>{{$talkroom->service->title}}</h3></div>
                    <div class="row pl-3" style="margin-bottom: 10px">
                        <div class="col-md-8 p-0">
                            <div style="height: 30px;">無料通話回数{{$talkroom->service->free_mint_iteration}}回（毎回{{$talkroom->service->free_min}}分)</div>
                            <div>{{$talkroom->seller->name}} {{$talkroom->seller->last_name}}</div>
                        </div>
                        <div class="col-md-4 text-center p-0">
                            <span style="font-size: 35px">{{$talkroom->service->price}}</span><span>円 / 分</span>
                        </div>
                    </div>  
                </div>
                
            </div>

            <div class="col-md-8 m-b-5 text-14" style="padding: 0px">
                <div class="p-2" style="border: 2px solid rgba(158, 148, 148, 0.5); padding:10px">
                    <div class="row" style="">
                        <div class="col-md-8">通話時間</div>
                        <div class="col-md-4">{{$talkroom->duration}}分</div>
                    </div> <hr style="height:2px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40); margin:5px 0px" />
                    <div class="row" style="">
                        <div class="col-md-8">通話料</div>
                        <div class="col-md-4">{{$talkroom->cost}}円</div>
                    </div> 
                </div>
                
            </div>

            <div class="col-md-12" style="padding: 0px; margin-top:20px">
                <div style="margin-bottom: 10px"><span style="font-size: 16px">電話日時2020年5月25日19時開始</span></div>
                <div class="message-wrapper" style="border: 2px solid rgba(158, 148, 148, 0.5); height: 600px; overflow-y:auto; padding:10px">
                    <div class="col-mod-12 text-14">
                        <h3>YouTalk</h3>
                        <p>
                            Welcome. Talkroom opne.
                        </p>

                    </div> <hr style="height:2px;border-width:0;color:gray;background-color:rgba(128, 128, 128, 0.40); margin:5px 0px" />
                    <div class="user-wrapper p-0 text-14" id="messages" >

                    </div>
                    
                </div>
                
            </div>

            <div class="col-md-12" style="padding: 0px; margin-top:10px 0px">
                <div class="p-2" style="border: 2px solid rgba(158, 148, 148, 0.5); padding:10px">
                    <div class="m-b-2 col-mod-12 text-center" style="font-size: 16px"><span>トークルーム終了</span></div>
                </div>
                
            </div>

            <div style="height: 300px">
            </div>



        </div>
    

    </div>    
               
           
        

             

            
</div>

@endsection

@section('script')
<script type="text/javascript">
    
    
</script>
@endsection