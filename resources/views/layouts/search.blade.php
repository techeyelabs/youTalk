<form class="form-inline" name="title" onchange="x(this)">
	<div class="input-group input_search" style="width:100%">
		<input type="text" class="form-control search" placeholder="" aria-describedby="basic-addon2" name="title" value="{{Request::get('title')}}">
		<input type="hidden" class="form-control search" placeholder="" aria-describedby="basic-addon2" name="id" value="id">
		<button  class="input-group-append" style="background:white;padding:0px;border:0px;">
			<span class="input-group-text" style="height:38px" id="search_control"><i class="fa fa-search"></i></span>
		</button>
	</div>
</form>
<!-- {{--action="{{route('front-search')}}" method="get"--}} -->
@section('custom_js')
	<script type="text/javascript">
		function x (e){
			console.log(e.value)
			// var url = new URL(window.location.href);
            // var searchParams = new URLSearchParams(url.search.slice(1));
            // searchParams.delete('title');
            // searchParams.append('title',e.value);
            // document.location.replace('search'+'?'+searchParams.toString());
		}
	</script>
@stop