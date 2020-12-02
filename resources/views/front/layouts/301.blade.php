<div class="row">
	<div class="container">
		<div class="row justify-content-center">
			<div class="mt-5 col-10">
				<div class="">
					<div class="  mb-5 row">
						<div class="mb-3 col-md-8">
							<div class="bg-white p-2">
								<span style="font-size:20px">{!!nl2br($product->description) !!}  
								</span>
							</div>
							<div class="col-md-12 project-item product-details imageHolder" style="border: 1px solid #e6e6e6">
								<img src="{{$product->product_title_image ? Request::root().'/uploads/products/'.$product->product_title_image : asset('uploads/projects/1615154785167836.jpeg')}}" alt=""  width="100%" height="400px" style="object-fit:cover">
							</div>
							<div class="bg-white p-2">
								<h4 class="pb-2 font-weight-bold"></h4>
								<p>{!!nl2br($product->explanation) !!}</p>
								<div class="product_details_images imageHolder col-md-12" style="border: 1px solid #e6e6e6">
									<img width="100%" height="200" src="{{$product->product_details_images ? Request::root().'/uploads/products/'.$product->product_details_images : asset('uploads/projects/1615154785167836.jpeg')}}" alt=""  style="object-fit:cover">
								</div>
							</div>
						</div>

						<div class="mb-3 col-md-4 ">
							<div class="bg-white p-2">
								<div class="mb-3">
									<div class="col-md-12 extra_div justify-content-center text-center p-3">
										<p class="pb-1 font-weight-bold">企業情報</p>
										<p>{{ $product->company_name }}</p>
										<p class="text-left pl-3" style="text-align: justify; text-justify:inter-word">
											{{ $product->company_info }}
										</p>
										<img src="{{$product->company_info_image ? Request::root().'/uploads/products/'.$product->company_info_image : asset('uploads/projects/1615154785167836.jpeg')}}" alt="" class="col-md-12" width="100%" height="200px;" style="object-fit: cover">
									
										<span class="col-md-12 p-0">
											@if (Auth::check())
												<button class=" text-white btn btn-md mt-3 mb-2 font-weight-bold msg_send_btn bg-yellow"  data-user_id="{{ $product->user->id }}" data-product_company_name="{{ $product->company_name ?  $product->company_name : $product->user->first_name.' '.$product->user->last_name}}" data-project_username="{{ $product->user->first_name.' '.$product->user->last_name }}" style="cursor:pointer; color:#fff;"> <span style="color:#fff !important;"> <i class="fa fa-envelope"></i> </span> メッセージを送る</button>
											@else
												<a class=" text-white btn btn-md mt-3 mb-2 font-weight-bold bg-yellow" href="{{ route('front-product-details-login', $product->id) }}"   style="cursor:pointer; color:#fff;"> <span style="color:#fff !important;"> <i class="fa fa-envelope"></i> </span> メッセージを送る</a>
											@endif
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						@foreach ($any_two as $product)
						<div class="content-inner mb-3">
							<div class="bg-white p-2">
								<div class=row>
									<div class="px-4 mb-2 col-md-12">
										<h4 class="fornt-weight-bold p-0">
											<a href="{{route('front-product-details', ['id' => $product->id])}}">{{ $product->title }}</a>
										</h4>
										{{-- <span>リターン名がここに入りますす</span> --}}

									</div>
									<div class="px-4 mb-2 col-md-12">
										<img src="{{$product->image ? Request::root().'/uploads/products/'.$product->image : asset('uploads/products/1615154785167836.jpeg')}}" alt="" class="" width="100%" height="200px">

									</div>
									<div class="px-4 mb-2 col-md-12" style="font-size:15px;">
										<h4>{{ $product->price }} ポイント</h4>
										talktomeポイントとはCrofunに登録されて いる様々な商品と交換できるポイントです。
									</div>
									<div class="px-4 mb-2 mt-1 col-md-12">
										<form action="{{route('front-cart-add')}}" method="get">
											<input type="hidden" name="id" value="{{$product->id}}">
											<input type="hidden" name="price" value="{{$product->price}}">
											<input type="hidden" name="title" value="{{$product->title}}">
											<input type="hidden" name="quantity" class="add_to_cart_quantity form-control" value="1" required placeholder="数量">
											<button type="submit" class="px-3 text-white btn btn-lg btn-block  font-weight-bold" style="background-color:#ffbc00 !important; height:80%;"> <span class="fa fa-shopping-cart px-1"></span> カートに入れる</button>
											{{-- <div class=" div-radius1 m-0 p-0" style="height:50px"> --}}
											{{-- </div> --}}
										</form>
									</div>

								</div>
							</div>
						</div>
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
