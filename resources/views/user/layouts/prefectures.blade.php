<?php
$Data = new App\Helpers\Data();
$prefectures = $Data->prefectures;
// dd($sorts);
?>

<select class="form-control required prefectures" name="prefectures" required>
	<option value="">選択</option>
	<?php foreach($prefectures as $p){?>
		<option value="{{$p['value']}}" {{ isset($user->profile->prefectures) && $user->profile->prefectures == $p['value'] ? 'selected' : '' }}>{{$p['name']}}</option>
	<?php }?>
</select>


@section('sort_js')

@stop
