<form class="form-inline" action="{{route('front-search')}}" method="get">
	<div class="input-group input_search m-2" style="width: 200px; padding-left: 20px;">
		<input style="border-radius: 0px; border-left: none; border-right: none; border-top: none; border-bottom: 4px solid #dcdcdc; font-size: 12px" type="text" class="form-control" placeholder="{{ __('main.search') }}" aria-describedby="basic-addon2" name="title" id="title" value="{{Request::get('title')}}">
	</div>
</form>
<style>
	#title:focus{
		border-bottom: 3px #f64744 solid !important;
		outline: white !important;
		-webkit-appearance: none;
	}
</style>
