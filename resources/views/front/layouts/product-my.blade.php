<style type="text/css">
	.carousel-caption{
		/*bottom: 20% !important;*/
	}
	.btn-cta{
		padding-top: 15px;
		padding-bottom: 15px;
	}
	.extra_div{
		background-color: white;
		/* border: 1px solid #f1f1f1; */
		border-radius: 1%;
		padding: 0%;
		box-shadow: 0 3px 7px 0 rgba(0, 0, 0, 0.2), 0 5px 15px 0 rgba(0, 0, 0, 0.19);
		font-size: 13px !important;
	}
	.title_font{
		font-size: 15px !important;
	}
	
</style>

<div class="project_item extra_div" style="height: 365px;position: relative;">
        <div class="project_img">
            <img src="{{$product->image ?  asset('uploads/products/'.$product->image) : asset('uploads/projects/1615154785167836.jpeg')}}" alt="" height="200px" width="100%" style="object-fit: cover">
        </div>
        <div class="project_text">
            <div class="project_tags list-inline project_category_items pb-2 pt-2">
                <div class="list-inline-item" style="width: 100%">
                    <i class="fa fa-tag"></i> <a href="{{ route('category-wise-products', ['c' => $product->subCategory->category->id]) }}" class="category">{{$product->subCategory->category->name}}</a>
                    <button class="edit_button point" style="float: right"><a href="{{ route('user-product-edit', $product->id) }}" style="color: white">編集する</a></button>
                </div>
            </div>
            <div class="row mt-2">
                
                {{--<div class="col-md-5">
                    @php
                        $fav = 0;
                    @endphp
                    @foreach ($product->favourite as $f)
                        @if ($f->user_id == Auth::user()->id)
                            @php
                                $fav = 1;
                            @endphp
                        @endif
                    @endforeach
                    @if ($fav == 0)
                        <a  href="{{ route('user-favourite-add-product', $product->id) }}" class="pull-right" style="font-size:14px;"><span style="color:#ed49b6;"> <i class="fa fa-heart"></i> </span>お気に入りに追加</a>
                    @else
                        <span class="pull-right" style="font-size:14px;"><span style="color:#555"> <i class="fa fa-heart-o"></i> </span>お気に入り </span>
                    @endif
                </div>--}}
            </div>
            <div class="row mt-1">
                <div class="col-md-12">
                    <a href="{{ route('front-product-details', $product->id) }}" style="text-decoration:none;color:black">
                        <span style="font-size:14px;height:25px" class="font-weight-bold">{{str_limit($product->title, 50)}}</span>
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-8">
                    <span style="font-size:13px; color:black;">{{str_limit($product->company_name, 15) }}</span>
                </div>
                <div class="col-md-4 text-right">
                    <h5 style="font-size:11px; letter-spacing:2px;">{{ $product->price }} 円</h5>
                </div>
            </div>
            {{--<div class="row  mt-3">
                <div class="col-md-9">
                    <h5 style="font-size:15px; letter-spacing:2px;">カラー：
                        @foreach ($product->color as $p_color)
                            {{ !empty($p_color->color)?$p_color->color.',':'' }}
                        @endforeach
                    </h5>
                </div>
            </div>
            <div class="row  mt-3">
                <div class="col-md-9">
                    <h5 style="font-size:15px; letter-spacing:2px;">サイズ：
                        @foreach ($product->color as $p_color)
                            {{ !empty($p_color->type)?$p_color->type.',':'' }}
                        @endforeach
                    </h5>
                </div>
            </div>--}}
            <div class=" mt-3 justify-content-center text-center">
                <div class="col-md-12">
                    <div class="div-radius1">
                        
                    </div>
                </div>
            </div>
        </div>
</div>