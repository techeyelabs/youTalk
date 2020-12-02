<style type="text/css">
	
</style>
<script>
    
</script>


<div onclick="pressed(<?php echo $p->product->id; ?>)" class="project_item extra_div" style="height: 400px;position: relative;">
    <div  class="project_img" style="height:250px; width:auto; background-color:#fff; background-image: url({{url('uploads/products/'.$p->product->image)}});background-repeat: no-repeat;
    background-position: center ; background-size: cover;"></div>
	<div class="">
		
		<ul class="project_tags list-inline project_category_items">
			<li class="list-inline-item">
				
			</li>
		</ul>

		<div class="col-md-12" style="height: 45px"><a href="{{ route('front-product-details', $p->product->id) }}" class="project_title" style="font-size: 13px; color: black"><span title="{{$p->title}}">{{str_limit($p->product->title, 65)}}</span></a></div>
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
            <div class="col-md-12 row" style="padding-left: 0px; padding-right: 0px">
                <div class="category_favourite mt-2 col-12">
                    <span style="color:#bfc5cc; font-size: 12px; float: left"><i class="fa fa-tag"></i> {{ $p->product->company_name }}
                    </span>
                    <span style="float: right; font-size: 12px">{{$p->product->price}} ポイント</span>
                </div>
                
            </div>
            <div class="row mt-3" style="display: none">
                {{--@php $my_rating = 0; @endphp
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
                <span id="productuser_{{$p->product->id}}" style="display: none">{{$p->order->user_id}}</span>--}}
                <span id="title_{{$p->product->id}}" style="display: none">{{$p->product->title}}</span>
                <span id="total_point_{{$p->product->id}}" style="display: none">{{$p->total_point}} ポイント</span>
                <span id="specifications_{{$p->product->id}}" style="display: none">{{$p->qty}}個 ／ {{$p->color}} ／ {{$p->size}}</span>
                {{--<span id="seller_{{$p->product->id}}" style="display: none">{{$p->product->user->first_name.' '.$p->product->user->last_name}}</span>--}}
                <span id="company_{{$p->product->id}}" style="display: none">{{$p->product->company_name}}</span>
                <span id="date_{{$p->product->id}}" style="display: none">{{$p->created_at}}</span>
            </div>
        </div>
		<div class="row project_item_footer">
			<div class="col-12">
				<p>{{str_limit($p->company_name, 15)}}</p>
			</div>
		</div>
	</div>
</div>


