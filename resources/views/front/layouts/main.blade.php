<!DOCTYPE html>
<html lang="en" style="margin-right: 0px">
	<head>
		<title>YouTalk</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		

		<!-- Twitter Card data -->
		<meta name="twitter:card" value="summary">

		<!-- Open Graph data -->
		<meta property="og:title" content="{{isset($social_title)?$social_title:'crowdfunding'}}" />
		<meta property="og:type" content="product" />
		<meta property="og:url" content="{{url()->full()}}" />
		<meta property="og:image" content="{{isset($social_image)?$social_image:'crowdfunding'}}" />
		<meta property="og:description" content="{{isset($social_description)?$social_description:'crowdfunding'}}" />
    <!-- working dropdown -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" type="text/css" href="{{Request::root()}}/jQuery-ScrollTabs-2.0.0/css/scrolltabs.css">

		<link rel="stylesheet" type="text/css" href="{{ Request::root() }}/assets/front/library/slick/slick.css">
		<link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/front/library/slick/slick-theme.css">
		<link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/front/css/main.css">
		{{-- <link rel="stylesheet" href="{{ asset('js-socials/jssocials.css') }}">
		<link rel="stylesheet" href="{{ asset('js-socials/jssocials-theme-flat.css') }}"> --}}
		{{-- <link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/js_socials/jssocials.css"> --}}
		{{-- <link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/js_socials/jssocials-theme-flat.css"> --}}
		<script
			src="https://code.jquery.com/jquery-3.2.1.min.js"
			integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			crossorigin="anonymous">
			$.ajaxSetup({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
			});	
		</script>




   {{-- <script type="text/javascript" src="{{Request::root()}}/assets/js_socials/jssocials.js"></script> --}}
		





	 <style>
		/* steps fix */
				.wizard,
				.tabcontrol {
						display: block;
						width: 100%;
						overflow: hidden;
				}

				.wizard a,
				.tabcontrol a {
						outline: 0;
				}

				.wizard ul,
				.tabcontrol ul {
						list-style: none !important;
						padding: 0;
						margin: 0;
				}

				.wizard ul>li,
				.tabcontrol ul>li {
						display: block;
						padding: 0;
				}


				/* Accessibility */

				.wizard>.steps .current-info,
				.tabcontrol>.steps .current-info {
						position: absolute;
						left: -999em;
				}

				.wizard>.content>.title,
				.tabcontrol>.content>.title {
						position: absolute;
						left: -999em;
				}


				/*
						Wizard
				*/

				.wizard>.steps {
						position: relative;
						display: block;
						width: 100%;
				}

				.wizard.vertical>.steps {
						display: inline;
						float: left;
						width: 30%;
				}

				.wizard>.steps .number {
						font-size: 1.429em;
				}

				.wizard>.steps>ul>li {
						width: 16.5%;
				}

				.wizard>.steps>ul>li,
				.wizard>.actions>ul>li {
						float: left;
				}

				.wizard.vertical>.steps>ul>li {
						float: none;
						width: 100%;
				}

				.wizard>.steps a,
				.wizard>.steps a:hover,
				.wizard>.steps a:active {
						display: block;
						width: auto;
						margin: 0 0.5em 0.5em;
						padding: 1em 1em;
						text-decoration: none;
						-webkit-border-radius: 5px;
						-moz-border-radius: 5px;
						border-radius: 5px;
				}

				.wizard>.steps .disabled a,
				.wizard>.steps .disabled a:hover,
				.wizard>.steps .disabled a:active {
						background: #eee;
						color: #aaa;
						cursor: default;
				}

				.wizard>.steps .current a,
				.wizard>.steps .current a:hover,
				.wizard>.steps .current a:active {
						/* background: #2184be; */
						color: #fff;
						cursor: default;
				}

				.wizard>.steps .done a,
				.wizard>.steps .done a:hover,
				.wizard>.steps .done a:active {
						background: #9dc8e2;
						color: #fff;
				}

				.wizard>.steps .error a,
				.wizard>.steps .error a:hover,
				.wizard>.steps .error a:active {
						/* background: #ff3111; */
						color: #fff;
				}

				.wizard>.actions {
						position: relative;
						display: block;
						text-align: right;
						width: 100%;
				}

				.wizard.vertical>.actions {
						display: inline;
						float: right;
						margin: 0 2.5%;
						width: 95%;
				}

				.wizard>.actions>ul {
						display: inline-block;
						text-align: right;
				}

				.wizard>.actions>ul>li {
						margin: 0 0.5em;
				}

				.wizard.vertical>.actions>ul>li {
						margin: 0 0 0 1em;
				}

				.wizard>.actions a,
				.wizard>.actions a:hover,
				.wizard>.actions a:active {
						background: #618ca9;
						color: #fff;
						display: block;
						padding: 0.5em 1em;
						text-decoration: none;
						-webkit-border-radius: 5px;
						-moz-border-radius: 5px;
						border-radius: 5px;
				}

				.wizard>.actions .disabled a,
				.wizard>.actions .disabled a:hover,
				.wizard>.actions .disabled a:active {
						background: #eee;
						color: #aaa;
				}

				.home-tabs {
						border-bottom: 2px solid grey;
				}

				.home-tabs .nav-link.active {
						cursor: default;
						background-color: grey;
						border-bottom: 3px;
				}

				.home-tabs .nav-link {
						cursor: pointer;
						border-radius: 0px;
						border: 1px solid #000;
						border-radius: .25rem .25rem 0 0;
				}

				.first_tabs {
						width: 100%;
						background-color: #F1F1F1 !important;
				}

				.first_tabs ul {
						padding: 0px;
						margin: 0px;
				}

				.first_tabs ul li{
						padding-left: 20px;
				}

				.first_tabs ul li a {
						color: #333333;
						text-decoration: none;
						font-size: 16px;
						font-weight: 500;
						font-weight: bold;
						padding-top: 10px;
						padding-bottom: 10px;
						display: inline-block;
				}

				.first_tabs ul li:first-child {
						padding-left: 0px;
				}

				.first_tabs ul li.active a{
						border-bottom: 2px solid #039BFF;
				}
				.left_menu_area .list-group-item{
						border: none;
				}
				.profile_image_area{
						position: relative;
				}
				.img_area img{
						width: 100%;
				}
				.point_area{
						position: absolute;
						bottom: 0px;
						text-align: center;
						width: 100%;
						padding: 15px 5px;
						background-color: rgb(0, 0, 0, 0.9);
				}
				.point_area a{
						font-size: 18px;
						font-weight: bold;
						color: #fff;
						text-decoration: none;
				}
				.left_menu_area a{
						padding-left: 15px;
						border-bottom: 2px solid #d6d6d6 !important;
						color: #292929;
						font-size: 15px;
						/* font-weight: bold; */
				}
				.left_menu_area a:last-child{
						border-bottom-width: 1px !important;
				}
				.user_icon{
						/* font-size: 25px; */
						/*margin-right: 5px;*/
				}
				.login_check{
						color: #292929;
						text-decoration: none;
				}
				.login_check:hover{
						text-decoration: none;
						color: #292929;
				}
				.bg-light{
						background-color: #F1F1F1 !important;
				}
				.msg_delete_btn{
						background: none;
						border: none;
						margin-left: -15px;
						font-size: 20px;
						margin-top: 10px;
						cursor: pointer;
				}
				/* a{
					color: #fff;
					text-decoration: none;
				}
				a:hover{
					color: #fff;
					text-decoration: none;
				} */
				.btn{
						cursor: pointer;
				}
				.error{
						color: red;
				}

				.modal_close_btn{
					position: absolute;
					right: 5px;
					top: -12px;
					background-color: #dddddd !important;
					opacity: 1;
					border-radius: 50px;
					width: 26px;
					height: 25px;
					padding-top: 2px !important;
				}
				.modal_body_area{
					position: relative;
				}
				.horizontal:before{
						display: none !important;
				}
				.user_top_sm_menu, .leftmenuarea_sm{
						display: none;
				}

				.btn-default{
						background-color: gray !important;
				}

				.extra_div{
						background-color: white;
						/* border: 1px solid #f1f1f1; */
						border-radius: 1%;
						padding: 0%;
						box-shadow: 0 3px 7px 0 rgba(0, 0, 0, 0.2), 0 5px 15px 0 rgba(0, 0, 0, 0.19);
				}

				@media only screen and (max-width: 600px) {
					.editbtn{
						margin-top: 10px;
					}
					.footerbtn{
						font-size:10px;
					}
					.front_footer ul li a,p{
						font-size:12px;
					}
					.small_screen_header{
						display: block !important;
					}
					.big_screen_header{
						display: none;
					}
					.big_sticker_small{
						font-size:12px !important;
					}
				}
				@media only screen and (min-width: 600px) {
					.tooltipx .tooltiptext::after {
						left: 65% !important;
					}
					.tooltipx .tooltiptext {
						left: -115% !important;
					}
				}
				@media only screen and (max-width: 1385px) {
					.small_screen_drowpdownpads{
						padding-left: 3% !important;
						padding-right: 3% !important;
					}
				}



				@media (max-width: 575.98px) {
						.user_top_menu, .leftmenuarea{
								display: none;
						}
						.user_top_sm_menu, .leftmenuarea_sm{
								display: block;
								border-radius: 0px;
								width: 100%;
								margin-top: 10px;
								margin-bottom: 10px;
						}
						.leftmenuarea_sm{
								margin-top: 0px !important;
						}
				}
		/* end */


				.tooltipx {
					position: relative !important;
					display: inline-block !important;
					/* border-bottom: 1px dotted black !important; */
				}

				.tooltipx .tooltiptext {
					/* visibility: hidden !important; */
					display: none;
					/* width: 120px !important; */
					background-color: white !important;
					/* color: #fff !important; */
					color: gray !important;
					text-align: center !important;
					border-radius: 9px !important;
					border: 1px solid #c3c3c3;
					/* padding: 5px 0 !important; */
					padding: 14px;
					position: absolute !important;
					z-index: 1000 !important;
					top: 125% !important;
					left: -235%;
					margin-left: -50px !important;
				}

				.tooltipx .tooltiptext::after {
					content: "" !important;
					position: absolute !important;
					bottom: 100% !important;
					left: 89%;
					margin-left: -5px !important;
					border-width: 9px !important;
					border-style: solid !important;
					border-color: transparent transparent #c2c2c2 transparent !important;
					/* border-bottom-color: transparent transparent white transparent !important; */
				}

				.tooltipx:active .tooltiptext {
					/* visibility: visible !important; */
				}
				.bottomline{
					border-bottom: none;
					text-align: left;
					padding: 4px;
					font-size: 11px;
					cursor: pointer;
				}
				.small_dropdown_tabs{
					border: 1px solid #c9cdcd;
					padding-top: 15px;
					padding-bottom: 15px;
				}
	</style>
		@yield('custom_css')
	</head>
	<body>
		
    <div id="big_header" class="navbar navbar-light big_screen_header flex_cont" style="overflow: visible !important; height: 80px; border-bottom: 1px solid #eaeaea; background-color: white !important;">
      <!-- <a class="navbar-brand"  href="#">Navbar</a> -->
			<div class="col-md-12 row" style="width: 100%; padding-left: 3%; padding-right: 3%">
        <div class="col-md-4 col-sm-12" style="vertical-align: middle; padding-top: 7px; padding-left: 15px">
					<a href="{{route('front-home')}}" class="pt-3"><img height="25px" src="{{Request::root()}}/assets/front/img/logo.png"></a>
					<span>@include('front.layouts.search')</span>
        </div>
        <div class="col-md-4 col-sm-12 text-center" style="vertical-align: middle; padding: 0px; padding-top: 20px">
          <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> -->
            <span id="project" style="border: none; color: gray" class="navbar-toggler small_font" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">プロジェクトを探す</span>&nbsp;
						<span id="product" style="border: none; color: gray" class="navbar-toggler small_font" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">商品を探す</span>
          <!-- </button> -->
        </div>
        <div class="col-md-4" style="vertical-align: middle; padding: 0px; padding-top: 22px">
            <ul class="list-inline float-right login_signup">
              @if(Auth::user())
              <li class="list-inline-item" style="margin-top: -11px !important; margin-bottom: 8px">
                <a href="{{route('front-cart')}}" style="position:relative;">
				  <i class="fa fa-shopping-cart fa-flip-horizontal" aria-hidden="true" style="font-size:22px;color:black;"></i>
				 @if(Cart::count()==0) 
				 <span class="bg-warning text-white circle"></span>
				 @else
				  <span class="bg-warning text-white cart-count circle">{{Cart::count()}}</span>
				  @endif
                </a>
              </li>
              <li class="list-inline-item" style="margin-top: -11px !important;">
								<a  
								class="" 
								style="">
								<span id="large_menu" style="border: none" class="tooltipx">
									<img 
										id="mymenu"
										onclick="show()"
										class="" 
										style="border-radius: 50%; width: 40px" 
										src="{{Request::root().'/uploads/'.Auth::user()->pic}}" 
										alt="...">
										<div class="tooltiptext" style="width: 180px; text-align: left">
											<div class="bottomline" style="padding-bottom: 0px !important; font-size: 14px" id="my-name">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</div>
											<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc; padding-top: 0px !important" id="my-page">マイページ</div>
											<div class="bottomline pt-3" id="projectsupport">支援プロジェクト</div>
											<div class="bottomline" id="projectdrafts">起案プロジェクト</div>
											<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc"><p id="projectUpload" class="mb-0">プロジェクトを作る</p></div>
											<div class="bottomline pt-3" id="purchasehistory">購入リスト</div>
											<div class="bottomline" id="myorders">受注リスト</div>
											<div class="bottomline" id="myproducts">出品リスト</div>
											<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc"><p id="productUpload" class="mb-0">出品する</p></div>
											<div class="bottomline pt-3" id="myfavorite">お気に入り</div>
											<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc" id="mymessage">メッセージ</div>
											<div class="bottomline pt-3" id="editprofile">プロフィール編集</div>
											<div class="bottomline" id="editmail">メールアドレス変更</div>
											<div class="bottomline" id="editpassword">パスワード変更</div>
											<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc" id="editaddress">配送先情報</div>
											{{--<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc" id="withdrawal">退会申請</div>--}}
											<div class="bottomline pt-3" id="logout">ログアウト</div>
										</div>
								</span>
								</a>
							</li>
              @else
              <li class="list-inline-item"><a href="{{ route('login') }}" class="login_reg_buttons">{{ __('main.login_title') }}   <b>/</b></a></li>
              <li class="list-inline-item"><a href="{{ route('user-register-request') }}" class="login_reg_buttons">{{ __('main.registration_title') }}</a></li>
            @endif
            </ul>
        </div>
      </div>
		</div>
		<div class="small_screen_header" id="small_header" style="display: none">
				<div>
					<table style="width: 100%">
						<tr>
							<td style="width: 30%">
								<div class="">
									<div>
										<a href="{{route('front-home')}}" class=" m-0 pt-3">
											<img height="15px" src="{{Request::root()}}/assets/front/img/logo.png">
										</a>
									</div>
								</div>
							</td>
							<td>
									<ul class="list-inline login_signup mb-0 mt-2 text-right">
									@if(Auth::user())
									<li class="list-inline-item">
										<a href="{{route('front-cart')}}" style="position:relative;">
											<i class="fa fa-shopping-cart fa-flip-horizontal" aria-hidden="true" style="font-size:22px;color:black;"></i>
											@if(Cart::count() == 0)
												<span class="bg-warning text-white circle"></span>
											@else
												<span class="bg-warning text-white cart-count circle">{{Cart::count()}}</span>
											@endif
										</a>
									</li>
									{{--<li class="list-inline-item"><a href="{{ route('user-my-page') }}" class="login_check text-black" style="color:black;"></a></li>--}}
									<li class="list-inline-item">
										<a
										class="" 
										style="">
										<span id="small_menu" style="border: none" class="tooltipx">
											<img 
												id="mymenu"
												onclick="show_sm()"
												class="" 
												style="border-radius: 50%; width: 40px" 
												src="{{Request::root().'/uploads/'.Auth::user()->pic}}" 
												alt="...">
												<div class="tooltiptext" style="width: 180px; text-align: left">
													<div class="bottomline" style="padding-bottom: 0px !important; font-size: 14px" id="my-name-sm">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</div>
													<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc; padding-top: 0px !important" id="my-page_sm">マイページ</div>
													<div class="bottomline  pt-3" id="projectsupport_sm">支援プロジェクト</div>
													<div class="bottomline" id="projectdrafts_sm">起案プロジェクト</div>
													<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc"><p id="projectUpload-sm" class="mb-0">プロジェクトを作る</p></div>
													<div class="bottomline pt-3" id="purchasehistory_sm">購入リスト</div>
													<div class="bottomline" id="myorders_sm">受注リスト</div>
													<div class="bottomline" id="myproducts_sm">出品リスト</div>
													<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc"><p id="productUpload-sm" class="mb-0">出品する</p></div>
													<div class="bottomline pt-3" id="myfavorite_sm">お気に入り</div>
													<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc" id="mymessage_sm">メッセージ</div>
													<div class="bottomline pt-3" id="editprofile_sm">プロフィール編集</div>
													<div class="bottomline" id="editmail_sm">メールアドレス変更</div>
													<div class="bottomline" id="editpassword_sm">パスワード変更</div>
													<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc" id="editaddress_sm">配送先情報</div>
													{{--<div class="bottomline pb-3" style="border-bottom: 1px solid #ccc" id="withdrawal_sm">退会申請</div>--}}
													<div class="bottomline pt-3" id="logout_sm">ログアウト</div>
												</div>
										</span>
										</a>
									</li>
									@else
									<li class="list-inline-item"><a href="{{ route('login') }}" class="btn btn-primary btn-sm">{{ __('main.login_title') }}</a></li>
									<li class="list-inline-item"><a href="{{ route('user-register-request') }}" class="btn btn-warning btn-sm">{{ __('main.registration_title') }}</a></li>
								@endif
								</ul>
							</td>
						</tr>
						{{--<tr>
							<td colspan="2"><div class="" style="width: 100%; border-top: 1px solid gray">@include('front.layouts.search')</div></td>
						</tr>--}}
						<tr>
							<td style="width: 50%" id="product_small" class="text-center small_dropdown_tabs navbar-toggler small_font" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">プロジェクトを探す</td>
							<td style="width: 50%" id="project_small" class="text-center small_dropdown_tabs navbar-toggler small_font" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">商品を探す</td>
						</tr>
					</table>
				</div>
		</div>

		<!-- Big menu showup for projects, you can go anywhere from here   -->
		<div class="collapse navbar-collapse flex_cont" id="navbarSupportedContent_project" style="height: auto; background-color: #1964af; width: 100%; position: absolute; z-index: 999">
				<div class="text-center small_screen_drowpdownpads" style="width: 100%; padding-left:15%; padding-right: 15%; padding-top: 4%; color: white; font-size: 16px">
					<span>
						<a href="{{ route('toppagerow-wise-projects', ['id'=>1]) }}" style="color: white">新着プロジェクト<span style="padding-left: 24px; padding-right: 20px">/</span></a>
						<a href="{{ route('toppagerow-wise-projects', ['id'=>2]) }}" style="color: white">支援総額プロジェクト<span style="padding-left: 24px; padding-right: 20px">/</span></a>
						<a href="{{ route('toppagerow-wise-projects', ['id'=>3]) }}" style="color: white">終了間近プロジェクト<span style="padding-left: 24px; padding-right: 20px">/</span></a>
						<a href="{{ route('toppagerow-wise-projects', ['id'=>4]) }}" style="color: white">もうすぐ公開プロジェクト<span style="padding-left: 24px; padding-right: 20px"></span></a>
					</span>
				</div>
				<div id="project_cats" class="text-center row small_screen_drowpdownpads" style="height: auto; width: 100%; padding-left:15%; padding-right: 15%; padding-bottom: 4%; padding-top: 2%; color: white; font-size: 12px">           
					
				</div>
		</div>
		<!-- Big menu for project ends -->

		<!-- Big menu for products, just surf through products from here -->
		<div class="collapse navbar-collapse flex_cont" id="navbarSupportedContent_product" style="height: auto; background-color: #50aa46; width: 100%; position: absolute; z-index: 999">
				<div class="text-center small_screen_drowpdownpads" style="width: 100%; padding-left:15%; padding-right: 15%; padding-top: 4%; color: white; font-size: 16px">
					<span>
						<a href="{{ route('front-product-list') }}" style="color: white">新着商品<span style="padding-left: 24px; padding-right: 20px">/</span></a>
						<a href="{{ route('front-mostsold-product-list') }}" style="color: white">最も売れた商品<span style="padding-left: 24px; padding-right: 20px">/</span></a>
						<a href="{{ route('front-featured-product-list') }}" style="color: white">おすすめ商品</a>
					</span>
				</div>
				{{--<div class="col-12 text-center" style="margin-top: 30px">
					<a href="{{ route('user-product-add') }}"><button class="add-new-button">商品を登録をする</button></a>
				</div>--}}
				<div id="product_cats" class="text-center row small_screen_drowpdownpads" style="height: auto; width: 100%; padding-left:15%; padding-right: 15%; padding-top: 2%; padding-bottom: 4%; color: white; font-size: 12px">           
					
				</div>
		</div>
    <!-- Big menu for product ends here-->
		<div class="front">
			<div>
			
			<div id="body">
				@yield('content')
			</div>
			<div>
				@include('sweetalert::alert')
			</div>
			<footer class="front_footer flex_cont" style="position: relative;">
				<div class="container">
					<div class="row m-0">
						<div class="col-md-12 offset-md-1 col-sm-12">
							<div class="row col-md-12">
								<div id="project_cats_footer" class="col-md-4">
									
								</div>
								<div id="product_cats_footer" class="col-md-4">
									
								</div>
								<div id="cont"  class="col-md-4">

								</div>
								{{--<div id="" class="col-md-4">
									<div>
										<ul class="list-inline footermenu"><br/>
											<li class="list-inline-item"><a href="{{route('front-about')}}">クロファンとは</a></li><br/>
											<li class="list-inline-item"><a href="{{route('front-faq')}}">よくある質問</a></li><br/>
											<li class="list-inline-item"><a href="{{route('front-terms')}}">利用規約</a></li><br/>
											<li class="list-inline-item"><a href="{{route('front-privacy')}}">プライバシーポリシー</a></li><br/>
											<li class="list-inline-item"><a href="{{route('front-transaction-law')}}">特定商取引法に関する表記</a></li><br/>
											<li class="list-inline-item"><a href="{{route('front-company-profile')}}">運営会社</a></li><br/>
											<li class="list-inline-item"><a href="{{route('front-company-profile')}}">お問い合わせ</a></li><br/>
											<li class="list-inline-item"><a href="{{route('front-company-profile')}}">メディア実績</a></li><br/>
										</ul>
									</div>
								</div>--}}
							</div>
							
						</div>
						{{--<div class="col-md-2 col-sm-12 footerbtn">
							<a href="{{route('front-contact')}}" class="btn btn-primary pull-right">お問い合わせ</a>
						</div>--}}
					</div>
				</div>
			</footer>

		</div>


<!-- jQuery first, then Tether, then Bootstrap JS. -->

		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script> -->
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->

		<script type="text/javascript" src="{{Request::root()}}/assets/front/library/slick/slick.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>


		<script src="https://unpkg.com/vue"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>

		<script type="text/javascript">
			Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
			var english = /^[A-Za-z0-9]*$/;
		</script>





		@yield('custom_js')


		<script type="text/javascript">
			$(function(){
				$('.project-category').on('click', function(){
					console.log('clicked');
					$(this).next('.project-subcategory').show();
				});

				$('.top_sm_menu, .project_category_sm_data').on('change', function(){
					var geturl = $(this).val();
					window.location = geturl;
				});
			})
			$( document ).ready(function() {
				var ajaxurl_project_cats_list = "{{route('project-cats-list')}}";
				$.ajax({
						type:'GET',
						url: ajaxurl_project_cats_list,
						success:function(data) {
							console.log(data);
							$("#project_cats").html(data);
						}
				});
				var ajaxurl_project_cats_list_footer = "{{route('project-cats-list-footer')}}";
				$.ajax({
						type:'GET',
						url: ajaxurl_project_cats_list_footer,
						success:function(data) {
							console.log(data);
							$("#project_cats_footer").html(data);
						}
				});
				var ajaxurl_product_cats_list = "{{route('product-cats-list')}}";
				$.ajax({
						type:'GET',
						url: ajaxurl_product_cats_list,
						success:function(data) {
							console.log(data);
							$("#product_cats").html(data);
						}
				});
				var ajaxurl_product_cats_list_footer = "{{route('product-cats-list-footer')}}";
				$.ajax({
						type:'GET',
						url: ajaxurl_product_cats_list_footer,
						success:function(data) {
							console.log(data);
							$("#product_cats_footer").html(data);
						}
				});
				var ajaxurl_product_cont_list_footer = "{{route('all-content-for-footer')}}";
				$.ajax({
						type:'GET',
						url: ajaxurl_product_cont_list_footer,
						success:function(data) {
							console.log(data);
							$("#cont").html(data);
						}
				});
			});
			function categoryWiseProductList(id)
			{
				var cat_id = id;
				var url = '{{ route("category-wise-products", ":slug") }}';
				url = url.replace(':slug', cat_id);
				window.open(url, '_blank'); 
				// window.open('/category-wise-products/'+cat_id, '_blank'); 
				// window.location.href = '/category-wise-products/'+cat_id;
				// var url_prime = "{{ route('category-wise-products', ['id'=> 0])}}";
				// URL = url_prime.replace(/0/, cat_id);
				// console.log(URL);
				// window.location.href = URL;
			}
			function contList(id)
			{
				var cont_id = id;
				var url = '{{ route("any-cont", ":slug") }}';
				url = url.replace(':slug', cont_id);
				window.open(url); 
				// window.open('/category-wise-products/'+cat_id, '_blank'); 
				// window.location.href = '/category-wise-products/'+cat_id;
				// var url_prime = "{{ route('category-wise-products', ['id'=> 0])}}";
				// URL = url_prime.replace(/0/, cat_id);
				// console.log(URL);
				// window.location.href = URL;
			}
			function contact()
			{
				var url = '{{ route("front-contact") }}';
				window.open(url); 
			}
			function categoryWiseProjectList(id)
			{
				var cat_id = id;
				var url = '{{ route("category-wise-projects", ":slug") }}';
				url = url.replace(':slug', cat_id);
				window.open(url, '_blank'); 
				// window.location.href=url;
				// window.location.href = '/category-wise-projects/'+cat_id;
				// var url_prime = "{{ route('category-wise-products', ['id'=> 0])}}";
				// URL = url_prime.replace(/0/, cat_id);
				// console.log(URL);
				// window.location.href = URL;
			}
      // sabiks
			function show_conv(id1, id2){
					var from = id1;
					var to = id2;
					$('#sender').val(from);
					$('#receiver').val(to);
					var ajaxurl = "{{route('user-get-conversation')}}";
					{{--ajaxurl = ajaxurl.replace(':id1', from);
					ajaxurl = ajaxurl.replace(':id2', to);
					alert(ajaxurl);--}}
				$.ajax({
							url: ajaxurl,
							type: "POST",
							data: {
									'from': from,
									'to': to 
							},
							success: function(data){
									$data = $(data); // the HTML content that controller has produced
									{{--$('#item-container').hide().html($data).fadeIn();--}}
									$('#conversation').html($data);
							}
					});
					document.getElementById('id01').style.display='block'
			}
			//Show return policies
			function show_rewards(id){
				var ajaxurl = "{{route('get-reward-details')}}";
				$.ajax({
						url: ajaxurl,
						type: "POST",
						data: {
							"_token" : "{{ csrf_token() }}",
							"id"     : id 
						},
						success: function(data){
								$data = $(data); // the HTML content that controller has produced
								{{--$('#item-container').hide().html($data).fadeIn();--}}
								$('#reward_details').html($data);
								document.getElementById('investors').style.display='block';
						}
				});
			}
			function show_investor(id){
				var ajaxurl = "{{route('get-investor-details')}}";
				$.ajax({
						url: ajaxurl,
						type: "POST",
						data: {
							"_token": "{{ csrf_token() }}",
							"id" : id 
						},
						success: function(data){
								$data = $(data); // the HTML content that controller has produced
								{{--$('#item-container').hide().html($data).fadeIn();--}}
								$('#investor_details').html($data);
								document.getElementById('investors_intro').style.display='block';
						}
					});
			}
      function toggleDropdown (e) {
        const _d = $(e.target).closest('.dropdown'),
            _m = $('.dropdown-menu', _d);
        setTimeout(function(){
          const shouldOpen = e.type !== 'click' && _d.is(':hover');
          _m.toggleClass('show', shouldOpen);
          _d.toggleClass('show', shouldOpen);
          $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
        }, e.type === 'mouseleave' ? 300 : 0);
      }
			function show(){
				$('.tooltiptext').toggle();
			}
			function show_sm(){
				$('#large_menu').html('');
				$('.tooltiptext').toggle();
			}
			// Top dropdowns toggle
			$('#product').on('click', function(){
				$('#project').css('color', 'gray');
				if($(this).css('color') == 'rgb(128, 128, 128)')
					$(this).css('color', 'red');
				else
					$(this).css('color', 'gray');
				$('#navbarSupportedContent_project').hide();
				$('#navbarSupportedContent_product').toggle();
			});
			$('#product_small').on('click', function(){
				$('#project_small').css('color', 'gray');
				if($(this).css('color') == 'rgb(128, 128, 128)')
					$(this).css('color', 'red');
				else
					$(this).css('color', 'gray');
				$('#navbarSupportedContent_project').hide();
				$('#navbarSupportedContent_product').toggle();
			});
			$('#project').on('click', function(){
				$('#product').css('color', 'gray');
				if($(this).css('color') == 'rgb(128, 128, 128)')
					$(this).css('color', 'red');
				else
					$(this).css('color', 'gray');
				$('#navbarSupportedContent_product').hide();
				$('#navbarSupportedContent_project').toggle();
			});
			$('#project_small').on('click', function(){
				$('#product_small').css('color', 'gray');
				if($(this).css('color') == 'rgb(128, 128, 128)')
					$(this).css('color', 'red');
				else
					$(this).css('color', 'gray');
				$('#navbarSupportedContent_product').hide();
				$('#navbarSupportedContent_project').toggle();
			});
			// profile navigation
			$('#my-page').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-my-page')}}";
			});
			$('#my-name').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-my-page')}}";
			});
			$('#projectdrafts').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-project-list')}}";
			});
			$('#projectsupport').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-invest-list')}}";
			});
			$('#projectUpload').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-project-add')}}";
			});
			$('#productUpload').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-product-add')}}";
			});
			$('#purchasehistory').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-purchase-list')}}";
			});
			$('#myproducts').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-product-list')}}";
			});
			$('#myorders').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-order-list')}}";
			});
			$('#myfavorite').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-favourite-project-list')}}";
			});
			$('#mymessage').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-message-inbox')}}";
			});
			$('#editprofile').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-profile-update')}}";
			});
			$('#editmail').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-email-update')}}";
			});
			$('#editpassword').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-change-password')}}";
			});
			$('#editaddress').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-shipping-address-update')}}";
			});
			// $('#withdrawal').on('click', function(){
			// 		$('.tooltiptext').toggle();
			// 		window.location.href = "{{route('user-withdrawal')}}";
			// });
			$('#logout').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-logout')}}";
			});
			// ends
			// profile navigation small screen
			$('#my-name-sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-my-page')}}";
			});
			$('#my-page_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-my-page')}}";;
			});
			$('#projectdrafts_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-project-list')}}";
			});
			$('#projectsupport_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-invest-list')}}";
			});
			$('#projectUpload-sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-project-add')}}";
			});
			$('#purchasehistory_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-purchase-list')}}";
			});
			$('#myproducts_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-product-list')}}";
			});
			$('#myorders_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-order-list')}}";
			});
			$('#productUpload-sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-product-add')}}";
			});
			$('#myfavorite_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-favourite-project-list')}}";
			});
			$('#mymessage_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-message-inbox')}}";
			});
			$('#editprofile_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-profile-update')}}";
			});
			$('#editmail_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-email-update')}}";
			});
			$('#editpassword_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-change-password')}}";
			});
			$('#editaddress_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-shipping-address-update')}}";
			});
			// $('#withdrawal_sm').on('click', function(){
			// 		$('.tooltiptext').toggle();
			// 		window.location.href = "/user/user-withdrawal";
			// });
			$('#logout_sm').on('click', function(){
					$('.tooltiptext').toggle();
					window.location.href = "{{route('user-logout')}}";
			});
			// ends
      $('body')
        .on('mouseenter mouseleave','.dropdown',toggleDropdown)
        .on('click', '.dropdown-menu a', toggleDropdown);

      /* not needed, prevents page reload for SO example on menu link clicked */
      $('.dropdown a').on('click tap', e => e.preventDefault())
		</script>
	</body>
</html>
