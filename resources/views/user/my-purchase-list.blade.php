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
			background-color: #c6c6c6;
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
			margin-top: 30px;
			margin-bottom: 15px;
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

	/* for first modal */
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
    }
    /* style for modal */
    body {font-family: Arial, Helvetica, sans-serif;}

    /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content_special {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 50%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
    }
	.small_left{
		padding-right: 5%;
	}
	@media only screen and (max-width: 600px) {
		.modal-content_special {
			width: 95% !important;
		}
		.small_left{
			text-align: left !important;
		}
		.modal-padding{
			padding: 1% !important;
		}
	}

    /* Add Animation */
    @-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
    }

    @keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
    }

    /* The Close Button */
    .close {
    color: gray;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
    }

    .modal-header {
    padding: 2px 16px;
    background-color: #f1f1f1;
    color: white;
    }

    .modal-padding {
		padding: 4% !important;
	}

    .modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
	}
	.modal-backdrop {
		position: static; 
	}
</style>

@stop






@section('ecommerce')

@stop

@section('content')
<!-- first modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content_special">
    <div class="modal-header">
      <span onclick="cls()" class="close">&times;</span>
    </div>
    <div class="modal-body modal-padding">
        <div class="row col-md-12 p-2">
            <div class="col-md-6 text-right small_left">商品名　対応状況:</div>
            <div class="col-md-6"><a id="modal-title" href="#"></a></div>
        </div>
        <div class="row col-md-12 p-2">
            <div class="col-md-6 text-right small_left">対応状況:</div>
            <div class="col-md-6"><span id="modal-status"></span></div>
        </div>
        <div class="row col-md-12 p-2">
            <div class="col-md-6 text-right small_left">追跡番号:</div>
            <div class="col-md-6"><span id="modal-dno"></span></div>
        </div>
        <div class="row col-md-12 p-2">
            <div class="col-md-6 text-right small_left">配送会社:</div>
            <div class="col-md-6"><span id="modal-shippingcomp"></span></div>
        </div>
        <div class="row col-md-12 p-2">
            <div class="col-md-6 text-right small_left">ポイント:</div>
            <div class="col-md-6"><span id="modal-points"></span></div>
        </div>
        <div class="row col-md-12 p-2">
            <div class="col-md-6 text-right small_left">商品詳細:</div>
            <div class="col-md-6"><span id="modal-specification"></span></div>
        </div>
        <div class="row col-md-12 p-2">
            <div class="col-md-6 text-right small_left">販売者名:</div>
            <div class="col-md-6"><span id="modal-seller"></span></div>
        </div>
        <div class="row col-md-12 p-2">
            <div class="col-md-6 text-right small_left">会社名:</div>
            <div class="col-md-6"><span id="modal-company"></span></div>
        </div>
        <div class="row col-md-12 p-2">
            <div class="col-md-6 text-right small_left">注文日:</div>
            <div class="col-md-6"><span id="modal-date"></span></div>
        </div>
        <div class="row col-md-12 p-2">
            <div class="col-md-6 col-sm-12 mb-4">
                <button id="rate_product" type="button" class="p-2 editbtn text-white btn btn-md btn-block font-weight-bold btn-primary rating_btn" data-my-rate="0" data-product-id = "0" data-toggle="modal" data-target="#star">★★★  レビューを書く</button>
            </div>
            <div class="col-md-6 col-sm-12">
                <button id="text_user" class="p-2 text-white btn btn-md btn-block font-weight-bold msg_send_btn btn-default"  
                        data-user_id="" data-project_username="" 
                        style="cursor:pointer; color:#fff;"> <span style="color:#fff !important;"> 
                        <i class="fa fa-envelope"></i> </span>
                            メッセージを送る
                </button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- first modal ends -->

<!-- message modal starts -->
<div id="send-message" style="display: none; z-index: 999;" class="modal">
  <div class="modal-content_special p-4">
  	<div class="modal-header m-3">
      <span onclick="cls_msg_modal()" class="close">&times;</span>
    </div>
    <div class="">
		<form action="{{route('user-send-message')}}" method="post">
			{!! csrf_field() !!}
			<input type="hidden" name="to_id" value="" id="to_id">
			<div class="">
				<h5 class=""><span id=""></span> {{ isset($modal_title)?$modal_title:"商品提供者へのメッセージ" }}</h5>
				<p class="col-12 mb-0 pb-0" id="get_vendor_name"></p>
				<div class="form-group col-md-12 mt-0 pt-0">
					<input class="form-control" type="hidden" name="name" value="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}" requried readonly>
				</div>
				<div class="form-group col-md-12">
					<label for="">件名</label>
					<input class="form-control" name="subject" placeholder="件名" required maxlength="100">
				</div>
				<div class="form-group col-md-12">
					<label for="">内容</label>
				<textarea name="message" rows="4" cols="80" class="form-control" placeholder="内容" required maxlength="2000"></textarea>
				</div>
				<div class="col-md-12">
					<h4 class="text-center text-white"> <button type="submit" class="btn btn-warning text-white" style="background:#618ca9;">メッセージ送信</button></h4>
				</div>
			</div>
      	</form>
    </div>
  </div>
</div>
<!-- message modal ends -->


<div class="container">
	<div class="mt20">
		<div class="row inner flex_cont pl-2">
			<div class="col-12 pb-5 text-left">
				<h4 class="">購入済み商品</h4>
			</div>
		</div>
		<div class="row flex_cont p-2">
			@if ($products)
				@foreach ($products as $p)
					<div class="col-md-3">
						@include('front.layouts.product')
					</div>
				@endforeach
			@endif
		</div>
	</div>
</div>

@include('user.layouts.star-rating')

@stop

@section('custom_js')

	<script type="text/javascript">
			$(document).ready(function(){
				$('.msg_send_btn').on('click', function(e){
					var user_id = $(this).attr('data-user_id');
					var user_name = $(this).attr('data-project_username');
					$('#to_id').val(user_id);
					$('#project_user_name').val(user_name);
					$('#send-message').modal('show');
					$('.modal_backdrop').hide();
					// $('#send-message').addClass('show');
				});
			});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.rating_btn').on('click', function(){
				var product_id = $(this).attr('data-product-id');
					var my_rate = parseInt($(this).attr('data-my-rate'));
				// console.log(product_id);
				$('#get_product_id').val(product_id);
				$('#get_my_rate').val(my_rate);

				if (my_rate == 1) {
					$('#one').addClass('active');
					$('#two').removeClass('active');
					$('#three').removeClass('active');
					$('#four').removeClass('active');
					$('#five').removeClass('active');
				}else if (my_rate == 2) {
					$('#one').removeClass('active');
					$('#two').addClass('active');
					$('#three').removeClass('active');
					$('#four').removeClass('active');
					$('#five').removeClass('active');
				}else if (my_rate == 3) {
					$('#one').removeClass('active');
					$('#two').removeClass('active');
					$('#three').addClass('active');
					$('#four').removeClass('active');
					$('#five').removeClass('active');
				}else if (my_rate == 4) {
					$('#one').removeClass('active');
					$('#two').removeClass('active');
					$('#three').removeClass('active');
					$('#four').addClass('active');
					$('#five').removeClass('active');

				}else if (my_rate == 5) {
					$('#one').removeClass('active');
					$('#two').removeClass('active');
					$('#three').removeClass('active');
					$('#four').removeClass('active');
					$('#five').addClass('active');
				}

			});

			$('.rating').on('click', function(){
				var rate = $(this).attr('data-rating');
				$('#get_rating').val(rate);
				// console.log($('#get_rating').val());
				// $(this).addClass('active');
				var getId = $(this).attr('id');
				console.log(getId);
				if (getId == 'one') {
					$('#one').addClass('active');
					$('#two').removeClass('active');
					$('#three').removeClass('active');
					$('#four').removeClass('active');
					$('#five').removeClass('active');
				}else if (getId == 'two') {
					$('#one').removeClass('active');
					$('#two').addClass('active');
					$('#three').removeClass('active');
					$('#four').removeClass('active');
					$('#five').removeClass('active');
				}else if (getId == 'three') {
					$('#one').removeClass('active');
					$('#two').removeClass('active');
					$('#three').addClass('active');
					$('#four').removeClass('active');
					$('#five').removeClass('active');
				}else if (getId == 'four') {
					$('#one').removeClass('active');
					$('#two').removeClass('active');
					$('#three').removeClass('active');
					$('#four').addClass('active');
					$('#five').removeClass('active');
				}else if (getId == 'five') {
					$('#one').removeClass('active');
					$('#two').removeClass('active');
					$('#three').removeClass('active');
					$('#four').removeClass('active');
					$('#five').addClass('active');
				}

			});
		});
		// first modal script
		// Get the modal
		var modal = document.getElementById("myModal");

			// Get the button that opens the modal
			var btn = document.getElementById("myBtn");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal 

			function pressed(id){
				modal.style.display = "block";
				var title = $('#title_'+id).text();
				$('#modal-title').text(title);
				var url = '{{ route("front-product-details", ":slug") }}';
				url = url.replace(':slug', id);
				$("#modal-title").attr('href', url);
				var status = $('#status_'+id).text();
				var dno = $('#dno_'+id).text();
				var shippingcom = $('#shippingcomp_'+id).text();
				if(status == 1){
					$('#modal-status').text('新規受注');
					$('#modal-dno').text('未定');
					$('#modal-shippingcomp').text('未定');
				} else if(status == 2){
					$('#modal-status').text('配送準備中');
					$('#modal-dno').text(dno);
					$('#modal-shippingcomp').text(shippingcom);
				} else if(status == 3){
					$('#modal-status').text('配送済み');
					$('#modal-dno').text(dno);
					$('#modal-shippingcomp').text(shippingcom);
				} else {
					$('#modal-status').text('キャンセル');
					$('#modal-dno').text(dno);
					$('#modal-shippingcomp').text(shippingcom);
				}
				var points = $('#total_point_'+id).text();
				$('#modal-points').text(points);
				var specifications = $('#specifications_'+id).text();
				$('#modal-specification').text(specifications);
				var seller = $('#seller_'+id).text();
				$('#modal-seller').text(seller);
				var company = $('#company'+id).text();
				$('#modal-company').text(seller);
				var date = $('#date_'+id).text();
				$('#modal-date').text(date);
				var rating = $('#rating_'+id).text();
				var product = $('#product_'+id).text();
				$('#rate_product').attr('data-my-rate', rating);
				$('#rate_product').attr('data-product-id', product);
				var productuser = $('#productuser_'+id).text();
				var productprojectuser = $('#productprojectusername_'+id).text();
				$('#text_user').attr('data-user_id', productuser);
				$('#text_user').attr('data-project_username', productprojectuser);
			}
			// When the user clicks on <span> (x), close the modal
			function cls(){
				modal.style.display = "none";
			}
			function cls_msg_modal(){
				$('#send-message').modal('hide');
			}
			function cls_rating_modal(){
				$('#send-message').modal('hide');
			}
			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
	</script>

@stop







