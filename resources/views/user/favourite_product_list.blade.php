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
	.checked {
		color: #fff658;
	}
	.bg-blue{
		background-color:#618ca9 !important;
	}
	.bg-yellow{
		background-color:#ffbc00 !important;;
	}
	.button_plain_text{
		color: gray;
	}
	.selected{
		color: #618ca9;
		background-color: #efefef;
	}
	@media only screen and (max-width: 600px) {
		.big_tabs {
			display: none;
		}
		.small_tabs {
			display: block !important;
		}
	}
	.on-this{
		color: #03a9f4;
		border-bottom: 5px solid #f38360 !important;
	}


	</style>
@stop


@section('ecommerce')

@stop

@section('content')


<div class="container">
	<div class="mt20">
		<div class="col-md-12 col-12">
			<div class="big_tabs flex_cont">
				<ul class="nav" role="tablist">
						<li class="nav-item">
							<a class="button_plain_text nav-link {{Route::currentRouteName()=='user-favourite-project-list'?'on-this':''}}" href="{{route('user-favourite-project-list')}}">プロジェクト</a>
						</li>
						<li class="nav-item">
							<a class="selected nav-link {{Route::currentRouteName()=='user-favourite-product-list'?'on-this':''}}" href="{{route('user-favourite-product-list')}}">カタログ商品</a>
						</li>
				</ul>
			</div>
			<div class="small_tabs col-12 flex_cont" style="padding: 0px; display: none">
				<div class="col-6" style="float: left; padding: 0px !important; border: 1px solid #dcdcdc"> 
					<a class="button_plain_text nav-link {{Route::currentRouteName()=='user-favourite-project-list'?'on-this':''}}" href="{{route('user-favourite-project-list')}}"><b>プロジェクト</b></a>
				</div>
				<div class="col-6" style="float: right; padding: 0px !important;  border: 1px solid #dcdcdc"> 
					<a class="selected nav-link {{Route::currentRouteName()=='user-favourite-product-list'?'on-this':''}}" href="{{route('user-favourite-product-list')}}"><b>カタログ商品</b></a>
				</div>
			</div>
			<div class="flex_cont">
				<div id="home" class="tab-pane active row  mt-5">
					@foreach ($products as $p)
					<div class="col-md-3">
						@include('front.layouts.favoriteproduct')
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>


@stop

@section('custom_js')

@stop
