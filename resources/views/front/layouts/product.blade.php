<style type="text/css">
	
</style>
<script>
    
</script>


<div onclick="pressed(<?php echo $p->product->id; ?>)" class="project_item extra_div" style="height: 425px;position: relative; cursor: pointer">
    <div  class="project_img" style="height:280px; width:auto; background-color:#fff; background-image: url({{url('uploads/products/'.$p->product->image)}});background-repeat: no-repeat;
    background-position: center ; background-size: cover;"></div>
	<div class="">
		
		<ul class="project_tags list-inline project_category_items">
			<li class="list-inline-item">
				
			</li>
		</ul>
        <div class="col-md-12">
            {{--<a href="{{ route('front-product-details', $p->id) }}" style="text-decoration:none;color: black">--}}
                <div class="project_title" style="height: 40px">
                    <span title="{{$p->title}}" style="font-size: 12px;">{{str_limit($p->product->title, 60)}}</span>
                </div>
            {{--</a>--}}
        </div>
        {{--<div id="status_{{$p->product->id}}" class="col-md-12">
            @if($p->status == 1)
                新規受注
            @elseif($p->status == 2)
                配送準備中
                <br>
                伝票番号を:
                {{$p->order->document_number}}
                <br>
                配送会社を:
                {{$p->order->shipping_company}}
            @elseif($p->status == 3)
                配送済み
            @elseif($p->status == 4)
                キャンセル
                <br>
                {{$p->order->cancel_content}}
            @endif
        </div>--}}
		<div class="col-md-12">
            <div class="col-md-12 p-0">
                <div class="category_favourite mt-2">
                    <h6 class="" style="font-size:12px; color:#bfc5cc;"> <span style="color:#bfc5cc;"><span> {{ $p->product->company_name }}</span>
                    </span></h6>
                </div>
                {{--<div class="category_favourite mt-1">
                    @php
                        $fav = 0;
                    @endphp
                    @foreach ($p->product->favourite as $f)
                        @if ($f->user_id == Auth::user()->id)
                            @php
                                $fav = 1;
                            @endphp
                        @endif
                    @endforeach

                    @if ($fav == 0)
                        <a  href="{{ route('user-favourite-add-product', $p->product_id) }}" class="" style="font-size:14px;"><span style="color:#ed49b6;"> <i class="fa fa-heart"></i> </span>お気に入りに追加 </a>
                    @else
                        <span class="" style="font-size:14px;"><span style="color:#555"> <i class="fa fa-heart-o"></i> </span>お気に入り</span>
                    @endif
                </div>--}}
            </div>
            <div class="row  mt-2">
                {{--<div class="col-md-6">
                    <h5 style="font-size:12px; letter-spacing:2px;">{{$p->created_at->format('Y-m-d')}}</h5>
                </div>--}}
                <div class="col-md-12 text-right">
                    <h5 style="font-size:12px; letter-spacing:2px;">{{$p->total_point}} ポイント</h5>
                </div>
            </div>
            <span id="title_{{$p->product->id}}" style="display: none">{{$p->product->title}}</span>
            <span id="status_{{$p->product->id}}" style="display: none">{{$p->order->status}}</span>
            <span id="dno_{{$p->product->id}}" style="display: none">{{$p->order->document_number}}</span>
            <span id="shippingcomp_{{$p->product->id}}" style="display: none">{{$p->order->shipping_company}}</span>
            <span id="total_point_{{$p->product->id}}" style="display: none">{{$p->total_point}} ポイント</span>
            <span id="specifications_{{$p->product->id}}" style="display: none">{{$p->qty}}個 ／ {{$p->color}} ／ {{$p->size}}</span>
            <span id="seller_{{$p->product->id}}" style="display: none">{{$p->product->user->first_name.' '.$p->product->user->last_name}}</span>
            <span id="company_{{$p->product->id}}" style="display: none">{{$p->product->company_name}}</span>
            <span id="date_{{$p->product->id}}" style="display: none">{{$p->created_at}}</span>
            <div class="row mt-3" style="display: none">
                @php $my_rating = 0; @endphp
                @foreach ($p->product->ratings as $rating)
                    
                    @if ($rating->user_id == Auth::user()->id)

                @php
                            $my_rating = $rating->user_rating
                        @endphp
                    @endif
                @endforeach
                <span id="rating_{{$p->product->id}}" style="display: none">{{$my_rating}}</span>
                <span id="product_{{$p->product->id}}" style="display: none">{{$p->product_id}}</span>
                <span id="productprojectusername_{{$p->product->id}}" style="display: none">{{ $p->order->user->first_name.' '.$p->order->user->last_name }}</span>
                <span id="productuser_{{$p->product->id}}" style="display: none">{{$p->order->user_id}}</span>
            </div>
        </div>
		<div class="row project_item_footer">
			<div class="col-12">
				<p>{{str_limit($p->company_name, 15)}}</p>
			</div>
		</div>
	</div>
</div>


