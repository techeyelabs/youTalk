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
	}
	@media only screen and (max-width: 600px) {
		.small_collapse {
			padding-left: 5px !important;
			padding-right: 5px !important;
		}
		.big_sticker{
			height: 175px !important;
		}
	}
	@media only screen and (max-width: 600px) {
		.small_sticker {
			height: 115px !important;
		}
		.small_sticket_title{
			height: 24px !important;
		}
	}
	@media only screen and (max-width: 600px) {
		.small_screen_font {
			font-size: 9px !important;
		}
	}
	.small_sticker{
		object-fit: cover;
	}
	.big_sticker{
		width: 100%; 
		height: 480px;
		object-fit: cover
	}
	.sticker_text{
		font-size: 12px !important;
	}
	.ratio_test {
		position: relative;
		width: 100%;
		/* padding-top: 56.25%; 16:9 Aspect Ratio */
	}
</style>
<?php
	$budget = $big_one->budget;
	$investment = $big_one->investment->where('status', true)->sum('amount');
	$done = $investment*100/$budget;
	$done = round($done);
?>
<div class="col-md-12 row flex_cont" style="margin-left: 0px !important;">
	<div class="col-md-6 extra_div ratio_test" style="margin-bottom: 30px">
		<div>
			<a href="{{route('front-project-details', ['id' => $big_one->id])}}">
				<div  class="project_img" style="width:100%; background-color:#fff; background-repeat: no-repeat;
					background-position: center center; background-size: cover;">
					<img class="big_sticker" src="{{url('uploads/projects/'.$big_one->featured_image)}}" alt="First slide">
					{{--<div class="project_status {{strtotime($big_one->end) < strtotime(date('Y-m-d H:i:s')) ? 'status_3' : ($done >= 100?'status_2':'status_1')}}"><span>{{strtotime($big_one->end) < strtotime(date('Y-m-d H:i:s')) ? '終了' : ($done >= 100?'達成':'募集中')}}</span></div>--}}
					<!-- 終了 Complete, 達成':'募集中 Status':'Live --> 
				</div>
			</a>
		</div>
		<div class="project_text">
			<ul class="project_tags list-inline project_category_items special">
				<li class="list-inline-item">
					<i class="fa fa-tag"></i> <a href="{{ route('front-project-list', ['c' => $big_one->category->id]) }}" class="category">{{$big_one->category->name}}</a>
				</li>
			</ul>
			<span class="project_title "><a  style="font-size: 25px" title="{{$big_one->title}}" class="title" href="{{route('front-project-details', ['id' => $big_one->id])}}">{{str_limit($big_one->title, 90)}}</a></span>

			<div class="row project_progress pt-2 pb-2">
				<div class="col-12">
					<div class="progress project_progress">
						<div class="progress-bar bg-primary w-{{ $done }}" style="width:{{ $done }}%;" role="progressbar" aria-valuenow="{{ $done }}" aria-valuemin="0" aria-valuemax="100"><p style="margin: 0px !important; color: white">&nbsp;{{ $done }}%</p></div>
					</div>
				</div>
			</div>
			<div class="row project_item_footer">
				<div class="col-5" style="padding-right: 0px !important">
					<span class="big_sticker_small" style="font-size: 22px">現在 {{ number_format($investment) }}円</span>
				</div>
				<?php
					$date1 = strtotime(date('Y-m-d H:i:s'));
					$date2 = strtotime($big_one->end);
					$interval = floor(($date2 - $date1)/86400);
					if($interval < 0)
						$interval = '終了';
					$flag = 0;
					$start = strtotime("now");
					$end = strtotime(date('Y-m-d 23:59:59', strtotime($big_one->end)));
					$interval = ceil(abs($end - $start) / 86400);
					$hours_between = round((strtotime(date('Y-m-d 23:59:59', strtotime($big_one->end))) - strtotime("now"))/3600);
					$interval = $hours_between <= 24?$hours_between:$interval;
					$interval = ($interval < 0)?0:$interval;
					$start_real = strtotime(date('Y-m-d 01:01:01', strtotime($big_one->start)));
					if($hours_between < 24){
						$interval = $interval.($hours_between <= 24)?'時間':'日';
					}
					if($start_real > $start){
						$interval = ceil(abs($start_real - $start) / 86400);
						$hours_left = round((strtotime(date('Y-m-d 23:59:59', strtotime($big_one->start))) - strtotime("now"))/3600);
						$interval = $hours_left <= 24?$hours_left:$interval;
						$interval = ($interval < 0)?0:$interval;
						$interval = $interval.($hours_left <= 24)?'時間':'日';
					}
					if($interval <= 0)
						$interval = '終了';
				?>
				<div class="col-3 text-center" style="padding: 3px !important">
					<?php if($interval == '終了') {?>
						<p  class="big_sticker_small" style="font-size: 22px; color: red">{{$interval}}</p>
					<?php } else { ?>
						<p  class="big_sticker_small" style="font-size: 22px">残り {{$interval}}日</p>
					<?php } ?>
				</div>
				<!-- 現在 Current , 円 $ -->
				<div class="col-4 text-right" style="padding-left: 0px !important">
					<span  class="big_sticker_small" style="font-size: 22px">応援者 {{$big_one->investment->where('status', true)->count()}} 人</span>
				</div>
				<!-- 応援者 Supporter -->
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="row">
			<div class="col-6 small_collapse" style="padding-right: 5px !important">
				<?php
					$budget = $small_four[0]->budget;
					$investment = $small_four[0]->investment->where('status', true)->sum('amount');
					$done = $investment*100/$budget;
					$done = round($done);
				?>
				<div class="project_item four_stickers extra_div small_screen_font" style="">
					<a href="{{route('front-project-details', ['id' => $small_four[0]->id])}}">
						<div  class="project_img small_sticker" style="height:220px; width:auto; background-color:#fff; background-image: url({{url('uploads/projects/'.$small_four[0]->featured_image)}});background-repeat: no-repeat;
							background-position: center center; background-size: cover;">

							{{--<div class="project_status {{strtotime($small_four[0]->end) < strtotime(date('Y-m-d H:i:s')) ? 'status_3' : ($done >= 100?'status_2':'status_1')}}"><span>{{strtotime($small_four[0]->end) < strtotime(date('Y-m-d H:i:s')) ? '終了' : ($done >= 100?'達成':'募集中')}}</span></div>--}}
							<!-- 終了 Complete , 達成':'募集中 Status':'Live -->
						</div>
					</a>


					<div class="project_text" style="padding-top: 0px !important">
						<ul class="project_tags list-inline project_category_items special">
							<li class="list-inline-item">
								<i class="fa fa-tag"></i> <a style="font-size: 10px" href="{{ route('front-project-list', ['c' => $small_four[0]->category->id]) }}" class="category">{{$small_four[0]->category->name}}</a>
							</li>
						</ul>
						<span class="project_title title small_screen_font"><a class="small_screen_font special small_sticket_title" style="font-size: 12px;  height: 32px" title="{{$small_four[0]->title}}" href="{{route('front-project-details', ['id' => $small_four[0]->id])}}">{{str_limit($small_four[0]->title, 50)}}</a></span>

						<div class="row project_progress pb-2">
							<div class="col-12">
								<div class="progress project_progress">
									<div class="progress-bar bg-primary w-{{ $done }}" style="width:{{ $done }}%;" role="progressbar" aria-valuenow="{{ $done }}" aria-valuemin="0" aria-valuemax="100"><p style="margin: 0px !important; color: white">&nbsp;{{ $done }}%</p></div>
								</div>
							</div>
						</div>
						<div class="row project_item_footer special pl-3 pr-3">
							<?php
								$date1 = strtotime(date('Y-m-d H:i:s'));
								$date2 = strtotime($small_four[0]->end);
								$interval = floor(($date2 - $date1)/86400);
								if($interval < 0)
									$interval = '終了';
								$flag = 0;
								$start = strtotime("now");
								$end = strtotime(date('Y-m-d 23:59:59', strtotime($small_four[0]->end)));
								$interval = ceil(abs($end - $start) / 86400);
								$hours_between = round((strtotime(date('Y-m-d 23:59:59', strtotime($small_four[0]->end))) - strtotime("now"))/3600);
								$interval = $hours_between <= 24?$hours_between:$interval;
								$interval = ($interval < 0)?0:$interval;
								$start_real = strtotime(date('Y-m-d 01:01:01', strtotime($small_four[0]->start)));
								if($hours_between < 24){
									$interval = $interval.($hours_between <= 24)?'時間':'日';
								}
								if($start_real > $start){
									$interval = ceil(abs($start_real - $start) / 86400);
									$hours_left = round((strtotime(date('Y-m-d 23:59:59', strtotime($small_four[0]->start))) - strtotime("now"))/3600);
									$interval = $hours_left <= 24?$hours_left:$interval;
									$interval = ($interval < 0)?0:$interval;
									$interval = $interval.($hours_left <= 24)?'時間':'日';
								}
								if($interval <= 0)
									$interval = '終了';
								?>
							<div class="" style="font-size: 11px; padding-right: 0px !important">
								<span>現在 {{ number_format($investment) }} 円</span>&nbsp;
								<?php if($interval == '終了') {?>
									<span style="font-size: 11px; color: red">{{$interval}}</span>&nbsp;
								<?php } else { ?>
									<span style="font-size: 11px">残り {{$interval}}日</span>&nbsp;
								<?php } ?>
								<span class="text-right">応援者 {{$small_four[0]->investment->where('status', true)->count()}} 人</span>
							</div>
							
							<!-- 応援者 Supporter -->
						</div>
					</div>
				</div>	
			</div>
			<div class="col-6 small_collapse" style="padding-left: 5px !important">
				<?php
					$budget = $small_four[1]->budget;
					$investment = $small_four[1]->investment->where('status', true)->sum('amount');
					$done = $investment*100/$budget;
					$done = round($done);
				?>
				<div class="project_item four_stickers extra_div small_screen_font" style="">
					<a href="{{route('front-project-details', ['id' => $small_four[1]->id])}}">
						<div  class="project_img small_sticker" style="height:220px; width:auto; background-color:#fff; background-image: url({{url('uploads/projects/'.$small_four[1]->featured_image)}});background-repeat: no-repeat;
							background-position: center center; background-size: cover;">

							{{--<div class="project_status {{strtotime($small_four[1]->end) < strtotime(date('Y-m-d H:i:s')) ? 'status_3' : ($done >= 100?'status_2':'status_1')}}"><span>{{strtotime($small_four[1]->end) < strtotime(date('Y-m-d H:i:s')) ? '終了' : ($done >= 100?'達成':'募集中')}}</span></div>--}}
							<!-- 終了 Complete, '達成':'募集中' Status':'Live -->
						</div>
					</a>


					<div class="project_text"  style="padding-top: 0px !important">
						<ul class="project_tags list-inline project_category_items special">
							<li class="list-inline-item">
								<i class="fa fa-tag"></i> <a style="font-size: 10px" href="{{ route('front-project-list', ['c' => $small_four[1]->category->id]) }}" class="category">{{$small_four[1]->category->name}}</a>
							</li>
						</ul>
						<span class="project_title title small_screen_font" ><a class="small_screen_font special small_sticket_title" style="font-size: 12px;  height: 32px" title="{{$small_four[1]->title}}" class="title small_screen_font" href="{{route('front-project-details', ['id' => $small_four[1]->id])}}">{{str_limit($small_four[1]->title,50)}}</a></span>

						<div class="row project_progress pb-2">
							<div class="col-12">
								<div class="progress project_progress">
									<div class="progress-bar bg-primary w-{{ $done }}" style="width:{{ $done }}%;" role="progressbar" aria-valuenow="{{ $done }}" aria-valuemin="0" aria-valuemax="100"><p style="margin: 0px !important; color: white">&nbsp;{{ $done }}%</p></div>
								</div>
							</div>
						</div>
						<div class="row project_item_footer special pl-3 pr-3">
							<?php
								$date1 = strtotime(date('Y-m-d H:i:s'));
								$date2 = strtotime($small_four[1]->end);
								$interval = floor(($date2 - $date1)/86400);
								if($interval < 0)
									$interval = '終了';
								$flag = 0;
								$start = strtotime("now");
								$end = strtotime(date('Y-m-d 23:59:59', strtotime($small_four[1]->end)));
								$interval = ceil(abs($end - $start) / 86400);
								$hours_between = round((strtotime(date('Y-m-d 23:59:59', strtotime($small_four[1]->end))) - strtotime("now"))/3600);
								$interval = $hours_between <= 24?$hours_between:$interval;
								$interval = ($interval < 0)?0:$interval;
								$start_real = strtotime(date('Y-m-d 01:01:01', strtotime($small_four[1]->start)));
								if($hours_between < 24){
									$interval = $interval.($hours_between <= 24)?'時間':'日';
								}
								if($start_real > $start){
									$interval = ceil(abs($start_real - $start) / 86400);
									$hours_left = round((strtotime(date('Y-m-d 23:59:59', strtotime($small_four[1]->start))) - strtotime("now"))/3600);
									$interval = $hours_left <= 24?$hours_left:$interval;
									$interval = ($interval < 0)?0:$interval;
									$interval = $interval.($hours_left <= 24)?'時間':'日';
								}
								if($interval <= 0)
									$interval = '終了';
								?>
							<div class="" style="font-size: 11px; padding-right: 0px !important">
								<span>現在 {{ number_format($investment) }} 円</span>&nbsp;
								<?php if($interval == '終了') {?>
									<span style="font-size: 11px; color: red">{{$interval}}</span>&nbsp;
								<?php } else { ?>
									<span style="font-size: 11px">残り {{$interval}}日</span>&nbsp;
								<?php } ?>
								<span class="text-right">応援者 {{$small_four[1]->investment->where('status', true)->count()}} 人</span>
							</div>
							
							<!-- 応援者 Supporter -->
						</div>
					</div>
				</div>		
			</div>
		</div>
		
		<div class="row">
			<div class="col-6 small_collapse" style="padding-right: 5px !important">
				<?php
					$budget = $small_four[2]->budget;
					$investment = $small_four[2]->investment->where('status', true)->sum('amount');
					$done = $investment*100/$budget;
					$done = round($done);
				?>
				<div class="project_item four_stickers extra_div small_screen_font" style="">
					<a href="{{route('front-project-details', ['id' => $small_four[2]->id])}}">
						<div  class="project_img small_sticker" style="height:220px; width:auto; background-color:#fff; background-image: url({{url('uploads/projects/'.$small_four[2]->featured_image)}});background-repeat: no-repeat;
							background-position: center center; background-size: cover;">

							{{--<div class="project_status {{strtotime($small_four[2]->end) < strtotime(date('Y-m-d H:i:s')) ? 'status_3' : ($done >= 100?'status_2':'status_1')}}"><span>{{strtotime($small_four[2]->end) < strtotime(date('Y-m-d H:i:s')) ? '終了' : ($done >= 100?'達成':'募集中')}}</span></div>--}}
							<!-- 終了 Complete, '達成':'募集中' 'Status':'Live' -->
						</div>
					</a>


					<div class="project_text"  style="padding-top: 0px !important">
						<ul class="project_tags list-inline project_category_items special">
							<li class="list-inline-item">
								<i class="fa fa-tag"></i> <a style="font-size: 10px" href="{{ route('front-project-list', ['c' => $small_four[2]->category->id]) }}" class="category">{{$small_four[2]->category->name}}</a>

							</li>
						</ul>
						<span class="project_title title small_screen_font" ><a class="small_screen_font special small_sticket_title" style="font-size: 12px; height: 32px" title="{{$small_four[2]->title}}" class="title small_screen_font" href="{{route('front-project-details', ['id' => $small_four[2]->id])}}">{{str_limit($small_four[2]->title, 50)}}</a></span>

						<div class="row project_progress pb-2">
							<div class="col-12">
								<div class="progress project_progress">
									<div class="progress-bar bg-primary w-{{ $done }}" style="width:{{ $done }}%;" role="progressbar" aria-valuenow="{{ $done }}" aria-valuemin="0" aria-valuemax="100"><p style="margin: 0px !important; color: white">&nbsp;{{ $done }}%</p></div>
								</div>
							</div>
						</div>
						<div class="row project_item_footer special pl-3 pr-3">
							<?php
								$date1 = strtotime(date('Y-m-d H:i:s'));
								$date2 = strtotime($small_four[2]->end);
								$interval = floor(($date2 - $date1)/86400);
								if($interval < 0)
									$interval = '終了';
								$flag = 0;
								$start = strtotime("now");
								$end = strtotime(date('Y-m-d 23:59:59', strtotime($small_four[2]->end)));
								$interval = ceil(abs($end - $start) / 86400);
								$hours_between = round((strtotime(date('Y-m-d 23:59:59', strtotime($small_four[2]->end))) - strtotime("now"))/3600);
								$interval = $hours_between <= 24?$hours_between:$interval;
								$interval = ($interval < 0)?0:$interval;
								$start_real = strtotime(date('Y-m-d 01:01:01', strtotime($small_four[2]->start)));
								if($hours_between < 24){
									$interval = $interval.($hours_between <= 24)?'時間':'日';
								}
								if($start_real > $start){
									$interval = ceil(abs($start_real - $start) / 86400);
									$hours_left = round((strtotime(date('Y-m-d 23:59:59', strtotime($small_four[2]->start))) - strtotime("now"))/3600);
									$interval = $hours_left <= 24?$hours_left:$interval;
									$interval = ($interval < 0)?0:$interval;
									$interval = $interval.($hours_left <= 24)?'時間':'日';
								}
								if($interval <= 0)
									$interval = '終了';
								?>
							<div class="" style="font-size: 11px; padding-right: 0px !important">
								<span>現在 {{ number_format($investment) }} 円</span>&nbsp;
								<?php if($interval == '終了') {?>
									<span style="font-size: 11px; color: red">{{$interval}}</span>&nbsp;
								<?php } else { ?>
									<span style="font-size: 11px">残り {{$interval}}日</span>&nbsp;
								<?php } ?>
								<span class="text-right">応援者 {{$small_four[2]->investment->where('status', true)->count()}} 人</span>
							</div>
							
							<!-- 応援者 Supporter -->
						</div>
					</div>
				</div>	
			</div>
			<div class="col-6 small_collapse" style="padding-left: 5px !important">
				<?php
					$budget = $small_four[3]->budget;
					$investment = $small_four[3]->investment->where('status', true)->sum('amount');
					$done = $investment*100/$budget;
					$done = round($done);
				?>
				<div class="project_item four_stickers extra_div small_screen_font" style="">
					<a href="{{route('front-project-details', ['id' => $small_four[3]->id])}}">
						<div  class="project_img small_sticker" style="height:220px; width:auto; background-color:#fff; background-image: url({{url('uploads/projects/'.$small_four[3]->featured_image)}});background-repeat: no-repeat;
							background-position: center center; background-size: cover;">

							{{--<div class="project_status {{strtotime($small_four[3]->end) < strtotime(date('Y-m-d H:i:s')) ? 'status_3' : ($done >= 100?'status_2':'status_1')}}"><span>{{strtotime($small_four[3]->end) < strtotime(date('Y-m-d H:i:s')) ? '終了' : ($done >= 100?'達成':'募集中')}}</span></div>--}}
							<!-- 終了 Complete, '達成':'募集中' 'Status':'Live' -->
						</div>
					</a>


					<div class="project_text"  style="padding-top: 0px !important">
						<ul class="project_tags list-inline project_category_items special">
							<li class="list-inline-item">
								<i class="fa fa-tag"></i> <a style="font-size: 10px" href="{{ route('front-project-list', ['c' => $small_four[3]->category->id]) }}" class="category">{{$small_four[3]->category->name}}</a>
							</li>
						</ul>
						<span class="project_title title small_screen_font"><a class="small_screen_font special small_sticket_title"  style="font-size: 12px;  height: 32px" title="{{$small_four[3]->title}}" class="title small_screen_font" href="{{route('front-project-details', ['id' => $small_four[3]->id])}}">{{str_limit($small_four[3]->title, 50)}}</a></span>
						
						<div class="row project_progress pb-2">
							<div class="col-12">
								<div class="progress project_progress">
									<div class="progress-bar bg-primary w-{{ $done }}" style="width:{{ $done }}%;" role="progressbar" aria-valuenow="{{ $done }}" aria-valuemin="0" aria-valuemax="100"><p style="margin: 0px !important; color: white">&nbsp;{{ $done }}%</p></div>
								</div>
							</div>
						</div>
						<div class="row project_item_footer special pl-3 pr-3">
							<?php
								$date1 = strtotime(date('Y-m-d H:i:s'));
								$date2 = strtotime($small_four[3]->end);
								$interval = floor(($date2 - $date1)/86400);
								if($interval < 0)
									$interval = '終了';
								$flag = 0;
								$start = strtotime("now");
								$end = strtotime(date('Y-m-d 23:59:59', strtotime($small_four[3]->end)));
								$interval = ceil(abs($end - $start) / 86400);
								$hours_between = round((strtotime(date('Y-m-d 23:59:59', strtotime($small_four[3]->end))) - strtotime("now"))/3600);
								$interval = $hours_between <= 24?$hours_between:$interval;
								$interval = ($interval < 0)?0:$interval;
								$start_real = strtotime(date('Y-m-d 01:01:01', strtotime($small_four[3]->start)));
								if($hours_between < 24){
									$interval = $interval.($hours_between <= 24)?'時間':'日';
								}
								if($start_real > $start){
									$interval = ceil(abs($start_real - $start) / 86400);
									$hours_left = round((strtotime(date('Y-m-d 23:59:59', strtotime($small_four[3]->start))) - strtotime("now"))/3600);
									$interval = $hours_left <= 24?$hours_left:$interval;
									$interval = ($interval < 0)?0:$interval;
									$interval = $interval.($hours_left <= 24)?'時間':'日';
								}
								if($interval <= 0)
									$interval = '終了';
								?>
							<div class="" style="font-size: 11px; padding-right: 0px !important">
								<span>現在 {{ number_format($investment) }} 円</span>&nbsp;
								<?php if($interval == '終了') {?>
									<span style="font-size: 11px; color: red">{{$interval}}</span>&nbsp;
								<?php } else { ?>
									<span style="font-size: 11px">残り {{$interval}}日</span>&nbsp;
								<?php } ?>
								<span class="text-right">応援者 {{$small_four[3]->investment->where('status', true)->count()}} 人</span>
							</div>
							
							<!-- 応援者 Supporter -->
						</div>
					</div>
				</div>	
			</div>
		</div>
		
	</div>
</div>