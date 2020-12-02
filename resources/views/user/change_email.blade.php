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
		.btn-bottom{
			color: #fff;
 background-color: #868e96;
 border-color: #868e96;
 width: 120px;

		}
		.btn-bottom:hover{
			color: #fff;
	 background-color: #727b84;
	 border-color: #6c757d;
		}
		.step{
			border: 2px solid #868e96;
		}
		.bg-dark{
			background-color: #CCCCCC;
		}
    tr{
      width: 750px;
    }
    .border-dark {
  border-color: #343a40 !important; }
  .form-control{
    border-radius: none !important;
  }

  .text-center {
  text-align: center !important; }
	</style>
@stop


@section('ecommerce')

@stop

@section('content')

	<div>
			<div class="mt20 col-md-12 row" style="padding-right: 0px !important">
					<div class="col-md-3"></div>
					<div class="col-md-6" style="padding-right: 0px !important">
						{{-- @include('user.layouts.tab') --}}
						{{-- @include('user.layouts.message_modal') --}}
							@include('layouts.message')
							<div class="">
								<h4 class="py-2">メールアドレス変更</h4>
								<div class="col-md-12 col-12">
									{!! Form::open(['route' => 'user-email-update-action', 'method' => 'post']) !!}

									<div class="row border">
										<div class="col-md-4 col-6 bg-dark">
											<p class="pt-3 ">変更メールアドレス</p>
										</div>
										<div class="col-md-8 col-6 ">
											<div class="row pt-2">
												<div class="col-md-7 col-12 p-0 ml-md-5">
													<input type="email" class="form-control" id="inputEmail3" placeholder="" name="email" value="{{old('email')}}">
															@if ($errors->has('email'))
																				<span class="help-block">
																						<strong>{{ $errors->first('email') }}</strong>
																				</span>
																		@endif
												</div>
											</div>
										</div>
									</div>
									<div class="row border">
										<div class="col-md-4 col-6 bg-dark">
											<p class="pt-3 ">変更メールアドレス確認</p>
										</div>
										<div class="col-md-8 col-6 ">
											<div class="row pt-2">
												<div class="col-md-7 col-12 p-0 ml-md-5">
													<input type="email" class="form-control" id="inputEmail3" placeholder="" name="email_confirmation" value="">
															@if ($errors->has('email_confirmation'))
																				<span class="help-block">
																						<strong>{{ $errors->first('email_confirmation') }}</strong>
																				</span>
																		@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row p-5">
								<div class="col-md-1 offset-md-5 col-sm-2
								text-center">
									<button type="submit" class="btn btn-md btn-bottom">更新する</button>
								</div>
							</div>
						</form>
					</div>

					<div class="col-md-3"></div>
			</div>
	</div>





@stop

@section('custom_js')

@stop
