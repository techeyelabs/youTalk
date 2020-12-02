@extends('front.layouts.main')

@section('custom_css')
	<style type="text/css">
		.wizard > .steps > ul > li {
		    width: 20%;
		}
		.body{

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
			background-color: #E4E4E4;
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

		/* .project_status {
	    position: absolute;
	    top: 15px;
	    left: 3px;
	    width: auto;
	    padding: 5px;
	    padding-left: 15px;
	    padding-right: 15px;
	    text-align: center;
			background-color: #ff6540;
		} */

	.project-item{
		position: relative;
	}
	.project_status{
		/* position: absolute;
	    top: 15px;
	    left: -15px;
	    width: auto;
	    padding: 5px;
	    padding-left: 15px;
	    padding-right: 15px;
	    text-align: center; */
		position: absolute;
		top: 15px;
		left: 1px !important;
		width: auto;
		padding: 5px;
		padding-left: 15px;
		padding-right: 15px;
		text-align: center;
		background-color: #ff6540;
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
	.bg-white{
		background-color:#fff;
	}
	.content-inner-blue:before{
		display: block;
		height: 2px;
		background-color: #81ccff;
		content: "";
		width: 100%;
		margin: 0 auto;
		margin-top: 0px;
		margin-bottom: 0px;
	}

.content-inner-arrow{
	/*-webkit-clip-path: polygon(0 0, 100% 0, 100% 82%, 51% 100%, 0 82%);
	clip-path: polygon(0 0, 100% 0, 100% 82%, 51% 100%, 0 82%);*/

}
.bg-blue{
	background-color: #618ca9;
}
.no-container {
margin-left: 0 !important;
margin-right: 0 !important;
}
/* .content-inner-arrow:after{
	-webkit-clip-path: polygon(0 0, 100% 0, 100% 82%, 51% 100%, 0 82%);
	clip-path: polygon(0 0, 100% 0, 100% 82%, 51% 100%, 0 82%);
	display: block;
	height: 2px;
	background-color: #81ccff;
	content: "";
	width: 100%;
	margin: 0 auto;
	margin-top: 80px;
	margin-bottom: 0px;

} */
/* .arrow-down {
  width: 0;
  height: 0;
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;

  border-top: 20px solid #f00;
} */

	.mt40{
		margin-top: 40px !important;
	}
	#shareIcons{
		padding-bottom: 20px;
	}
	#shareIcons a{
		text-decoration: none;
		padding-top: 5px;
		padding-bottom: 5px;
	}
	.details_btm_arrow{
		position: relative;
		margin-bottom: 25px !important;
	}
	.breadcrump{
		background-color: #F1F1F1;
	}
	.breadcrump li a{
		color: #000;

	}
	.animated_butt{
		display: inline-block;
		color: #fff;
		padding: 20px 30px;
		border-radius: 5px;
		box-shadow: 0  17px 10px -10px rgba(0, 0, 0, 0.4);
		cursor: pointer;
		transition: all ease-in-out 300ms;
			
	}
	.animated_butt:hover{
		box-shadow: 0  37px 20px -20px rgba(0, 0, 0, 0.2);
		transform: translate(0, -10px);
	}
	.special:hover{
		background-color: #eceeef
	}
	.imageHolder {
    height: 500px;
    background-color:white;
    margin:10px;
    display:inline-block;
    float:left;
    position:relative;
	}
	.imageHolder img {
		max-width: 100%;
    max-height:100%;
    margin: auto;
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
	}
	</style>
@stop

<?php
$budget = $project->budget;
$invested = $project->investment->where('status', true)->sum('amount');
$done = $invested*100/$budget;
$done = round($done);
?>



@section('ecommerce')

@stop

@section('content')
	{{-- @include('front.layouts.project-details-breadcrump') --}}



<div style="padding-right: 10%; padding-left: 10%" class="small_screen_drowpdownpads">
		<div class="col-md-12 project_details_area">
			<div class="col-md-12 text-center pt-2" style="padding-bottom: 2%; font-size: 20px"><h3>{{$project->title}}</h3></div>
			<div class="row flex_cont">
				<div class="col-md-7 col-sm-12 pr-2">
					<div class="col-12 imageHolder" style="border: 1px solid #e6e6e6">
						<img src="{{ asset('uploads/projects/'. $project->featured_image) }}" alt="" class="img-fluid">
					</div>
				</div>
				<div class="col-md-5 col-sm-12 pl-2">
					<div class="row">
						<div class="col-md-8 col-sm-6 category_favourite pt-3">
							<h6 class="" style="font-size:14px; color:#bfc5cc;"> <span style="color:#bfc5cc;"> 	<i class="fa fa-tag"></i> <a href="{{route('front-project-list', ['c' => $project->category->id])}} ">{{  $project->category->name }} </a>
							</h6>
						</div>
						@php
							$fav = 0;
						@endphp
						@foreach ($project->favourite as $f)
							@if (Auth::check())
							@if ($f->user_id == Auth::user()->id)
								@php
									$fav = 1;
								@endphp
							@endif
						@endif

						@endforeach
					</div>
					<!-- <div class="row mt-1">
						<div class="col-12">
							<h5 style="font-size:20px;margin-top:10px;" class="font-weight-bold">{{$project->title}}</h5>
						</div>
					</div> -->
					@php
						$flag = 0;
						$start = strtotime("now");
						$end = strtotime(date('Y-m-d 23:59:59', strtotime($project->end)));
						$days_between = ceil(abs($end - $start) / 86400);
						$hours_between = round((strtotime(date('Y-m-d 23:59:59', strtotime($project->end))) - strtotime("now"))/3600);
						$days_between = $hours_between <= 24?$hours_between:$days_between;
						$days_between = ($days_between < 0)?0:$days_between;
						$start_real = strtotime(date('Y-m-d 01:01:01', strtotime($project->start)));
						if($start_real > $start){
							$flag = 1;
							$days_left = ceil(abs($start_real - $start) / 86400);
							$hours_left = round((strtotime(date('Y-m-d 23:59:59', strtotime($project->start))) - strtotime("now"))/3600);
							$days_left = $hours_left <= 24?$hours_left:$days_left;
							$days_left = ($days_left < 0)?0:$days_left;
						}
					@endphp
					@if($flag == 0)
						<div class="row mt-2">
							<div class="col-12">
								<span style="font-size:18px; letter-spacing:2px;">現在 </span><span style="font-size:30px; letter-spacing:1px; font-weight: 600;"> {{$invested}} 円 </span>
								<div class="progress" style="margin-top: 10px;">
									<div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$done}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$done}}%">{{$done}}%</div>
								</div>
							</div>
						</div>
						<div class="row mt-1" style="margin-bottom: 15px;">
							<div class="col-12">
								<h5 class="text-right" style="font-size:18px; letter-spacing:2px;">目標 {{App\Helpers\Number::number_format_short($budget)}} 円</h5>
							</div>
						</div>
					@else
						<div class="row mt-1" style="margin-bottom: 15px;">
							<div class="col-12">
								<h5 class="text-center" style="font-size:28px; letter-spacing:2px;">目標 {{App\Helpers\Number::number_format_short($budget)}} 円</h5>
							</div>
						</div>
					@endif
					<div class="">
						<div class="row col-md-12">
							@if($flag == 0)
								<div class="col-md-5" style="text-align: left">
										<p class="text-center p-2"><span><h5><i class="fa fa-users fa-lg"></i>  &nbsp;応援者 </h5></span> 
									<span style="font-size:30px;"><b>{{$supports}} 人</b></span></p>
								</div>
								<div class="col-md-7 text-left">
									<div class="">
										<p class="text-center p-2"><span><h5><i class="fa fa-clock-o fa-lg"></i>&nbsp;&nbsp;残り日数 </h5></span>
										<span style="font-size:30px;"><b>{{ $days_between }}{{$hours_between <= 24?'時間':'日'}}</b></span></p>
									</div>
								</div>
							@else
								<div class="col-md-12 text-center">
										<p class="text-center"><span><h5><i class="fa fa-clock-o fa-lg"></i>&nbsp;&nbsp;公開されるまで残り </h5></span>
										<span style="font-size:55px;"><b>{{ $days_left }}{{$hours_left <= 24?'時間':'日'}}</b></span></p>
									</div>
								</div>
							@endif
							
						</div>
						<div class="col-md-12 col-sm-12 mr-0 mt-5 p-0 assist_project_btn_area">
							@if($project->start > date('Y-m-d'))
								<a  id= "" title="<?php echo $project->start > date('Y-m-d')?'Payment receive not started':'invest';?>" href="" class="bg-blue text-white btn btn-lg btn-block" name="button" style=" height:80px;padding-top: 5%">プロジェクトを 支援する</a>
							@elseif($project->end < date('Y-m-d'))
								<a title="Project complete" href="#" class="bg-blue text-white btn btn-lg btn-block  <?php echo $project->start > date('Y-m-d')?'disabled':'enabled';?>" name="button" style=" height:80px;padding-top: 25px">プロジェクトを 支援する</a>
							@elseif(Auth::user())
								@if(Auth::user()->id == $project->user->id)
									<a title="<?php echo $project->start > date('Y-m-d')?'Payment receive not started':'invest';?>" href="{{route('toast', ['message' => '自己プロジェクトに支援できません！'])}}" class="bg-blue text-white btn btn-lg btn-block <?php echo $project->start > date('Y-m-d')?'disabled':'enabled';?>" name="button" style=" height:80px;padding-top: 25px">プロジェクトを 支援する</a>
								@else
									<a title="<?php echo $project->start > date('Y-m-d')?'Payment receive not started':'invest';?>" href="{{route('user-invest', ['id' => $project->id])}}" class="bg-blue text-white btn btn-lg btn-block animated_butt <?php echo $project->start > date('Y-m-d')?'disabled':'enabled';?>" name="button" style=" height:80px;">プロジェクトを 支援する</a>
								@endif
							@else
								<a title="<?php echo $project->start > date('Y-m-d')?'Payment receive not started':'invest';?>" href="{{route('user-invest', ['id' => $project->id])}}" class="bg-blue text-white btn btn-lg btn-block animated_butt <?php echo $project->start > date('Y-m-d')?'disabled':'enabled';?>" name="button" style=" height:80px;">プロジェクトを 支援する</a>
							@endif
						</div>
							@if (empty($isFavourite))
									@if ($fav == 0)
									<div class="col-md-12 col-sm-12 mr-0 mt-5 p-2 special" style="border: 1px solid #d2d2d2; text-align: center; border-radius: 4%">
										<a href="{{ route('user-favourite-add-project', $project->id) }}" class="" style="font-size:14px;text-decoration: none"><span style="color:#555;"> <i class="fa fa-heart-o"></i> </span>お気に入りに追加</a>
									</div>
									@else
									<div class="col-md-12 col-sm-12 mr-0 mt-5 p-0 special" style="border: 1px solid #d2d2d2; text-align: center; border-radius: 4%">
										<span class="" style="font-size:14px;color:#ed49b6"><i class="fa fa-heart"></i> お気に入り</span>
									</div>
									@endif
							@endif
							{{-- {{ $project->Investment->isFavourite() }} --}}
						
					
						
					</div>
					<div class="row mt-2">
						<input type="hidden" name="" id="linkUrl" value="{{ asset('project-details/'.$project->id) }}">
						{{-- <div class="col-md-2  p-2 ml-2">
							<a href="#" class="btn btn-sm btn-block text-white" style="background:#4267b2; font-size:10px;"> <span class="fa fa-facebook" style="color:#fff;"></span> facebook</a>
						</div>
						<div class="col-md-2 p-2">
							<a href="#" class="btn btn-sm btn-block text-white" style="background:#4267b2; font-size:10px;"> <span class="fa fa-facebook" style="color:#fff;"></span> facebook</a>
						</div>
						<div class="col-md-2 p-2">
							<a href="#" class="btn btn-sm btn-block text-white" style="background:#4267b2; font-size:10px;"> <span class="fa fa-facebook" style="color:#fff;"></span> facebook</a>
						</div>
						<div class="col-md-2 p-2">
							<a href="#" class="btn btn-sm btn-block text-white" style="background:#4267b2; font-size:10px;"> <span class="fa fa-facebook" style="color:#fff;"></span> facebook</a>
						</div> --}}
						<div class="ml-md-3" id="shareIcons">

						</div>
					</div>
				</div>
			</div>
		</div>
</div>
<div><hr></div>

@include('front.layouts.200-1')

@if (Auth::check())
	@include('user.layouts.message_modal', ['modal_title' => '起案者へのメッセージ'])
@endif


@stop

@section('custom_js')
	<script type="text/javascript">
			$(document).ready(function(){
				$('.msg_send_btn').on('click', function(e){
					var user_id = $(this).attr('data-user_id');
					var user_name = $(this).attr('data-project_username');


					$('#to_id').val(user_id);
					$('#get_vendor_name').html('宛先 : ' + ' ' + user_name);
					$('#send-message').modal('show');
					//$('#send-message').addClass('show');
				});
			});
	</script>

	<script type="text/javascript">

			$(function() {
				var linkurl  = $('#linkUrl').val();
				$('#shareIcons').jsSocials({
					url : linkurl,
					text : 'laravel for social sharing',
					showLabel : true,
					showCount : false,
					shareIn : "popup",
					shares : ["facebook", "twitter", "line"]
				});
			});
	</script>
	<script type="text/javascript">
			$(document).ready(function(){
				$('#not_started').on('click', function(e){
					alert('募集期間はまだ始まってません！');
					return false;
				});
			});
	</script>




@stop
