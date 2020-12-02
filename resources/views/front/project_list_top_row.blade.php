@extends('front.layouts.main')

@section('custom_css')
@stop

@section('content')

{{--@include('front.layouts.project-list-breadcrums-search')--}}

<div class="container">
<div class="mt20">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="popular">
					<div class="row mb-4">
						<div class="col-md-5 offset-md-0">
							<span class="project_count_area">{{$title}}</span>
						</div>
					</div>
					<div class="row projects">
					<?php
					$col = 3;
					foreach($projects as $p){ if($type == 4) {?>
                         <div class="col-md-3" style="flex-shrink: 0">
                            @include('front.layouts.project-coming')
                        </div>
                    <?php } else { ?>
                        <div class="col-md-3"  style="flex-shrink: 0">
                            @include('front.layouts.project-all')
                        </div>	
					<?php } }?>
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
