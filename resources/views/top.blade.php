@extends('navbar')

@section('custom_css')
<style>
    @import "compass/css3";
    .anchorColor:hover{
        color: #D9D9D9 !important;
    }
    @media (max-width: 570px){
        .mobile_price{
            font-size: 25px!important;
        }
        .mobile{
            text-align: left!important;
            padding: 0px ;
        }
        .mobile_rate{
            text-align: right!important;
            font-size: 14px!important;
            padding: 0px ;
        }
    }
    .select_box{
        width: 100%;
        height: 39px;
        border: 1px solid #cecece;
        border-radius: 4px;
    }
    .seller_rating_tds{
        padding: 0px !important;
        border: none
    }
    @media (min-width: 570px){
        .service_title{
            overflow-y: hidden
        }
    }
    /*---------- general ----------*/
    .stars-outer {
    display: inline-block;
    position: relative;
    font-family: FontAwesome;
    }
    .stars-outer::before {
    content: "\f006 \f006 \f006 \f006 \f006";
    }
    .stars-inner {
    position: absolute;
    top: 0;
    left: 0;
    white-space: nowrap;
    overflow: hidden;
    width: 0;
    }
    .stars-inner::before {
    content: "\f005 \f005 \f005 \f005 \f005";
    color: #f8ce0b;
    }
    .attribution {
    font-size: 12px;
    color: #444;
    text-decoration: none;
    text-align: center;
    position: fixed;
    right: 10px;
    bottom: 10px;
    z-index: -1;
    }
    .attribution:hover {
    color: #1fa67a;
    }
    button:focus,
    textarea:focus,
    select:focus,
    input:focus {
        outline: 0 !important;
    }
    .form-control:focus {
        border-color: #ccc;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
</style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 mobile alternates">
            <div class="card mb-3">
                <div class="card-body">
                    <div style="max-width: 100%;">
                        <div class="row align-items-start ">
                            <div class="col-md-3 col-sm-12 p-0 mb-1">
                                <form id="category_form" action="{{route('front-search')}}" method="get">
                                    <select class="custom-select" style="width: 100% !important; height: 38px !important;" id="cat_id" name="cat_id" onchange="categoryChange(this)">
                                            <option value="0">選択</option>
                                        <?php foreach($category as $s){?>
                                            <option value="{{$s->id}}" <?php if(isset($pre_selected_cat_id)){if($pre_selected_cat_id == $s->id) echo 'selected="selected"';}?>>{{$s->cat_name}}</option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="title" id="search_title" value="">
                                    <input type="hidden" name="sort_id" id="sor" value="">
                                </form>
                            </div>
                            <div class="col-md-7 col-sm-12 mb-1 p-0 pl-md-3 pr-md-3">
                                <form id="search_form" action="{{route('front-search')}}" method="get">
                                    <div class="input-group input_search" style="width:100%">
                                        <input type="text" class="form-control search" placeholder="" aria-describedby="basic-addon2" name="title" id="search" value="{{Request::get('title')}}" onchange="x(this)" >
                                        <button  class="input-group-append" style="background:white;padding:0px;border:0px;">
                                            <span class="input-group-text" style="height:38px" id="search_control"><i class="fa fa-search"></i></span>
                                        </button>
                                        <input type="hidden" name="cat_id" id="category_id" value="">
                                        <input type="hidden" name="sort_id" id="sort" value="">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2 col-sm-12 p-0 mb-1">
                                <form id="sort_form" action="{{route('front-search')}}" method="get"> 
                                    <select class="custom-select" style="width: 100% !important; height:38px !important" id="sort_id" name="sort_id" onchange="sort(this)">
                                        <option value="1" <?php if(isset($pre_selected_sort_id)){if($pre_selected_sort_id == 1) echo 'selected="selected"';}?> >売上順</option>
                                        <option value="2" <?php if(isset($pre_selected_sort_id)){if($pre_selected_sort_id == 2) echo 'selected="selected"';}?>>評価順</option>
                                        <option value="3" <?php if(isset($pre_selected_sort_id)){if($pre_selected_sort_id == 3) echo 'selected="selected"';}?>>おすすめ順</option>
                                    </select>
                                    <input type="hidden" name="cat_id" id="sort_category_id" value="">
                                    <input type="hidden" name="title" id="sort_search_title" value="">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" row">
        <div class="col-md-12 alternates">
            @foreach($service as $s)
                @include('template.service')
            @endforeach
        </div>
    </div>
@stop

@section('custom_js')
    <script>
        
    </script>
@endsection


  
