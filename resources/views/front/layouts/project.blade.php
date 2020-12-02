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
		font-size: 13px !important;
	}
	.title_font{
		font-size: 15px !important;
	}
	
</style>

<?php
	$budget = $p->budget;
	$investment = $p->investment->where('status', true)->sum('amount');
	$done = $investment*100/$budget;
	$done = round($done);
?>

<div class="project_item four_stickers extra_div small_screen_font" style="">
	<a href="{{route('front-project-details', ['id' => $p->id])}}">
		<div  class="project_img small_sticker" style="height:220px; width:auto; background-color:#fff; background-image: url({{url('uploads/projects/'.$p->featured_image)}});background-repeat: no-repeat;
            background-position: center center; background-size: cover;">
            {{--<div class="project_status {{strtotime($p->end) < strtotime(date('Y-m-d H:i:s')) ? 'status_3' : ($done >= 100?'status_2':'status_1')}}"><span>{{strtotime($p->end) < strtotime(date('Y-m-d H:i:s')) ? '終了' : ($done >= 100?'達成':'募集中')}}</span></div>--}}
            <!-- 終了 Complete, '達成':'募集中' 'Status':'Live' -->
        </div>
	</a>
	<div class="project_text" style="padding-top: 0px !important; padding-bottom: 0px !important;">
		<ul class="project_tags list-inline project_category_items pt-2">
            <li class="list-inline-item">
                <i class="fa fa-tag"></i> <a style="font-size: 10px" href="{{ route('front-project-list', ['c' => $p->category->id]) }}" class="category">{{$p->category->name}}</a>
            </li>
			@if($p->status == 0)
				<div  style="float: right">
					<button class="edit_button point"><a href="{{ url('user/project-edit', ['id' => $p->id])}}" style="color: white">編集する</a></button>
				</div>
			@else
				<div  style="float: right">
					{{--<span style="padding: 5px; border: 1px solid green; color: green; border-radius: 3px">approved</span>--}}
				</div>
			@endif
        </ul>
		<div style="height: 40px">
			<span class="project_title pb-2">
				<a style="font-size: 12px" title="{{$p->title}}" class="title small_screen_font" href="{{route('front-project-details', ['id' => $p->id])}}">
					{{str_limit($p->title, 55)}}
				</a>
			</span>
		</div>
		<div class="row project_progress">
			<div class="col-12">
				<div class="progress project_progress" style="background-color: #cccccc">
					<div class="progress-bar bg-primary w-{{ $done }}" style="width:{{ $done }}%;" role="progressbar" aria-valuenow="{{ $done }}" aria-valuemin="0" aria-valuemax="100"><p style="margin: 0px !important; color: white">&nbsp;{{ $done }}%</p></div>
				</div>
			</div>
		</div>
		<div class="mt-2">
			<a title="{{$p->title}}" class="" target="_blank" style="color: gray" href="{{route('user-project-invest-list', ['id' => $p->id])}}">
				<div class="row project_item_footer" style="background-color: #efefef; height:52px; padding-top: 17px; cursor: pointer">
					<div class="col-4"  style="font-size: 11px; padding-right: 0px !important">
						<p>現在 {{ number_format($investment) }} 円</p>
					</div>
					<?php
						$date1 = strtotime(date('Y-m-d H:i:s'));
						$date2 = strtotime($p->end);
						$interval = floor(($date2 - $date1)/86400);
						if($interval < 0)
							$interval = '終了';
					?>
					<div class="col-4 text-center" style="padding: 2px !important">
						<?php if($interval == '終了') {?>
							<p style="font-size: 11px; color: red">{{$interval}}</p>
						<?php } else { ?>
							<p style="font-size: 11px">残り {{$interval}}日</p>
						<?php } ?>
					</div>
					<div class="col-4"  style="font-size: 11px; padding-left: 0px !important">
						<p class="text-right">応援者 {{$p->investment->where('status', true)->count()}} 人</p>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
