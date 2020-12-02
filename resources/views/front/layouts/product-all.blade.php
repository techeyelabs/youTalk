<style type="text/css">
	
</style>
<script>
    
</script>
<?php
    // echo '<pre>';
    // print_r($p->id);
    // exit;
?>
    <div onclick="pressed(<?php echo $p->id; ?>)" class="project_item extra_div" style="height: 425px;position: relative;">
        <div  class="project_img" style="height:280px; width:auto; background-color:#fff; background-image: url({{url('uploads/products/'.$p->image)}});background-repeat: no-repeat;
        background-position: center ; background-size: cover;"></div>
        <div class="">
            <div class="col-md-12">
                <div class="category_favourite mt-2 mb-3">
                    <h6 class="" style="font-size:12px; color:#bfc5cc;"> <span style="color:#bfc5cc;">
                        <i class="fa fa-tag"></i> <a href="{{ route('category-wise-products', ['c' => $p->subCategory->category->id]) }}" style="color: gray" class="category">{{$p->subCategory->category->name}}</a>
                    </span></h6>
                </div>
                {{--<div class="category_favourite mt-1">
                    @php
                        $fav = 0;
                    @endphp
                    
                    @foreach ($p->favourite as $f)
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
            <div class="col-md-12">
                <a href="{{ route('front-product-details', $p->id) }}" style="text-decoration:none; color: black">
                    <p class="project_title" style="line-height: 20px">
                        <span class="cut-in-small" style="line-height: 20px; font-size: 13px" title="{{$p->title}}">{{str_limit($p->title, 65)}}</span>
                    </p>
                </a>
            </div>
            <div class="col-md-12">
                <span id="title_{{$p->id}}" style="display: none">{{$p->title}}</span>
                <span id="specifications_{{$p->id}}" style="display: none">{{$p->qty}}個 ／ {{$p->color}} ／ {{$p->size}}</span>
                <span id="seller_{{$p->id}}" style="display: none">{{$p->user->first_name.' '.$p->user->last_name}}</span>
                <span id="company_{{$p->id}}" style="display: none">{{$p->company_name}}</span>
                <span id="date_{{$p->id}}" style="display: none">{{$p->created_at}}</span>
                <div class="row mt-3" style="display: none">
                    {{--@php $my_rating = 0; @endphp
                    @foreach ($p->ratings as $rating)
                        
                        @if ($rating->user_id == Auth::user()->id)

                    @php
                                $my_rating = $rating->user_rating
                            @endphp
                        @endif
                    @endforeach--}}
                    {{--<span id="rating_{{$p->id}}" style="display: none">{{$my_rating}}</span>
                    <span id="product_{{$p->id}}" style="display: none">{{$p->product_id}}</span>
                    <span id="productprojectusername_{{$p->id}}" style="display: none">{{ $p->order->user->first_name.' '.$p->order->user->last_name }}</span>
                    <span id="productuser_{{$p->id}}" style="display: none">{{$p->order->user_id}}</span>--}}
                </div>
            </div>
            <div class="project_item_footer pr-4 row" style="padding-left: 30px">
                <div class="col-6 text-left" style="padding-left: 0px !important; padding-right: 0px !important">
                    <span class="cut-in-small" style="font-size: 12px">{{str_limit($p->company_name, 12)}}</span>
                </div>    
                <div class="col-6 text-right" style="padding-left: 0px !important; padding-right: 0px !important">
                    <span class="cut-in-small" style="font-size: 12px" id="total_point_{{$p->id}}" style="display: block">{{$p->price}} ポイント</span>
                </div>
            </div>
        </div>
    </div>


