@extends('front.layouts.main')

@section('custom_css')
	<style type="text/css">
		.wizard > .steps > ul > li {
		    width: 20%;
		}
		.body{

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
			background-color: #f8f8f8;
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
			margin-top: 10px;
			margin-bottom: 45px;
		}
		.bg-danger{
			/* opacity: 0.9 !important; */
			background-color: #ffe3da !important;
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
	.bg-white{
		background-color:#fff;
	}
	.content-inner:before{
		display: block;
		height: 2px;
		background-color: #ffbc00;
		content: "";
		width: 100%;
		margin: 0 auto;
		margin-top: 0px;
		margin-bottom: 0px;
	}

.content-inner-arrow{
	-webkit-clip-path: polygon(0 0, 100% 0, 100% 82%, 51% 100%, 0 82%);
	clip-path: polygon(0 0, 100% 0, 100% 82%, 51% 100%, 0 82%);

}
.checked{
	color: #ffbc00;
}
.bg-yellow{
	background-color:#ffbc00 !important;
}
.breadcrump{
	background-color: #F1F1F1;
}
.breadcrump li a{
	color: #000;

}
.imageHolder {
    height: 500px;
    background-color:white;
    margin:10px;
    display:inline-block;
    float:left;
    position:relative;
}
.imageHolder img {
	max-width: 100%;
	max-height:100%;
	margin: auto;
	position:absolute;
	top:0;
	left:0;
	right:0;
	bottom:0;
}
/* .content-inner-arrow:after{
	-webkit-clip-path: polygon(0 0, 100% 0, 100% 82%, 51% 100%, 0 82%);
	clip-path: polygon(0 0, 100% 0, 100% 82%, 51% 100%, 0 82%);
	display: block;
	height: 2px;
	background-color: #81ccff;
	content: "";
	width: 100%;
	margin: 0 auto;
	margin-top: 80px;
	margin-bottom: 0px;

} */
/* .arrow-down {
  width: 0;
  height: 0;
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;

  border-top: 20px solid #f00;
} */
.extra_div{
	background-color: white;
    /* border: 1px solid #f1f1f1; */
    border-radius: 1%;
    padding: 0%;
    box-shadow: 0 3px 7px 0 rgba(0, 0, 0, 0.2), 0 5px 15px 0 rgba(0, 0, 0, 0.19);

}
	.product_options{
		height: 55px;
		width: 55px;
		border: 3px solid #eaebed;
    	border-radius: 5px;
	}
	.special:hover{
		background-color: #eceeef
	}

	</style>
	<style type="text/css">
		.recommend_area{
			display: inline-block;
		    color: #fff;
		    background-color: #1e7e34;
		    /* border-color: #1c7430; */
		    /* box-shadow: 0 0 0 0.2rem rgba(40,167,69,.5); */
		    padding: 2px 15px;
		}
	</style>
@stop


@section('ecommerce')

@stop

@section('content')



<div class="row bg-white ">
	<div class="container">
		<div class="row justify-content-center">
			<div class=" col-10">
				<div class="mt-5">
					<div class="text-center mb-5"><span style="font-size:25px; letter-spacing:1px;" class="font-weight-bold"> {{ $product->title }}</span></div>
					<div class="row">
						<div class="col-md-12">
							<div class="row inner_inner">
								<div class="col-md-8 pr-4">
									<div class="row">
										<div class="col-md-12 project-item imageHolder" style="border: 1px solid #e6e6e6">
											<img src="{{$product->image ? Request::root().'/uploads/products/'.$product->image : asset('uploads/projects/1615154785167836.jpeg')}}" alt="" style="object-fit: cover">
										</div>
									</div>
								</div>
								<div class="col-md-4 pt-2">
									<div class="row ">
										<div class="col-md-8 pt-2">
											<h6 class="" style="font-size:14px; color:#bfc5cc;"> <span style="color:#bfc5cc;"> <i class="fa fa-tag"></i> </span> <a href="{{route('front-product-list', ['c' => $product->subCategory->category->id])}}">{{$product->subCategory->category->name}}</a></h6>
										</div>
										@php
											$fav = 0;
										@endphp
										@foreach ($product->favourite as $f)
											@if (Auth::check())

											@if ($f->user_id == Auth::user()->id)
												@php
													$fav = 1;
												@endphp
											@endif
										@endif

										@endforeach
									</div>
									<div class="row mt-1">
										<div class="col-md-12">
											@if($product->is_featured)
												<p class="recommend_area">オススメ!</p>
											@endif
										</div>
										<div class="col-md-12">
											{{-- <h5 style="font-size:16px;" class="font-weight-bold"> こに入ります</h5> --}}
										</div>
									</div>
									
									<div class="row mt-5">
											<div class="col-md-12">
													@php
														$sum = 0;
														$totalCount = $product->ratings->count();
														if ($totalCount == 0) {
															$totalCount	= 1;													
														}
													@endphp
													@foreach ($product->ratings as $p_ratings)
														{{-- {{ $p_ratings->user_rating }}
														{{ $p_ratings->count() }} --}}
														@php
															$sum += $p_ratings->user_rating;
														@endphp
													@endforeach
													{{-- {{ $totalCount }} --}}
													@php
														$avgRating = ceil($sum / $totalCount);
													@endphp
													<p class=" mt-2">
														<span class="fa fa-star {{ $avgRating > 1?'checked':'' }}" style="font-size:20px;"></span>
														<span class="fa fa-star {{ $avgRating >= 2?'checked':'' }}" style="font-size:20px;"></span>
														<span class="fa fa-star {{ $avgRating >= 3?'checked':'' }}" style="font-size:20px;"></span>
														<span class="fa fa-star {{ $avgRating >= 4?'checked':'' }}" style="font-size:20px;"></span>
														<span class="fa fa-star {{ $avgRating >= 5?'checked':'' }}" style="font-size:20px;"></span>
														( {{ $avgRating }} )
														<input type="hidden" id="avgRate" name=""  value="{{ $avgRating }}">
													</p>

												</div>
											</div>
											<div class="col-md-12 text-right">
												<p><span class="font-weight-bold" style="font-size:35px; letter-spacing:2px;">{{ $product->price }}</span>
													<span class="" style="font-size:20px; letter-spacing:1px;">円</span>
												</p>
											</div>
											<div class="mt-5">
												<form class="" action="{{route('front-cart-add')}}" method="get">
												<div class="row">
													
												
												<?php if(count($product->color) > 0){?>

												<div class="col-md-6  mr-0 " style="height:55px; width:80px;">
													<select name="color" style="font-size:12px; width:100%;" id="" class="pt-2 pb-0 product_options"  required>
														<option value="" >カラー</option>
														<?php $colorCount = 0;?>
														@foreach ($product->color as $p_color)
															<?php if(!empty($p_color->color)){?>
																<option value="{{$p_color->color}}" style="font-size:12px;">{{$p_color->color}}</option>
															<?php $colorCount++;}?>		
														@endforeach
														<?php if($colorCount == 0){?>
															<option value="なし" style="font-size:12px;">なし</option>
														<?php }?>
													</select>
													{{-- <p class="p-0 m-0 text-center" style="font-size:12px;"></p> --}}
												</div>
												<div class="col-md-6 offset-0 mr-0 " style="height:55px; width:80px;">
													{{-- <p class="pt-2 text-center" style="font-size:11px;">サイズ <br>
														@foreach ($product->color as $p_color)
															{{ $p_color->type.',' }}
														@endforeach
													</p> --}}
													<select name="size" style="font-size:12px; width:100%;"  id="" class="pt-2 pb-0 product_options" required>
														<option value="" >サイズ</option>
														<?php $typeCount = 0;?>
														@foreach ($product->color as $p_color)
															<?php if(!empty($p_color->type)){?>
																<option value="{{$p_color->type}}" >{{$p_color->type}}</option>
															<?php $typeCount++;}?>	
														@endforeach
														<?php if($typeCount == 0){?>
															<option value="なし" style="font-size:12px;">なし</option>
														<?php }?>
													</select>
													{{-- <p class="p-0 text-center" style="font-size:12px;">M</p> --}}
												</div>

												<?php }?>
												</div>
												<div class=" offset-0  mr-0 div-radius1 mt-4 " style="height: 65px;">

														<input type="hidden" name="id" value="{{$product->id}}">
														<input type="hidden" name="price" value="{{$product->price}}">
														<input type="hidden" name="title" value="{{$product->title}}">
														<input type="hidden" name="quantity" class="add_to_cart_quantity form-control" value="1" required placeholder="数量">


														@if(Auth::user())
															@if(Auth::user()->id == $product->user->id)
																<a title="" href="{{route('toast', ['message' => '自己商品購入できません！'])}}" class="bg-blue text-white btn btn-lg btn-block" name="button" style=" height:80px;padding-top: 25px; background-color:#618ca9 !important;"><span class="fa fa-shopping-cart px-1"></span> カートに入れる</a>
															@else
																<button type="submit" class="px-3 text-white btn btn-lg btn-block  font-weight-bold animated_butt" id="cart-btn" style="background-color:#618ca9 !important; height:80%;"> <span class="fa fa-shopping-cart px-1"></span> カートに入れる</button>
															@endif
														@else
															<button type="submit" class="px-3 text-white btn btn-lg btn-block  font-weight-bold animated_butt" id="cart-btn" style="background-color:#618ca9 !important; height:80%;"> <span class="fa fa-shopping-cart px-1"></span> カートに入れる</button>
														@endif

														{{-- <div class=" div-radius1 m-0 p-0" style="height:50px"> --}}
														{{-- </div> --}}

														<input type="hidden" id="check-cart" value="{{ session('cart-success') ? 1 : 0 }}">

												</div>
												</form>
											</div>
											<div class="mt-5">
												@if (empty($isFavourite))
													<div class="col-md-12 col-sm-12 category_favourite p-1 special" style="border: 1px solid #d2d2d2; text-align: center; border-radius: 4%;">
														@if ($fav == 0)
															<a href="{{ route('user-favourite-add-product', $product->id) }}" class="" style="font-size:14px;text-decoration: none"><span style="color:#555;"> <i class="fa fa-heart-o"></i> </span>お気に入りに追加</a>
														@else
															<span class="" style="font-size:14px;"><span style="color:#ed49b6"> <i class="fa fa-heart"></i> </span>お気に入り</span>

														@endif
													</div>

												@endif
											</div>
											<div class="row">
												<div class="ml-md-3" id="shareIcons">

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	@include('user.layouts.cart-message');
	@include('front.layouts.301')
	@if (Auth::check())
		@include('user.layouts.message_modal')
	@endif

@stop

@section('custom_js')
	<script type="text/javascript">
			$(document).ready(function(){
				$('.msg_send_btn').on('click', function(e){
					var user_id = $(this).attr('data-user_id');
					var user_name = $(this).attr('data-project_username');
					var company_name = $(this).attr('data-product_company_name');


					$('#to_id').val(user_id);
					$('#project_user_name').html(user_name);
					$('#get_vendor_name').html('宛先 : ' + ' ' + company_name);

					$('#send-message').modal('show');
					//$('#send-message').addClass('show');
				});
			});
	</script>
	<script type="text/javascript">
		$(window).on('load',function(){
				var check_cart = $('#check-cart').val();
				if (check_cart == 1) {
					$('#cart-message').modal('show');
					// setTimeout(()=>{
					// 	window.location.href = '{{route('front-cart')}}'
					// }, 3000);
				}
		});
	</script>
	{{-- <script type="text/javascript">
			$(function() {
				var linkurl  = $('#linkUrl').val();
				$('#shareIcons').jsSocials({
					url : linkurl,
					text : 'laravel for social sharing',
					showLabel : true,
					showCount : false,
					shareIn : "popup",
					shares : ["facebook", "twitter", "line"]
				});
			});
	</script> --}}
@stop
