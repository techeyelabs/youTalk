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
		.btn-bottom{
			color: #fff;
			background-color: #868e96;
			border-color: #868e96;
			width: 120px;
		}
		.btn-bottom:hover{
			color: #fff;
			background-color: #727b84;
			border-color: #6c757d;
		}
		.step{
			border: 2px solid #868e96;
		}
		.bg-dark{
			background-color: #CCCCCC;
		}
	    tr{
	      width: 750px;
	    }
	    .border-dark {
		  border-color: #343a40 !important;
		}
	  	.form-control{
	    	border-radius: none !important;
	  	}
	  	.text-center {
	  		text-align: center !important;
	 	}
	 	a{
			color: #000000;
	 	}
		a:hover{
			text-decoration: none;
			color: #000000;
		}
		.bold{
			font-weight: bold;
		}
		.button_div{
			width: 100%; 
			text-align: center; 
			padding: 20px
		}
		.msg_send_button{
			padding: 6px;
			border: 1px solid #618ca9;
			background-color: #618ca9;
			border-radius: 25px;
			color: white;
			width: 100px;
			cursor: pointer
		}
	</style>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@stop


@section('ecommerce')

@stop

@section('content')

<div class="container" style="min-height: 400px">
    <div class="col-md-10 offset-md-1 col-sm-12">
        <div class="mt20">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table style="width: 100%">
                            <tbody>
                                @foreach($messages as $th)
                                    <tr onclick="show_conv({{Auth::user()->id}}, {{$th->other_side}})">
                                        <td style="width: 30%; text-align: right"><img style="border-radius: 50%; height: 50px" src="{{Request::root().'/uploads/'.$th->threads_all->pic}}" >&nbsp;</td>
                                        <td style="width: 5%">&nbsp;</td>
                                        <td  style="width: 65%; font-size: 16px; color: gray; cursor: pointer"><span>{{$th->threads_all->first_name}} {{$th->threads_all->last_name}}</span></td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #f1f1f1;"><td colspan="3">&nbsp;</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="w3-container">
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <form class="w3-container" action="{{url('user/send-message')}}" method="post">
        <div class="w3-section p-4" id="conversation">
					<span>No data found</span>
        </div>
				<div style="padding: 20px">
					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
					<input type="hidden" id="sender" name="sender"/>
					<input type="hidden" id="receiver" name="receiver"/>
					<textarea id="message_text" name="message_text" style="border: 1px solid #a8c2ce; width: 100%; border-radius: 10px; padding: 10px"></textarea>
				</div>
				<div class="button_div"><button class="msg_send_button" type="submit">send</button></div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
      </div>

    </div>
  </div>
</div>








@stop

@section('custom_js')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#markAll').on('change', function(e){
				if ($(this).is(':checked')) {
					$('.msg').prop('checked', true);

			   } else {
					 $('.msg').prop('checked', false);
			   }
			});
		});
       
	</script>

@stop
