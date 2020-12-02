@extends('front.layouts.main')

@section('custom_css')
@stop

@section('content')
<div style="height: 40px"></div>
<div class="container row col-md-12" style="width: 100%">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		{{ $content->description }}
	</div>
	<div class="col-md-2"></div>

</div>
<div style="height: 40px"></div>

@stop

@section('custom_js')
@stop