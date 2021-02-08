<!DOCTYPE html>
<html lang="en" style="">
	<head>
		<title>YouTalk</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/style.css">
        <link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/bootstrap-datepicker.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

        <script src="{{Request::root()}}/assets/bootstrap-datepicker.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style type="text/css">
                @import "compass/css3";
                .anchorColor:hover{
                    color: #D9D9D9 !important;
                }
                body{
                    font-size: 12px !important;
                    background-color: #f9f9f9;
                    color: black;
                }
                .anchorColor:hover{
                    color: #D9D9D9 !important;
                }

                .btn-no-border-radius{
                    border-radius: 0px !important;
                }
                .border-right{
                    border-right: 1px solid #ced4da;
                }
                .front_header{
                    padding-top: 10px;
                    padding-bottom: 10px;
                }
                .margin-top{
                    margin-top: 15px;
                }
                .bg-white{
                    background-color: #FFF;
                }
                .panel-auth{
                    padding: 10px;
                }
                .facebook{
                    background-color: #3B5997 !important;
                    border-radius: 0px !important;
                }
                .google{
                    background-color: #D34735 !important;
                    border-radius: 0px !important;
                }
                .twitter{
                    background-color: #3884B4 !important;
                    border-radius: 0px !important;
                }
                .auth_area{
                    background-color: #F1F1F1;
                }
                .front_header{
                    background-color: #ffffff;
                    padding-top: 20px;
                    padding-bottom: 20px;
                }
                .auth_page_title{
                    padding-top: 15px;
                    padding-bottom: 15px;
                }
                .auth_page_title h1{
                    font-size: 20px;
                }
                .auth_area{
                    padding-bottom: 100px;
                }
                .auth_form_area .area_auth{
                    padding-top: 50px;
                }
                .auth_form_area .area_auth .form-group{
                    margin-top: 20px;
                }
                .auth_form_area .part_1 h2, .part_2 h2{
                    font-size: 16px;
                }
                .part_2 h2{
                    margin-bottom: 30px;
                }
                .part_1, .part_2{
                    padding: 40px;
                    padding-top: 0px;
                }
                .btn-primary{
                    background-color: #618ca9;
                    border-color: #618ca9;
                }
                .auth_form_area .part_1{
                    position: relative;
                }
                .area_auth{
                    padding-bottom: 50px !important;
                }
                .btn{
                    cursor: pointer;
                }
                .custom_pad{
                    line-height: 20px !important;
                    font-size: 13px !important;
                    font-weight: 800 !important;
                    top: 0px !important;
                }
                .badge-noti{
                    float: right !important;
                    margin-bottom: -6px !important;
                    margin-top: 12px !important;
                    margin-left: -10px !important;
                }

                .badge_noti_mobile{
                    margin-left: 9px !important;
                    float: left !important;
                    margin-top: 0px !important;
                    border-radius: 50% !important
                }

                .dropdown-menu {
                    width: 230px !important;

                }

                .buttons{
                    /* border: 1px solid #7f9098; */
                    border-radius: 4px;
                    background-color: white;
                    width: 190px;
                    padding: 5px;
                    box-shadow: 1px 1px 1px 1px #7f9098;
                }
                .mytabs{
                    /* width: 33%; */
                    text-align: center;
                    /* border: 1px solid gray; */
                    padding: 20px;
                }
                .table_cells{
                    width: 23%;
                    text-align: center;
                    border: 1px solid;
                    padding: 9px;
                }
                .index_cells{
                    width: 8%;
                    border: 1px solid;
                    text-align: center;
                }
                td {
                    vertical-align: top;
                    border-bottom: 1px solid #eaeaea;
                    padding: 10px
                }
                .btn-size{
                    width: 80px;
                    background-color: #FFFFFF;
                    color: #7f9098;
                }
                .mobile_login{
                    font-size: 10px!important;
                }

                .remove_border{
                    border: none;
                }

                a:active{
                    background-color: transparent !important;
                }
                button:focus {
                    outline:0px !important;
                    box-shadow: none !important;
                    border: 1px solid gray
                }
                button {
                    outline: none;
                }

                /* select box */
                select {

                /* styling */
                background-color: white;
                border: 1px solid #cecece;
                border-radius: 4px;
                display: inline-block;
                font: inherit;
                line-height: 24px;
                padding: 0.5em 3.5em 0.5em 1em;
                width: 100%;

                /* reset */

                margin: 0;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                -webkit-appearance: none;
                -moz-appearance: none;
                }


                /* arrows */

                select.minimal {
                    background-image:
                    linear-gradient(45deg, transparent 50%, gray 50%),
                    linear-gradient(135deg, gray 50%, transparent 50%),
                    linear-gradient(to right, #ccc, #ccc);
                    background-position:
                    calc(100% - 15px) calc(1em + 4px),
                    calc(100% - 10px) calc(1em + 4px),
                    calc(100% - 2.5em) 0.7em;
                    background-size:
                    5px 5px,
                    5px 5px,
                    1px 1.5em;
                    background-repeat: no-repeat;
                }

                select:-moz-focusring {
                color: transparent;
                text-shadow: 0 0 0 #000;
                }

                .badge-notify{
                    background:red;
                    position:relative;
                    top: -24px;
                    left: -12px;
                }

                .badge{
                    font-size: 60%;
                }

            </style>
            @yield('custom_css')
	</head>
	<body >
        <div id="navbar" class="navigation_bar col-md-12 row mb-3 ">
            <div class="col-md-12 alternates" >
                <table style="width: 100%">
                    <tbody>
                        <tr style="width: 100%; text-align:center">
                            <td class="logo-td">
                                <div style="text-align: left;margin-top:5px !important">
                                    <a href="{{route('front-home')}}" style="font-size: 24px; font-weight:500">
                                        <img src="{{Request::root()}}/assets/systemimg/logo.png" height="50" width="auto"/>
                                    </a>
                                </div>
                            </td>
                            {{--<td style="width: 33%; vertical-align: middle; padding: 0px !important; border-bottom: 0px !important"><div></div></td>  --}}
                            @if(Auth::user())
                                <td class="logo-td" style="padding-bottom: 16px !important">
                                    <div style="text-align: right;margin-top:5px !important">
                                        <div class="dd_vanish">
                                            <div class="btn-group">
                                                <a class="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="{{Request::root()}}/assets/user/{{$profile->picture}}" style="height: 35px; width: 35px; border-radius: 50%"/>
                                                </a>
                                                <span id="icon_badge_mobile" class="badge badge-danger badge-notify" style="border-radius: 50%; color:red; display:none; height: 14px; width: 14px; top: -6px; left: -6px">2</span>
                                                <div class="dropdown-menu dropdown-menu-right custom_pad">
                                                  <a class="dropdown-item" style="font-size: 13px;">{{Auth::user()->name}}</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-page-profile')}}">マイページ</a><div class="dropdown-divider"></div>
                                                  <span id="badge_span_small" class="badge badge-pill badge-primary badge-noti badge_noti_mobile" style="float:right;margin-bottom:-10px;display: none">0</span> <!-- your badge -->
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-wallet')}}">マイウォレット</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-call-history')}}">通話履歴
                                                    <span id="callhistory_badge_mobile" class="badge badge-danger" style="border-radius: 50%; display:none; color:red;font-size: 8px; width: 13px; height: 13px; vertical-align: top">2</span>
                                                    </a><div class="dropdown-divider"></div>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-talk-room')}}">トークルーム
                                                    <span id="talkroom_badge_mobile" class="badge badge-danger" style="border-radius: 50%; display:none; color:red; font-size: 8px; width: 13px; height: 13px; vertical-align: top">2</span>
                                                    </a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-earning')}}">総合売上</a><div class="dropdown-divider"></div>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-page-service')}}">サービス一覧
                                                    <span id="service_badge_mobile" class="badge badge-danger" style="border-radius: 50%; display:none; color:red; font-size: 8px; width: 13px; height: 13px; vertical-align: top">2</span>
                                                    </a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('new-service')}}">新規サービス作成</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('user-message')}}">メッセージ
                                                    <span id="message_badge_mobile" class="badge badge-danger" style="border-radius: 50%;display:none; color:red; font-size: 8px; width: 13px; height: 13px; vertical-align: top">2</span>
                                                    </a><div class="dropdown-divider"></div>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('line-login')}}">LINE通知設定</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('profile-edit')}}">プロフィール編集</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('change-password')}}">パスワード変更</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('sign-out')}}">ログアウト</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="expandableProfilePic">
                                            <div class="btn-group">
                                                <a class="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="{{Request::root()}}/assets/user/{{$profile->picture}}" style="height: 35px; width: 35px; border-radius: 50%"/>
                                                </a>
                                                <span id="icon_badge" class="badge badge-danger badge-notify" style="border-radius: 50%; color:red; display:none; height: 14px; width: 14px; top: -6px; left: -6px">1</span>
                                                <div class="dropdown-menu dropdown-menu-right custom_pad">
                                                  <a class="dropdown-item" style="font-size: 13px">{{Auth::user()->name}}</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-page-profile')}}">マイページ</a><div class="dropdown-divider"></div>
                                                  <span id="badge_span_small" class="badge badge-pill badge-primary badge-noti badge_noti_mobile" style="float:right;margin-bottom:-10px;display: none">0</span> <!-- your badge -->
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-wallet')}}">マイウォレット</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-call-history')}}">通話履歴
                                                    <span id="callhistory_badge" class="badge badge-danger" style="border-radius: 50%; display:none; color:red; font-size: 8px; width: 13px; height: 13px; vertical-align: top">2</span>
                                                    </a><div class="dropdown-divider"></div>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-talk-room')}}">トークルーム
                                                    <span id="talkroom_badge" class="badge badge-danger" style="border-radius: 50%; display:none; color:red; font-size: 8px; width: 13px; height: 13px; vertical-align: top">2</span>
                                                </a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-earning')}}">総合売上</a><div class="dropdown-divider"></div>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('my-page-service')}}">サービス一覧
                                                    <span id="service_badge" class="badge badge-danger" style="border-radius: 50%; display:none; color:red; font-size: 8px; width: 13px; height: 13px; vertical-align: top">2</span>
                                                  </a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('new-service')}}">新規サービス作成</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('user-message')}}">メッセージ
                                                    <span id="message_badge" class="badge badge-danger" style="border-radius: 50%; display:none; color:red; font-size: 8px; width: 13px; height: 13px; vertical-align: top">2</span>
                                                </a><div class="dropdown-divider"></div>
                                                <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('line-login')}}">LINE通知設定</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('profile-edit')}}">プロフィール編集</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('change-password')}}">パスワード変更</a>
                                                  <a class="dropdown-item" style="font-size: 13px" type="" href="{{route('sign-out')}}">ログアウト</a>
                                                </div>
                                              </div>
                                        </div>
                                    </div>
                                </td>
                            @else
                                <td class="logo-td" style="padding-bottom: 16px !important">
                                    <div class="mobile_login" style="text-align: right; font-size:14px !important;margin-top:5px !important">
                                        <a class="log-reg-button" href="{{ route('user-login') }}">ログイン</a>&nbsp;/
                                        <a class="log-reg-button" href="{{ route('user-register-request') }}">新規登録</a>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="body" class="remove-pads">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="flex_cont mt-5 footer-div">
            <div class="col-md-12 alternates ">
                <div class="col-md-12 col-sm-12 row" style="color: white">
                    <div class="col-md-5 text-left mb-1">
                        <div><a href="{{route('law')}}" style="color: white !important">特定商取引法に基づく表示</a></div>
                        <div><a href="{{route('privacy')}}" style="color: white !important">プライバシーポリシー</a></div>
                    </div>
                    <div class="col-md-4 text-left mb-1">
                        <div><a href="{{route('terms')}}" style="color: white !important">利用規約</a></div>
                        <div><a href="{{route('user_guide')}}" style="color: white !important">資金決済法に基づく表記</a></div>
                    </div>
                    <div class="col-md-3" style="text-align: left">
                        <div>
                            <img src="/assets/systemimg/RapidSSL_SEAL-90x50.gif" alt="RapidSSL Site Seal" border="0" /> 
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <!-- code added by tanvir | add options -->
        <?php if(Auth::check()){?>
        <script type="text/javascript" src="/assets/chat/js/client.js"></script>
        <script type="text/javascript">
            let options = {
                id: '{{Auth::user()->id}}',
                name: '{{Auth::user()->name}}',
                pic: '',
                callback_url: '',
                callback_data: ''
            }
        </script>

        <script type="text/javascript">
            let BASE_URL = '{{request()->root()}}';
            <?php if(Auth::check()){?>
                window.chat = new Chat(options);
            <?php }?>
        </script>
        <?php }?>

        @yield('custom_js')
        
        <script>
            $(document).ready(function(){
                update_badge_talkroom();
                update_badge_service();
                update_badge_message();
                update_badge_callhistory();

                function update_badge_callhistory(){
                    var ajaxurl = "{{route('callhistory-notification')}}";
                    $.ajax({
                        url: ajaxurl,
                        type: "GET",
                        data: {
                                '_token': "{{ csrf_token() }}"
                        },
                        success: function(data){
                            if(data > 0){
                                $('#callhistory_badge').show();
                                $('#callhistory_badge_mobile').show();

                                $('#icon_badge').show();

                                $('#icon_badge_mobile').show();
                            }
                        },
                        complete: function (data) {
                                // Schedule the next
                        }
                    }); 
                }

                function update_badge_service(){
                    var ajaxurl = "{{route('service-notification')}}";
                    $.ajax({
                        url: ajaxurl,
                        type: "GET",
                        data: {
                                '_token': "{{ csrf_token() }}"
                        },
                        success: function(data){
                            if(data.countPending +  data.countConfirmed > 0){
                                var total = data.countPending +  data.countConfirmed;
                                $('#service_badge').show();
                                //$('#service_badge_mobile').html(total);
                                $('#service_badge_mobile').show();

                                $('#icon_badge').show();

                                $('#icon_badge_mobile').show();
                            }
                        },
                        complete: function (data) {
                                // Schedule the next
                        }
                    }); 
                }

                function update_badge_message(){
                    var ajaxurl = "{{route('message-notification')}}";
                    $.ajax({
                        url: ajaxurl,
                        type: "GET",
                        data: {
                                '_token': "{{ csrf_token() }}"
                        },
                        success: function(data){
                            if(data > 0){
                                $('#message_badge').show();
                                $('#message_badge_mobile').show();
                                $('#icon_badge').show();
                                $('#icon_badge_mobile').show();
                            }
                        },
                        complete: function (data) {
                                // Schedule the next
                        }
                    }); 
                }

                function update_badge_talkroom(){
                    var ajaxurl = "{{route('talkroom-notification')}}";
                    $.ajax({
                        url: ajaxurl,
                        type: "GET",
                        data: {
                                '_token': "{{ csrf_token() }}"
                        },
                        success: function(data){
                                //console.log("tktk: "+data);
                                //$data = $(data);
                                console.log("ki somossa "+data);
                            if(data > 0){
                                console.log("ki somossa "+data);
                                //console.log("tktk2: "+data);
                                //$('#talkroom_badge').html("!");
                                $('#talkroom_badge').show();
                                
                                //$('#talkroom_badge_mobile').html("!");
                                $('#talkroom_badge_mobile').show();

                                $('#icon_badge').show();

                                $('#icon_badge_mobile').show();
                            }
                                
                        },
                        complete: function (data) {
                                // Schedule the next
                        }
                    }); 
                }
            });
        </script>

        <script type="text/javascript">
            function categoryChange(e){
                var cat = e.value;
                var search= $('.search').val();
                var srt = $('#sort_id').val();

                $('#sor').val(srt);
                $('#search_title').val(search);
                $('#category_form').submit();
            }
            function x(e){
                var cat = $('#cat_id').val();
                var srt = $('#sort_id').val();
                $('#category_id').val(cat);
                $('#sort').val(srt);
                $('#search_form').submit();
            }
            function sort(e){
                var sort = e.value;
                var cat = $('#cat_id').val();
                var search= $('.search').val();
                $('#sort_category_id').val(cat);
                $('#sort_search_title').val(search);
                $('#sort_form').submit();
            }
        </script>
	</body>
</html>

