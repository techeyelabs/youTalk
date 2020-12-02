@extends('front.layouts.main')

@section('custom_css')
@stop

@section('content')


<div class="container">
<div class="mt20">
	<div class="row justify-content-center">
		<div class="col-md-12" style="min-height: 450px">
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="popular">
					<div class="row mb-4">
						<div class="col-md-5 offset-md-0">
							@if(count($projects) != 0)
								<span>すべてのプロジェクト  {{ count($projects) }}件</span>
							@else
								<span>{{ $title }}</span>
							@endif
							
						</div>
						{{--<div class="col-md-2 offset-md-7">
							@include('front.layouts.sort')
						</div>--}}
					</div>
					<div class="row projects">
					<?php
					$col = 4;
					foreach($projects as $p){?>
						<div class="col-md-3">
							@include('front.layouts.project-all')
						</div>	
					<?php }?>
					</div>
				</div>
			</div>
		</div>

		{{-- <div class="col-md-2 mt50">
			@include('front.layouts.right_menu')
		</div> --}}
	</div>

</div>

</div>


@stop

@section('custom_js')
@yield('sort_js')
@stop
