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
	// print(strtotime($p->end) < strtotime(date('Y-m-d H:i:s')));
?>

<div class="project_item extra_div" style="height: 375px;position: relative;">
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




		<div class="pt-1 pb-1"><h2 class="project_title"><a title="{{$p->title}}" class="title" href="{{route('front-project-details', ['id' => $p->project->id])}}">{{str_limit($p->project->title, 20)}}</a></h2></div>

		<div class="row project_progress pb-1">
			<div class="col-12">
				<div class="progress project_progress">
					<div class="progress-bar bg-primary w-{{ $done }}" style="width:{{ $done }}%;" role="progressbar" aria-valuenow="{{ $done }}" aria-valuemin="0" aria-valuemax="100"><p style="margin: 0px !important; color: white">&nbsp;{{ $done }}%</p></div>
				</div>
			</div>
		</div>
		<div class="row project_item_footer">
			<div class="col-7 pr-0">
				<p>現在 {{ number_format($investment) }} 円</p>
			</div>
			<div class="col-5 pl-0">
				<p class="text-right">応援者 {{$p->project->investment->where('status', true)->count()}} 人</p>
			</div>
		</div>
		<div class="row project_item_footer">
			<div class="col-12 pr-0 text-center">
				<p style="color: green">{{ number_format($p->amount) }} 円</p>
			</div>
		</div>
	</div>
</div>
