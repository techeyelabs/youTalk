<?php
	$categories = App\Models\ProjectCategory::where('status', 1)->get();
?>

<div class="row">
	<div class="container">
		<div class="col-md-10 col-12 offset-md-1">
			<ul class="list-inline project_category_data pt-4">
				{{-- <li class="list-inline-item">>Top ></a></li> --}}
			<li class="list-inline-item"> <a href="{{route('front-home')}}">TOP</a>> <a href="{{route('front-product-list')}}">カタログ一覧</a> > <a href="{{route('front-product-list', ['c' => $product->subCategory->category->id])}}">{{ $product->subCategory->category->name }}</a> > {{ $product->title }}</a></li>


			</ul>


		</div>
	</div>
</div>
