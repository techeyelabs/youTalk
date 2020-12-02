@extends('front.layouts.main')

@section('custom_css')
	<style media="screen" type="text/css">
		.title:hover{
			color: #618ca9;
		}
		.category:hover{
			color: #618ca9;
		}
		.res_banner{
				padding-left: 5%;
				padding-right: 5%;
				height: 750px;
		}
		@media only screen and (max-width: 768px) {
			.res_banner {
				height: auto !important
			}
		}
	}

	</style>
@stop

@section('content')

	<!-- <img src="/uploads/projects/{{$big_one->featured_image}}"/> -->
	<div style="width: 100%; height: 10px">&nbsp;</div>
	<div class="container res_banner">
		@include('front.layouts.banner')
	</div>
	<!-- <section class="project_tabs">
		<div class="container">
			@include('front.layouts.tabs')
		</div>
	</section> -->

	<section style="display: none" class="project_sorting">
		<div class="container">
			<div class="row">
				<div class="col-md-2 offset-md-5 col-sm-12">
					<!-- @include('front.layouts.sort') -->
				</div>
			</div>
		</div>
	</section>
	<br/>
	<br/>
	<section class="project_list flex_cont p-3" style="min-height: 275px;">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="row ml-1 mr-1">
						<div class="col-md-12">
							<div class="extra_div text-center pt-4 pb-5 pl-2 pr-2">
								<div><span style="font-size: 32px !important">資金集めをはじめよう!!</span></div>
								<div><span>誰でもかんたんに、よりスピーディに、クラウドファンディングをはじめられるようになりました。</span></div><br/>
								<div><a href="{{ route('user-project-add') }}"><button class="extra_banner_top">プロジェクトを作る</button></a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</section>
	<br/>
	<section class="project_list">
		<div class="container">
			<div class="">
				<div style="height: 40px"></div>
				<div class="text-left pl-3" style="font-size: 24px"><h2>新着順</h2></div>
				<div style="height: 40px"></div>
				<div class="row ml-1 mr-1 flex_cont">
					@foreach($latest as $p)
						<div class="col-md-3">
							@include('front.layouts.project-all')
						</div>
					@endforeach
				</div>
				{{--<div style="height: 40px"></div>
				<div class="text-left" style="font-size: 24px"><h2>お気に入り順</h2></div>
				<div style="height: 40px"></div>
				@php if(Auth::user()) { @endphp
					<div class="row ml-1 mr-1">
						@foreach($fav as $p)
							<div class="col-md-3">
								@include('front.layouts.project-fav')
							</div>
						@endforeach
					</div>
				@php } else { @endphp
					<div class="row ml-1 mr-1">
						@foreach($fav as $p)
							<div class="col-md-3">
								@include('front.layouts.project-all')
							</div>
						@endforeach
					</div>
				@php } @endphp--}}
				<div style="height: 40px"></div>
				<div class="text-left pl-3" style="font-size: 24px"><h2>支援総額順</h2></div>
				<div style="height: 40px"></div>
				<div class="row ml-1 mr-1 flex_cont">
					@foreach($most as $p)
						<div class="col-md-3">
							@include('front.layouts.project-all')
						</div>
					@endforeach
				</div>
				<div style="height: 40px"></div>
				<div class="text-left pl-3" style="font-size: 24px"><h2>終了間近順</h2></div>
				<div style="height: 40px"></div>
				<div class="row ml-1 mr-1 flex_cont">
					@foreach($almost as $p)
						<div class="col-md-3">
							@include('front.layouts.project-all')
						</div>
					@endforeach
				</div>
				<div style="height: 40px"></div>
				<div class="text-left pl-3" style="font-size: 24px"><h2>もうすぐ公開されます</h2></div>
				<div style="height: 40px"></div>
				<div class="row ml-1 mr-1 flex_cont">
					@foreach($coming as $p)
						<div class="col-md-3">
							@include('front.layouts.project-coming')
						</div>
					@endforeach
				</div>
				{{-- <div class="row mt20 justify-content-center all_project_show" style="margin-bottom: 30px;">
					<div class="col">
						<a href="{{ route('front-project-list') }}" class="btn btn-primary pull-right">> もっと</a>
					</div>
				</div> --}}
			</div>
		</div>
	</section>
@stop

@section('custom_js')
	@yield('sort_js')
	<script type="text/javascript">
		$('.banner_slider').slick({
		  centerMode: true,
		  centerPadding: '60px',
		  slidesToShow: 1,
		  responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: false,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 3
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        arrows: false,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 1
		      }
		    }
		  ]
		});
	</script>
@stop
