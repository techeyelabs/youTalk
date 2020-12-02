<!DOCTYPE html>
<html lang="en">
	<head>
		<title>YouTalk</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta id="token" name="token" value="{{ csrf_token() }}">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/front/css/main.css">
		<link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/user/css/main.css">
		<script
		  src="https://code.jquery.com/jquery-3.2.1.min.js"
		  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
		  crossorigin="anonymous">
		</script>



		@yield('custom_css')
		<style media="screen" type="text/css">
				.front_footer{
					position: relative !important;
				}
				#body{
					padding-bottom: 0px;
					margin-bottom: 0px;
				}
				/* .footer {
					position: fixed;
					left: 0;
					bottom: 0;
				  /* margin-top: 200px; */
					width: 100%;
					/* background-color: red; */
					/* color: white; */
					/* text-align: center; */
				} */
		</style>
	</head>
	<body>
		<div class="front">
			<header class="front_header">
				<div class="container">
					<div class="row">
						<div class="col-md-2 offset-md-1 col-sm-12">
							<a href="{{route('front-home')}}" class="logo_area pt-3"><img height="25px" src="{{Request::root()}}/assets/front/img/logo.png"></a>
						</div>
						<div class="col-md-8 col-sm-12">
							<div class="row">
								<div class="col-12">
									<ul class="list-inline float-right login_signup">
										@if(Auth::user())
										<li class="list-inline-item">
											<a href="{{route('front-cart')}}" style="position:relative;">
												<i class="fa fa-shopping-cart fa-flip-horizontal" aria-hidden="true" style="font-size:22px;color:black;"></i>
												<span class="bg-warning text-white cart-count circle">{{Cart::count()}}</span>
											</a>
										</li>
										<li class="list-inline-item"><a href="{{ route('user-my-page') }}" class="login_check text-black" style="color:black;"><i class="fa fa-user-circle user_icon"></i> <span>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</span></a></li>
										<li class="list-inline-item"><a href="{{route('user-logout')}}" class="btn btn-primary btn-sm">ログアウト</a></li>
										@else
											<li class="list-inline-item"><a href="{{ route('login') }}" class="btn btn-primary btn-sm">{{ __('main.login_title') }}</a></li>
											<li class="list-inline-item"><a href="{{ route('user-register-request') }}" class="btn btn-warning btn-sm">{{ __('main.registration_title') }}</a></li>
										@endif
									</ul>
								</div>
								<div class="col-12">
									<ul class="list-inline float-right top_menu">
										<li class="list-inline-item">
											<a href="{{route('front-about')}}" class="item {{Route::currentRouteName()=='front-about'?'active':''}}">
												{{ __('main.what_is_crofun') }}
											</a>
										</li>
										<li class="list-inline-item">
											<a href="{{route('front-product-list')}}" class="item {{Route::currentRouteName()=='front-product-list'?'active':''}}">
												{{ __('main.product_list') }}
											</a>
										</li>
										<li class="list-inline-item">
											<a href="{{route('front-faq')}}" class="item {{Route::currentRouteName()=='front-faq'?'active':''}}">
												{{ __('main.faq') }}
											</a>
										</li>
										<li class="list-inline-item">
											<a href="{{route('front-media')}}" class="item {{Route::currentRouteName()=='front-media'?'active':''}}">
												{{ __('main.media') }}
											</a>
										</li>
										<li class="list-inline-item"><a href="{{route('front-contact')}}">お問い合わせ</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>


	<div id="body">
		@yield('content')
	</div>

	<footer class="front_footer">
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-1 col-sm-12">
					<div class="row">
						<div class="col">
							<ul class="list-inline footermenu">
								<li class="list-inline-item"><a href="{{route('front-about')}}">クロファンとは</a></li>
								<li class="list-inline-item"><a href="{{route('front-faq')}}">よくある質問</a></li>
								<li class="list-inline-item"><a href="{{route('front-terms')}}">利用規約</a></li>
								<li class="list-inline-item"><a href="{{route('front-privacy')}}">プライバシーポリシー</a></li>
								<li class="list-inline-item"><a href="{{route('front-transaction-law')}}">特定商取引法に関する表記</a></li>
								<li class="list-inline-item"><a href="{{route('front-company-profile')}}">運営会社</a></li>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
								<span id="ss_gmo_img_wrapper_130-66_image_ja">
										<a href="https://jp.globalsign.com/" target="_blank" rel="nofollow">
										<img alt="SSL　GMOグローバルサインのサイトシール" border="0" id="ss_img" src="//seal.globalsign.com/SiteSeal/images/gs_noscript_130-66_ja.gif">
										</a>
										</span>
										<script type="text/javascript" src="//seal.globalsign.com/SiteSeal/gmogs_image_130-66_ja.js" defer="defer"></script>
						</div>
						<div class="col-md-8 text-center">
							<p class="copyright_area">Copyright &copy; YouTalk. All rights reserved</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-12 footerbtn">
						<a href="{{route('front-contact')}}" class="btn btn-primary pull-right">プロジェクトに関する<br>お問い合わせはこちら</a>
					</div>
			</div>
		</div>
	</footer>
</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->

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
				$('.user_top_sm_menu, .leftmenuarea_sm').on('change', function(){
					var geturl = $(this).val();
					window.location = geturl;
				});
			})
		</script>
	</body>
</html>
