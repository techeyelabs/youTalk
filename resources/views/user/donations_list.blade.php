@extends('front.layouts.main')

@section('custom_css')
	<style type="text/css">
		.wizard > .steps > ul > li {
		    width: 20%;
		}
		.amount{
			border: 1px solid black !important;
			padding: 5px;
		}
		.no-border{
			border: none;
		}
		.box{
			border: 1px solid black !important;
		}
		.padding{
			padding: 10px;
		}
		.heading:after{
			display: block;
			height: 3px;
			background-color: #80b9f2;
			content: "";
			width: 100%;
			margin: 0 auto;
			margin-top: 10px;
			margin-bottom: 30px;
		}
		.bg-dark{
			background-color: #c6c6c6;
		}
		.div-radius{
			border: 3px solid #eaebed;
			border-radius: 5px;
		}
		.div-radius1{
			/* border: 3px solid #eaebed; */
			border-radius: 5px;
		}
		.horizontal:after{
			display: block;
			height: 2px;
			background-color: #999;
			content: "";
			width: 100%;
			margin: 0 auto;
			margin-top: 10px;
			margin-bottom: 45px;
		}
		.bg-danger{
			/* opacity: 0.9 !important; */
			background-color: #ffe3da !important;
		}

		.project_status {
			position: absolute;
			top: 15px;
			left: 3px;
			width: auto;
			padding: 5px;
			padding-left: 15px;
			padding-right: 15px;
			text-align: center;
			background-color: #ff6540;
		}
		.project-item{
			position: relative;
		}
		.icon-info{
			border: 2px solid #ff3300;
			padding-right: 10px;
			padding-left: 10px;
			padding-top: 1px;
			padding-bottom: 1px;
			border-radius: 50%;
			color: #ff3300;
			background-color: #ffffff;
		}
		.msg_send_btn{
		}



	</style>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@stop


@section('ecommerce')

@stop

@section('content')


<div class="container" style="min-height: 400px">
    <div class="">
        <?php $count = 0; ?>
        <div class="">
            <div style="height: 40px"></div>
            @if($investments)
                <div class="row col-md-12" style="padding-left: 0px !important">
                    <div class="col-md-2"></div>
                    <div class="col-md-8" style="font-size: 18px">
                        <div>
                            <table style="width: 100%">
                                <tbody>
                                    <tr>
                                        <th class="text-right" style="width: 40%">応援者名</th>
                                        <th class="text-center" style="width: 20%"></th>
                                        <th class="text-left"  style="width: 40%">応援金額</th>
                                    </tr>
                                    @foreach ($investments as $d)
                                    <tr>
										<td onclick="show_investor({{$d->id}})" class="text-right" style="cursor: pointer">{{$d->user->first_name}} {{$d->user->last_name}}</td>
										<td></td>
                                        <td onclick="show_rewards({{$d->id}})" class="text-left" style="cursor: pointer">{{$d->amount}}</td>
                                        {{--<td class="text-left">{{date_format($d->created_at, 'd-m-Y')}}</td>--}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            @endif
        </div>
    </div>
    {{--<div class="row" style="margin-top: 30px;margin-bottom: 30px;">
        <div class="col-12 text-center">
            <a href="{{ route('user-project-add') }}" class="btn btn-primary">プロジェクトを起案申請する</a>
        </div>
    </div>--}}
</div>
<div class="w3-container">
  <div id="investors" class="w3-modal" style="display: none">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
		<div id="reward_details"></div>
		<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
			<button onclick="document.getElementById('investors').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
		</div>
    </div>
  </div>
</div>
<div class="w3-container">
	<div>@include('user.layouts.message_modal', ['modal_title' => 'issue'])</div>
	<div id="investors_intro" class="w3-modal" style="display: none">
		<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
			<div id="investor_details"></div>
			<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
				<button onclick="document.getElementById('investors_intro').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
			</div>
		</div>
	</div>
</div>

@stop

@section('custom_js')
<script type="text/javascript">
	$(document).ready(function(){
		// $('.msg_send_btn').on('click', function(e){
		// 	var user_id = $(this).attr('data-user_id');
		// 	var user_name = $(this).attr('data-project_username');


		// 	$('#to_id').val(user_id);
		// 	$('#get_vendor_name').html('宛先 : ' + ' ' + user_name);
		// 	$('#send-message').modal('show');
			//$('#send-message').addClass('show');
		// });
	});
	function alter(user_id, user_name){
		// var user_id = $(this).attr('data-user_id');
		// var user_name = $(this).attr('data-project_username');
		$('#to_id').val(user_id);
		$('#get_vendor_name').html('宛先 : ' + ' ' + user_name);
		$('#send-message').modal('show');
		//$('#send-message').addClass('show');
	}
	function cls_msg_modal()
	{
		$('#send-message').modal('hide');
	}
</script>

@stop
