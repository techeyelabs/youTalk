<?php
	$categories = App\Models\ProjectCategory::where('status', 1)->get();
?>

<div class="row">
	<div class="container">
		<div class="col-md-10 col-12">
			<ul class="list-inline project_category_data pt-4">
				{{-- <li class="list-inline-item">>Top ></a></li> --}}
			<li class="list-inline-item"> <a href="{{route('front-home')}}">TOP</a>> <a href="{{route('front-project-list')}}">プロジェクト一覧</a> > <a href="{{route('front-project-list', ['c' => $project->category->id])}}">{{ $project->category->name }}</a> >  {{ $project->title }}</a></li>


			</ul>


		</div>
	</div>
</div>
