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
</style>

<?php
	$budget = $p->project->budget;
    $investment = $p->project->investment->where('status', true)->sum('amount');
    $done = $investment*100/$budget;
	$done = round($done);
	$rem = (strtotime(date('Y-m-d H:i:s')) - strtotime($p->project->end))/14400;
	if(floor($rem) < $rem)
		$rem++;
?>

<div class="project_item extra_div" style="height: 365px;position: relative;">
	<a href="{{route('front-project-details', ['id' => $p->project->id])}}">
		<div  class="project_img" style="height:200px; width:auto; background-color:#fff; background-image: url({{url('uploads/projects/'.$p->project->featured_image)}});background-repeat: no-repeat;
			background-position: center ; background-size: cover;">

			</div>
	</a>


	<div class="project_text">
		<ul class="project_tags list-inline project_category_items">
			<li class="list-inline-item">
				<i class="fa fa-tag"></i> <a href="{{ route('front-project-list', ['c' => $p->project->category->id]) }}" class="category">{{$p->project->category->name}}</a>

			</li>
		</ul>




		<h2 class="project_title"><a style="font-size: 14px"  title="{{$p->project->title}}" class="title" href="{{route('front-project-details', ['id' => $p->project->id])}}">{{str_limit($p->project->title, 90)}}</a></h2>

		<div class="row project_progress">
			<div class="col-10">
				<div class="progress project_progress">
					<div class="progress-bar bg-primary w-{{ $done }}" style="width:{{ $done }}%;" role="progressbar" aria-valuenow="{{ $done }}" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
			<div class="col-2"><p>{{ $done }}%</p></div>
		</div>
		<div class="row project_item_footer">
			<div class="col-7">
				<p style="font-size: 12px">現在 {{ number_format($investment) }} 円</p>
			</div>
			<div class="col-5">
				<p style="font-size: 12px" class="text-right">応援者 {{$p->project->investment->where('status', true)->count()}} 人</p>
			</div>
		</div>
	</div>
</div>
