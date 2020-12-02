@extends('front.layouts.main')

@section('custom_css')
	<style type="text/css">
		.wizard > .steps > ul > li {
		    width: 20%;
		}
		.amount{
			border: 1px solid black !important;
			padding: 5px;
		}
		.no-border{
			border: none;
		}
		.box{
			border: 1px solid black !important;
		}
		.padding{
			padding: 10px;
		}
		.heading:after{
			display: block;
			height: 3px;
			background-color: #80b9f2;
			content: "";
			width: 100%;
			margin: 0 auto;
			margin-top: 10px;
			margin-bottom: 30px;
		}
		.bg-dark{
			background-color: #c6c6c6;
		}
		.div-radius{
			border: 3px solid #eaebed;
			border-radius: 5px;
		}
		.div-radius1{
			/* border: 3px solid #eaebed; */
			border-radius: 5px;
		}
		.horizontal:after{
			display: block;
			height: 2px;
			background-color: #999;
			content: "";
			width: 100%;
			margin: 0 auto;
			margin-top: 30px;
			margin-bottom: 30px;
		}
		.bg-danger{
			/* opacity: 0.9 !important; */
			background-color: #ffe3da !important;
		}
		.btn-dark{
			background-color: #575757;
		}

	.project_status {
    position: absolute;
    top: 15px;
    left: 3px;
    width: auto;
    padding: 5px;
    padding-left: 15px;
    padding-right: 15px;
    text-align: center;
		background-color: #ff6540;
	}
	.project-item{
		position: relative;
	}
	.icon-info{
		border: 2px solid #ff3300;
		padding-right: 10px;
		padding-left: 10px;
		padding-top: 1px;
		padding-bottom: 1px;
		border-radius: 50%;
		color: #ff3300;
		background-color: #ffffff;
	}
	.my_page_banner_div{
		height: 300px; 
		background-color: #f1f1f1
	}
	.profile_image{
		height: 300px; 
		padding-top: 6%
	}
	.profile_text{
		padding-top: 10%;
		padding-left: 1%;
		font-size: 28px
	}
	.my_page_divs{
		border: 1px solid #d0cece; 
		border-radius: 5px
	}
	@media only screen and (max-width: 600px) {
		.small_profile_image {
			width: 120px !important;
		}
		.profile_text{
			font-size: 20px !important;
			padding-left: 20%;
		}
		.my_page_banner_div{
			height: 200px; 
			background-color: #f1f1f1
		}
		.small_align{
			text-align: left !important
		}
	}


	</style>
@stop


@section('ecommerce')

@stop

@section('content')

<!-- @include('user.layouts.tab') -->


<div class="container">
	<div class="row flex_cont">
	  	<div class="offset-md-1 col-md-10 col-12">
			<div class="mt20">
				<div class="col-md-12 row my_page_banner_div">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="col-12 row">
							<div class="col-4 text-center profile_image">
								<?php
								$pic = parse_url(Auth::user()->pic);
								// dd($pic);
								if(isset($pic['host'])) $pic = Auth::user()->pic;
								else $pic = Request::root().'/uploads/'.Auth::user()->pic;
								?>
								<a href="#"><img class="small_profile_image" style="border-radius: 50%; width: 80%" src="{{$pic}}" alt="..."></a>
							</div>
							<div class="col-8 profile_text">
								<div><b><i>{{ $user->first_name }} {{$user->last_name}}</i></b></div>
								<div><i class="fa fa-trophy"></i>&nbsp;{{ $user->point }}</div>
								<div>
									@if($user->facebook_id =='')
										<img class="" style="border-radius: 50%; width: 35px" src="/uploads/profile/facebook_gray.png" alt="..."></a>
									@else
										<img class="" style="border-radius: 50%; width: 35px" src="/uploads/profile/facebook_blue.png" alt="..."></a>
									@endif
									@if($user->google_id =='')
										<img class="" style="border-radius: 50%; width: 35px" src="/uploads/profile/google_gray.png" alt="..."></a>
									@else
										<img class="" style="border-radius: 50%; width: 35px" src="/uploads/profile/google_blue.png" alt="..."></a>
									@endif
									@if($user->twitter_id =='')
										<img class="" style="border-radius: 50%; width: 35px" src="/uploads/profile/twitter_gray.png" alt="..."></a>
									@else
										<img class="" style="border-radius: 50%; width: 35px" src="/uploads/profile/twitter_blue.png" alt="..."></a>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8 text-center">	
						<br/>			
						<!-- Personal information section -->
						<div class="p-3 my_page_divs">
							<div class="text-center"><h4>個人情報</h4></div>
							<div class="row p-2">
								<div class="col-md-5 text-right small_align"><b>フリガナ</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									{{ $user->phonetic_first }} {{ $user->phonetic_last }}
								</div>
							</div>
							<div class="row p-2">
								<div class="col-md-5 text-right small_align"><b>メールアドレス</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									{{ $user->email }}
								</div>
							</div>
							<div class="row p-2">
								<div class="col-md-5 text-right small_align"><b>生年月日</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									{{ $user->profile->dob }}
								</div>
							</div>
							<div class="row p-2">
								<div class="col-md-5 text-right small_align"><b>性別</b></div>
								<div class="col-md-1"></div>
								@if ($user->profile->sex == 1)
									<div class="col-md-6 text-left">
										male
									</div>
								@else
									<div class="col-md-6 text-left">
										female
									</div>
								@endif
							</div>
							<div class="row p-2">
								<div class="col-md-5 text-right small_align"><b>電話番号</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									{{ $user->profile->phone_no }}
								</div>
							</div>
							<div class="row p-2">
								<div class="col-md-5 text-right small_align"><b>住所</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									<div>{{ $user->profile->postal_code }}</div>
									<div>{{ $user->profile->division }}</div>
									<div>{{ $user->profile->municipility }}</div>
									<div>{{ $user->profile->address }}</div>
									<div>{{ $user->profile->room_no }}</div>
								</div>
							</div>
						</div>
						<!-- Shipping information section -->
						<div class="p-3 mt-5 my_page_divs">
							<div class="text-center"><h4>配送先情報</h4></div>
							<div class="row p-2">
								<div class="col-md-5 text-right"><b>それ以降の住所</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									{{ $shipping->shipping_address }}
								</div>
							</div>
							<div class="row p-2">
								<div class="col-md-5 text-right"><b>郵便番号</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									{{ $shipping->shipping_postal_code }}
								</div>
							</div>
							<div class="row p-2">
								<div class="col-md-5 text-right"><b>福井県</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									{{ $shipping->shipping_prefecture }}
								</div>
							</div>
							<div class="row p-2">
								<div class="col-md-5 text-right"><b>市区町村</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									{{ $shipping->shipping_municipility }}
								</div>
							</div>
							<div class="row p-2">
								<div class="col-md-5 text-right"><b>マンション名・部屋番号</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									{{ $shipping->shipping_room_num }}
								</div>
							</div>
							<div class="row p-2">
								<div class="col-md-5 text-right"><b>電話番号</b></div>
								<div class="col-md-1"></div>
								<div class="col-md-6 text-left">
									{{ $shipping->shipping_phone_num }}
								</div>
							</div>
						</div>
					
					</div>
					<div class="col-md-2"></div>
					<div class="row" style="margin-top: 30px;margin-bottom: 30px;"></div>
					@php
						$error = 0;

						if (empty($user->first_name) || empty($user->last_name) || empty($user->profile->phonetic) ||  empty($user->profile->phonetic2) ||  empty($user->profile->postal_code)) {
							$error = 1;

						}
					@endphp
					<input type="hidden" name="getError" id="getError" value="{{ $error }}">

					</div>
				</div>
			</div>
	  	</div>
	</div>
</div>
@include('user.layouts.profileModal')
@include('user.layouts.star-rating')
@include('user.layouts.message_modal')




@stop

@section('custom_js')
	<script type="text/javascript">
	    // var error = document.getElementById('getError').value;
			var error = $('#getError').val();

			// error = 1;
				$(window).on('load',function(){
					console.log('error = ' + error);
						if (error == 1) {
							$('#myModal').modal('show');
						}
				});




			// $('#myModal').modal({
    	// 	backdrop: 'static',
    	// 	keyboard: false  // to prevent closing with Esc button (if you want this too)
			// });
	</script>


		<script type="text/javascript">
				$(document).ready(function(){
					$('.msg_send_btn').on('click', function(e){
						var user_id = $(this).attr('data-user_id');
						var user_name = $(this).attr('data-project_username');


						$('#to_id').val(user_id);
						$('#project_user_name').val(user_name);
						$('#send-message').modal('show');
						//$('#send-message').addClass('show');
					});




				$('.rating_btn').on('click', function(){
					var product_id = $(this).attr('data-product-id');
						var my_rate = parseInt($(this).attr('data-my-rate'));
					// console.log(product_id);
					$('#get_product_id').val(product_id);
					$('#get_my_rate').val(my_rate);

					if (my_rate == 1) {
						$('#one').addClass('active');
						$('#two').removeClass('active');
						$('#three').removeClass('active');
						$('#four').removeClass('active');
						$('#five').removeClass('active');
					}else if (my_rate == 2) {
						$('#one').removeClass('active');
						$('#two').addClass('active');
						$('#three').removeClass('active');
						$('#four').removeClass('active');
						$('#five').removeClass('active');
					}else if (my_rate == 3) {
						$('#one').removeClass('active');
						$('#two').removeClass('active');
						$('#three').addClass('active');
						$('#four').removeClass('active');
						$('#five').removeClass('active');
					}else if (my_rate == 4) {
						$('#one').removeClass('active');
						$('#two').removeClass('active');
						$('#three').removeClass('active');
						$('#four').addClass('active');
						$('#five').removeClass('active');

					}else if (my_rate == 5) {
						$('#one').removeClass('active');
						$('#two').removeClass('active');
						$('#three').removeClass('active');
						$('#four').removeClass('active');
						$('#five').addClass('active');
					}

				});

				$('.rating').on('click', function(){
					var rate = $(this).attr('data-rating');
					$('#get_rating').val(rate);
					// console.log($('#get_rating').val());
					// $(this).addClass('active');
					var getId = $(this).attr('id');
					console.log(getId);
					if (getId == 'one') {
						$('#one').addClass('active');
						$('#two').removeClass('active');
						$('#three').removeClass('active');
						$('#four').removeClass('active');
						$('#five').removeClass('active');
					}else if (getId == 'two') {
						$('#one').removeClass('active');
						$('#two').addClass('active');
						$('#three').removeClass('active');
						$('#four').removeClass('active');
						$('#five').removeClass('active');
					}else if (getId == 'three') {
						$('#one').removeClass('active');
						$('#two').removeClass('active');
						$('#three').addClass('active');
						$('#four').removeClass('active');
						$('#five').removeClass('active');
					}else if (getId == 'four') {
						$('#one').removeClass('active');
						$('#two').removeClass('active');
						$('#three').removeClass('active');
						$('#four').addClass('active');
						$('#five').removeClass('active');
					}else if (getId == 'five') {
						$('#one').removeClass('active');
						$('#two').removeClass('active');
						$('#three').removeClass('active');
						$('#four').removeClass('active');
						$('#five').addClass('active');
					}

				});
				});
		</script>

@stop
