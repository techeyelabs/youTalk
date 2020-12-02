@extends('front.layouts.main')

@section('custom_css')
	<style type="text/css">
		.wizard > .steps > ul > li {
		    width: 27%;
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
		.hide{
			display: none;
		}
		.bootstrap-tagsinput{
			width: 100%;
		}
		.bootstrap-tagsinput .tag{
			color: black !important;
		}
		.actions{
			text-align: center !important;
		}
		.page_title_product_register{
			padding-top: 10px;
			padding-bottom: 10px;
			font-size: 25px;
		}
		.form-control{
			width: 99.9%;
		}
		/*steps start*/
		.wizard>.steps .number{
			display: none !important;
		}
		.wizard>.steps .steptext{
			font-size: 14px;
			text-transform: uppercase;
			color: black
		}
		.wizard>.steps .stepcount{
			font-size: 22px;
			font-weight: bold;
		}
		.wizard>.steps .stepinfo{
			font-size: 14px;
			display: block;
			color: black
		}
		.wizard>.steps a, .wizard>.steps a:hover, .wizard>.steps a:active{
			padding: 15px;
		    padding-top: 5px;
		    padding-bottom: 5px;
		    border-radius: 0px;
		    position: relative;
		}
		.wizard>.steps .current a, .wizard>.steps .current a:hover, .wizard>.steps .current a:active{
			/* background-color: #e4e5e6; */
			/* padding-left: 42px; */
			text-align: center;
			/* margin-left: -8px; */
			/* border-radius: 50% */
			border-bottom: 6px solid #618ca9
		}
		.wizard>.steps .current a:after{
			/* content: ''; */
		    /* background: #618ca9; */
		    height: 50px;
		    width: 50px;
		    position: absolute;
		    top: 10px;
		    right: -24px;
		    transform: rotate(45deg);
		    z-index: 9;
		}
		.wizard>.steps .disabled a, .wizard>.steps .disabled a:hover, .wizard>.steps .disabled a:active, .wizard>.steps .done a, .wizard>.steps .done a:hover, .wizard>.steps .done a:active{
			/* margin-left: -8px;
			padding-left: 42px; */
			/* border: 2px solid #618ca9; */
			text-align: center;
			background-color: #ffffff;
			padding-top: 3px;
    		padding-bottom: 3px;
    		position: relative;
    		border-right: none;
    		/* border-left: none; */
		}
		.wizard>.steps .done a, .wizard>.steps .done a:hover, .wizard>.steps .done a:active{
			margin-left: -8px;
			/* border-left: 2px solid #618ca9; */
			color: #aaaaaa;
		}
		.wizard>.steps .disabled a:after, .wizard>.steps .done a:after{
			/* content: ''; */
		    /* border-top: 2px solid #618ca9; */
		    /* border-right: 2px solid #618ca9; */
		    /* height: 50px; */
		    /* width: 50px; */
		    position: absolute;
		    top: 8.9px;
		    right: -24px;
		    transform: rotate(45deg);
		    z-index: 9;
		    background-color: #ffffff;
		}
		.wizard>.steps ul li:first-child a{
			margin-left: 0px !important;
		}
		.wizard>.steps ul{
			margin-left: 0% !important;
			margin-top: 0px !important;
		}
		/*steps end*/
		.error{
			color: red;
		}
		.add_color{
			background: transparent;
			color: #FFBC00;
			border: 2px solid #FFBC00;
			font-size: 18px;
		}
		.mt10{
			margin-top: 10px;
		}
		.preview_area{
			padding-top: 20px;
			/* padding-bottom: 20px; */
			/* border-bottom: 1px solid #ccc; */
		}
		.wizard>.actions{
			margin-top: 20px;
		}
		.error{
			color: red;
		}
		.required_text{
			color: red; 
			font-size: 10px
		}
		@media (max-width: 575.98px) {
			.wizard > .steps > ul > li{
		        width: 93% !important;
		    }
		    .wizard>.steps a, .wizard>.steps a:hover, .wizard>.steps a:active{
		        border-left: 2px solid #FFBC00 !important;
		        margin-left: 0px !important;
		    }
		    .wizard>.steps ul{
		    	margin-left: 0px !important;
		    }
		}
	</style>

	<link rel="stylesheet" type="text/css" href="{{Request::root()}}/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css">
@stop


@section('ecommerce')

@stop

@section('content')


<div class="container" id="new-project">


<div class="mt20">
	<div class="row col-md-12 flex_cont">
		<div class="col-md-2"></div>
		<div class="col-md-8">

			<h1 class="text-center page_title_product_register">商品を登録する</h1>

			<form id="example-form" action="" class="mt20" method="post" enctype="multipart/form-data">

				{{ csrf_field() }}

			    <div class="mt20">
			        <h3 class="step_title_area">
						<span class="stepinfo">基本情報入力</span>
					</h3>
			        <section>
						  <div class="form-group  row">
							  <div class="col-md-4">
								  	<label for="">商品名 <span class="text-danger" id="length20"></span> </label>
									<span class="required_text">必須</span>
							  </div>
							  <div class="col-md-8">
								  <input type="text" class="form-control required p_title length20" placeholder="" name="title">
							  </div>
						  </div>
						  <div class="form-group row">
							  <div class="col-md-4">
								  <label for="">商品写真</label>
								  <span class="required_text">必須</span>
							  </div>
							  <div class="col-md-8">
								  <input type="file" class="required  product_image" placeholder="" name="image">
								  <div style="font-size:12px">( ※商品の種類が複数ある場合は一枚の写真にしてアップロードしてください、)</div>
							  </div>
						  </div>
						 
						  <!-- <div class="col-md-12 row"> -->

							<div class="form-group  row">
								<div class="col-md-4">
									<label for="">カテゴリ(分類)</label>
									<span class="required_text">必須</span>
								</div>
								<div class="col-md-4">
									<select class="form-control required category" name="category">
										<!-- <option value="0">Select Category</option> -->
										<?php foreach($category as $c){?>
											<option value="{{$c->id}}">{{$c->name}}</option>
										<?php }?>
									</select>
								</div>
							</div>

							<div class="form-group  row" style="display: none">
								<div class="col-md-4">
									<label for="">サブカテゴリー</label><span class="required_text">必須</span>
								</div>
								<div class="col-md-4">
									<select class="form-control required subcategory" name="subcategory">
	
									</select>
								</div>
							</div>

						  <!-- </div> -->

						  <div class="form-group row">
							  <div class="col-md-4">
								  <label for="">販売金額 </label>
								  <span class="required_text">必須</span>
							  </div>
							  <div class="col-md-8">
								  <input type="number" class="form-control required p_price" placeholder="" name="price">
								  <span style="font-size:12px">(販売金額 ＝ 商品金額＋送料＋消費税)</span>
							  </div>
						  </div>


						  <div class="form-group row">
							  <div class="col-md-4">
								  <label for="">商品内容およびセールスポイント <span class="text-danger" id="length200_1"></span> </label>
								  <span class="required_text">必須</span>
							  </div>
							  <div class="col-md-8">
								  <textarea class="form-control required p_description length200_1 " rows="4" cols="50" name="description"></textarea>
							  </div>
						  </div>

						  <div class="form-group row">
						    <!-- <label for="">イメージ画像をアップロードする ( 複数枚可にする )</label> -->
							<div class="col-md-4"></div>
							<div class="col-md-8">
						    	<input type="file" class=" product_title_image" name="product_title_image">
							</div>
						  </div>

						  <div class="form-group row">
								<div class="col-md-4">
									<label for="">カラー・サイズ選択</label>
								</div>
								<div class="col-md-8 row">
									<div class="col-md-4">
										<input type="text" class="form-control product_color" name="color[]" placeholder="色">
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control product_type" name="type[]" placeholder="サイズ">
									</div>
								</div>
								<div class="color_option col-md-4"></div>
								<div class="text-left mt20 col-md-8">
									<button class="btn btn-warning add_color" type="button"><i class="fa fa-plus-circle"></i> カラー・サイズを追加する</button>
								</div>
						  </div>

						  <div class="form-group row">
							  <div class="col-md-4">
								  <label for="">商品詳細 <span class="text-danger" id="length200_2"></span> </label>
								  <span class="required_text">必須</span>
							  </div>
							  <div class="col-md-8">
								  <textarea class="form-control required p_details length200_2" rows="4" cols="50" name="explanation"></textarea>
								  <span style="font-size:12px">(原材料・注意事項など)</span>
							  </div>
						  </div>
						  <div class="form-group row">
							<div class="col-md-4"></div>
							<div class="col-md-8">
						    	<input type="file" class="product_details_images" name="product_details_images">
							</div>
						  </div>
						  <div class="form-group row">
							  <div class="col-md-4">
								  <label for="">企業名  <span class="text-danger" id="length20_2"></span> </label>
								  <span class="required_text">必須</span>
							  </div>
							  <div class="col-md-8">
								  <input type="text" class="form-control required company_name length20_2" name="company_name">
								  <span style="font-size:12px">(法人名を入力してください。)</span>
							  </div>
						  </div>


						  <div class="form-group row">
							  <div class="col-md-4">
								  <label for="">企業情報<span class="text-danger" id="length200_3"></span> </label>
								  <span class="required_text">必須</span>
							  </div>
							  <div class="col-md-8">
								  <textarea class="form-control required p_company_info length200_3" rows="4" cols="50" name="company_info"></textarea>
								  <span style="font-size:12px">(会社のURL、住所、お問い合わせ先など）</span>
							  </div>
						  </div>
						  <div class="form-group row">
							<div class="col-md-4"></div>
							<div class="col-md-8">
						    	<input type="file" class="company_info_image" name="company_info_image">
							</div>
						  </div>

			        </section>

			        <h3 class="step_title_area">
			        	<span class="stepinfo">情報確認</span>
			    	</h3>
			        <section>
					<div class=" bg-white ">
						<div class="container-fluid">
							<div class=" justify-content-center">
								<div class=" col-md-12 mt-5">
									<div class="text-center mb-5"><span style="font-size:25px; letter-spacing:1px;" class="font-weight-bold product_title"> </span></div>
									<div class="row inner_inner">
										<div class="col-md-7 product_image" ></div>
										<div class="col-md-5">
											<div class="row ">
												<div class="col-md-4">
													<h6 class="" style="font-size:14px; color:#bfc5cc;"> <span style="color:#bfc5cc;"> <i class="fa fa-tag"></i> <div class="product_category"></div> </span> </h6>
												</div>
												<div class="col-md-4">
													<h6 class="" style="font-size:14px; color:#bfc5cc;"> <span style="color:#bfc5cc;"> <i class="fa fa-tag"></i> <div class="product_subcategory"></div></span> </h6>
												</div>
											</div>
											<div class="row ">
												<div class="col-md-12">
													<p><span class="font-weight-bold product_price" style="font-size:23px; letter-spacing:2px;"></span>
														<span class="" style="font-size:20px; letter-spacing:1px;">ポイント</span></p>
												</div>
											</div>
											<div class="row ">
												<div id="product_color_conf" class="col-md-offset-2 col-md-6 mr-0 ml-3" style="height:55px; width:80px;">
													<div class="">カラー :</div>
													<div style="padding-top: 5px;height: auto; width: 100%; border: 1px solid #ddd; border-radius: 10px;text-align: center;" class="product_color_preview"></div>
												</div>
												<div id="product_sizes_conf" class="col-md-offset-2 col-md-6 mr-0 ml-2" style="height:55px; width:80px;">
													<div class="">サイズ :</div>
													<div style="padding-top: 5px;height: auto; width: 100%; border: 1px solid #ddd; border-radius: 10px;text-align: center;" class="product_size_preview"></div>
												</div>
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
						<div class="container-fluid">
							<div class=" justify-content-center">
								<div class="mt-5 mb-5 row">
									<div class="mb-3 col-md-8">
										<div class="bg-white ">
											<h4 class="pb-2 font-weight-bold ">商品内容およびセールスポイント</h4>
											<p class="product_description"></p>
											<div class="product_title_image"></div>
										</div>
										<div class="bg-white ">
											<h4 class="pb-2 font-weight-bold ">商品詳細</h4>
											<p class="product_details"></p>
											<div class="product_details_images"></div>
										</div>
									</div>

									<div class="mb-3 col-md-4">
										<div class="bg-white ">
											<div class="mt-4 mb-4">
												<h3>企業名</h3>
												<h5 class="product_company_name"></h5>
											</div>
											<h4 class="pb-2 font-weight-bold">企業情報</h4>
											<div class="mt-4 mb-4">
												<div class="col-md-12">
													<p class="product_company_info"></p>
												</div>
											</div>
											<div class="product_company_image"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
			        </section>

			        <h3 class="step_title_area">
			        	<!-- <span class="steptext">Step</span><span class="stepcount">3</span> -->
			        	<span class="stepinfo">完了</span>
			    	</h3>
			        <section>
			            <h4 class="text-center mt20" style="color:#FFBC00;">
			            	商品登録申請が完了しました。
			            </h4>
			            <h4 class="text-center mt20">
			            	商品の登録ありがとうございました。
						</h4>
						<h4 class="text-center mt20">
							<a href="{{route('user-product-list')}}" class="btn btn-md text-white" style="background-color:#C6C6C6;">< 戻る</a>
						</h4>
			        </section>
			    </div>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>

</div>



<div class="color_container hide">
	<div class="col-md-4"></div>
	<div class="row col-md-8 mt10">
    	<div class="col-md-4">
    		{{-- <select class="form-control product_color" name="color[]">
    			<option value="">色</option>
    			<option value="緑">緑</option>
    			<option value="黄">黄</option>
    			<option value="青白い">青白い</option>
    			<option value="ピンク">ピンク</option>
    			<option value="赤">赤</option>
    			<option value="青">青</option>
			</select> --}}
			<input type="text" class="form-control product_color" name="color[]" placeholder="色">
    	</div>
    	<div class="col-md-4">
    		{{-- <select class="form-control product_type" name="type[]">
    			<option value="">サイズ</option>
    			<option value="S">S</option>
    			<option value="M">M</option>
    			<option value="L">L</option>
    			<option value="XL">XL</option>
    			<option value="XXL">XXL</option>
			</select> --}}
			<input type="text" class="form-control product_type" name="type[]" placeholder="サイズ">
    	</div>
    </div>
</div>



@stop

@section('custom_js')

	<script src="{{Request::root()}}/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="{{Request::root()}}/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js"></script>

	<script type="text/javascript" src="{{Request::root()}}/js/jquery.validate.min.js"></script>
	

	<script type="text/javascript">


		var form = $("#example-form");

		form.validate({
			errorPlacement: function errorPlacement(error, element) { element.before(error); },
			messages: {
				price: '半角で入力すること'
			}
		});

		form.children("div").steps({
		    headerTag: "h3",
		    bodyTag: "section",
		    transitionEffect: "slideLeft",
		    // startIndex: 1,
		    startIndex: {{$finish?2:0}},
		    showFinishButtonAlways: false,


		    /* Labels */
		    labels: {
		        cancel: "Cancel?",
		        current: "current step:",
		        pagination: "Pagination",
		        finish: "完了!!",
		        next: "次へ >",
		        previous: "< 前へ",
		        loading: "Loading ..."
		    },

		  	onInit: function(event, currentIndex, newIndex){
		  		if(currentIndex == 2){
		        	$('.actions > ul > li:nth-child(1)').attr('style', 'display:none;');
		        	$('.actions > ul > li:nth-child(2)').attr('style', 'display:none;');
		        	$('.actions > ul > li:nth-child(3)').attr('style', 'display:none;');
		        }
		        $('.steps .current').prevAll().removeClass('done').addClass('disabled');
		  	},
		    onStepChanging: function (event, currentIndex, newIndex)
		    {
					var check = 0;
					if (currentIndex == 0) {

						if ($('.length20').val().length > 2000) {
							$('#length20').html('Maximum limit 2000 charactar ');
							check = 1;
						}else {
							$('#length20').html('');
							// check = 0;
						}

						if ($('.length20_2').val().length > 2000) {
							$('#length20_2').html('Maximum limit 2000 charactar ');
							check = 1;
						}else {
							$('#length20_2').html('');
							// check = 0;
						}

						if ($('.length200_1').val().length > 2000) {
							$('#length200_1').html('Maximum limit 2000 charactar ');
							check = 1;
						}else {
							$('#length200_1').html('');
							// check = 0;
						}

						if ($('.length200_2').val().length > 2000) {
							$('#length200_2').html('Maximum limit 2000 charactar ');
							check = 1;
						}else {
							$('#length200_2').html('');
							// check = 0;
						}

						if ($('.length200_3').val().length > 2000) {
							$('#length200_3').html('Maximum limit 2000 charactar ');
							check = 1;
						}else {
							$('#length200_3').html('');
							// check = 0;
						}




						if (check == 1) {
							return false;
						}
					}
		        form.validate().settings.ignore = ":disabled,:hidden";
        		return form.valid();
        		// return true;
		    },
		    onStepChanged: function (event, currentIndex, newIndex)
		    {
		        if(currentIndex == 1){
		        	$('.actions > ul > li:last-child').attr('style', '');
		        	$('.actions > ul > li:nth-child(2)').attr('style', 'display:none;');

					var colors = '';
					var sizes = '';
					$('.product_color').each(function(index, value){
						if($(this).val() != ''){
							if(colors != '') colors += ' , ';
							colors += $(this).val();
						}
						
					});
					$('.product_type').each(function(index, value){
						if($(this).val() != ''){
							if(sizes != '') sizes += ' , ';
							sizes += $(this).val();
						}
					});
					if(colors)
						$('.product_color_preview').html(colors);
					else
						$('#product_color_conf').hide();
					if(sizes)
						$('.product_size_preview').html(sizes);
					else
						$('#product_sizes_conf').hide();
					



					$('.product_title').html($('.p_title').val());

					var category_data = $('.category').children('option:selected').html();
					$('.product_category').html(category_data);

					var subcategory_data = $('.subcategory').children('option:selected').html();
					// console.log(subcategory_data);
					$('.product_subcategory').html(subcategory_data);

					$('.product_price').html($('.p_price').val());
					// var productDescription=$('.p_description').val();
					var description = '';
					var productDescription=$('.p_description').val().split('\n');
					for(var i=0;i<productDescription.length;i++){
						description= description+productDescription[i]+'<br>';
					}
					$('.product_description').html('<p>'+description+'</p>');
					
					var desce='';
					var productDetails=$('.p_details').val().split('\n');
					for(var i=0;i<productDetails.length;i++){
						desce=desce+productDetails[i]+'<br>';
					}
					$('.product_details').html('<p>'+desce+'</p>');

					$('.product_company_name').html($('.company_name').val());
					var des='';
					var productCompanyInfo=$('.p_company_info').val().split('\n');
					for(var i=0;i<productCompanyInfo.length;i++){
						des=des+productCompanyInfo[i]+'<br>';
					}
					$('.product_company_info').html('<p>'+des+'</p>');
					
		        }
		    },
		    onFinishing: function (event, currentIndex)
		    {
		        form.validate().settings.ignore = ":disabled,:hidden";
        		return form.valid();
        		// return true;
		    },
		    onFinished: function (event, currentIndex)
		    {
		        form.submit();
		    }
		});

		$(function(){
			$('.category').on('change', function(){
				console.log('working');
				loadSubCategory();
			});

			var loadSubCategory = function(){
				var category = $('.category').val();
				$.ajax({
				  url: "{{Request::root()}}/user/sub-category/"+category,
				  context: document.body
				}).done(function(response) {
				  $('.subcategory').html(response);
				});
			}	

			$('.add_color').on('click', function(){
				var html = $('.color_container').html();
				$('.color_option').before(html);
			});
			loadSubCategory();
		});

		$('.product_image').change(function(){
			if (this.files && this.files[0]) {
			    var reader = new FileReader();
			    reader.onload = function(e) {
			    	var imgcontent = '<img width="100%" height="200" style="object-fit:cover" src="'+e.target.result+'">';
			    	$('.product_image').html('<img width="100%"  height="200" style="object-fit:cover" src="'+e.target.result+'">');
			    }
			    reader.readAsDataURL(this.files[0]);
			  }
		});
		
		$('.company_info_image').change(function(){
			if (this.files && this.files[0]) {
			    var reader = new FileReader();
			    reader.onload = function(e) {
			    	var imgcontent = '<img width="100" height="100"  style="object-fit:cover" src="'+e.target.result+'">';
			    	$('.product_company_image').html('<img width="100" height="100"  style="object-fit:cover" src="'+e.target.result+'">');
			    }
			    reader.readAsDataURL(this.files[0]);
			  }
		});
		$('.product_title_image').change(function(){
			if (this.files && this.files[0]) {
			    var reader = new FileReader();
			    reader.onload = function(e) {
			    	var imgcontent = '<img width="100%" height="100"  style="object-fit:cover" src="'+e.target.result+'">';
			    	$('.product_title_image').html('<img width="100%" height="100"  style="object-fit:cover" src="'+e.target.result+'">');
			    }
			    reader.readAsDataURL(this.files[0]);
			  }
		});
		$('.product_details_images').change(function(){
			if (this.files && this.files[0]) {
			    var reader = new FileReader();
			    reader.onload = function(e) {
			    	var imgcontent = '<img width="100%" height="100"  style="object-fit:cover" src="'+e.target.result+'">';
			    	$('.product_details_images').html('<img width="100%" height="100"  style="object-fit:cover" src="'+e.target.result+'">');
			    }
			    reader.readAsDataURL(this.files[0]);
			  }
		});

	</script>

@stop
