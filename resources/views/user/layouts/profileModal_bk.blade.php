
{{--<div class="modal fade" aria-hidden="true" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
	<div class="modal-dialog modal-lg">

		 <!-- Modal content-->
		 <div class="modal-content">
			 <div class="modal-body row justify-content-center">

      	<div class="">
      		<div class="col-md-12">

                <div class="row well p-0 m-0 justify-content-center">
									<div class="col-md-10 offset-1 my-5">
										<h5 class="">Crofunで活動を行うために下記の情報を記載お願いします。</h5>
									</div>


                  <div class="col-md-11 col-11 ">

										{!! Form::open(['route' => 'user-profile-update-action', 'method' => 'post', 'id'=> 'formID']) !!}

										<div class="row border">
                      <div class="col-md-3 col-3 bg-dark">
                        <p class="pt-3 ">氏名</p>
                      </div>
                      <div class="col-md-9 col-9 ">
                        <div class="row pt-2">
                          <div class="col-md-3 col-3 p-0 ml-5">
                            <input type="text" class="form-control required" id="inputEmail3" placeholder="姓" value="{{$user->first_name}}" name="first_name" required maxlength="10">
                            @if ($errors->has('first_name'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('first_name') }}</strong>
                                      </span>
                                  @endif
                          </div>
                          <div class="col-md-3 col-3 p-0 m-0">
                            <input type="text" class="form-control mx-1 required" id="inputEmail3" placeholder="名" value="{{$user->last_name}}" name="last_name" required maxlength="10">
                            @if ($errors->has('last_name'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('last_name') }}</strong>
                                      </span>
                                  @endif
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row border">
                      <div class="col-md-3 col-3 bg-dark">
                        <p class="pt-3 ">フリガナ</p>
                      </div>
                      <div class="col-md-9 col-9 ">
                        <div class="row pt-2">
                          <div class="col-md-3 col-3 p-0 ml-5">
                            <input type="text" class="form-control required" id="inputEmail3" placeholder="セイ" value="{{isset($user->profile->phonetic)?$user->profile->phonetic:''}}" name="phonetic" required maxlength="10">
                            @if ($errors->has('phonetic'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('phonetic') }}</strong>
                                      </span>
                                  @endif
                          </div>
													<div class="col-md-3 col-3 p-0 ml-1">
														<input type="text" class="form-control required" id="inputEmail3" placeholder="メイ" value="{{isset($user->profile->phonetic2)?$user->profile->phonetic2:''}}" name="phonetic2" required maxlength="10">
														@if ($errors->has('phonetic2'))
																			<span class="help-block text-danger">
																					<strong>{{ $errors->first('phonetic') }}</strong>
																			</span>
																	@endif
													</div>
                        </div>
                      </div>
                    </div>

                    <div class="row border">
                      <div class="col-md-3 col-3 bg-dark">
                        <p class="pt-3 ">生年月日</p>
                      </div>
                      <div class="col-md-9 col-9 ">
                        
                      <div class="pt-2 ml-5">

                        <input  type="hidden" id="dob" name="dob">


                          <!-- <div class="col-md-3 col-3 p-0 ml-5">
                            <select name="birth_year" class="form-control required" required>
              			       		<?php for($i=1917; $i<=date('Y'); $i++){?>
              			       			<option value="{{$i}}" @if (isset($user->profile->dob) && $user->profile->dob)
              			       				{{ date('Y', strtotime($user->profile->dob)) == $i?'selected':'' }}
              									@else
              									{{ 	isset($user->profile->dob)?$user->profile->dob:'' }}
              			       			@endif>{{$i}}</option>
              			       		<?php }?>
              			       	</select>
              			        @if ($errors->has('birth_year'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('birth_year') }}</strong>
                                      </span>
                                  @endif

                          </div>
                          <div class="col-md-2 col-2 p-0 m-0">
                            <select name="birth_month" class="form-control mx-md-1 required" required>
              			       		<?php for($i=1; $i<=12; $i++){?>
              			       			<option value="{{$i}}" {{date('m', strtotime(isset($user->profile->dob)?$user->profile->dob:0)) == $i?'selected':'' }}>{{$i}}</option>
              			       		<?php }?>
              			       	</select>
              			        @if ($errors->has('birth_month'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('birth_month') }}</strong>
                                      </span>
                                  @endif
                          </div>
                          <div class="col-md-2 col-2 p-0 m-0">
                            <select name="birth_day" class="form-control ml-md-2 required" required>
              			       		<?php for($i=1; $i<=31; $i++){?>
              			       			<option value="{{$i}}" {{date('d', strtotime(isset($user->profile->dob)?$user->profile->dob:0)) == $i?'selected':'' }}>{{$i}}</option>
              			       		<?php }?>
              			       	</select>
              			        @if ($errors->has('birth_day'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('birth_day') }}</strong>
                                      </span>
                                  @endif
                          </div> -->
                        </div>
                      </div>
                    </div>

                    <div class="row border">
                      <div class="col-md-3 col-3 bg-dark">
                        <p class="pt-3 ">性別</p>
                      </div>
											<div class="col-md-9 col-9 ">
												<div class="row pt-2">
													<div class="col-md-6 col-6 p-0 ml-5">
														<select name="sex" class="form-control required" required>
															<option value="1" {{isset($user->profile->sex) && $user->profile->sex == 1?'selected':''}}>男性</option>
															<option value="2" {{isset($user->profile->sex) && $user->profile->sex == 2?'selected':''}}>女性</option>
															<option value="3" {{isset($user->profile->sex) && $user->profile->sex == 3?'selected':''}}>末記入</option>
														</select>
														@if ($errors->has('sex'))
																			<span class="help-block text-danger">
																					<strong>{{ $errors->first('sex') }}</strong>
																			</span>
														@endif
													</div>
												</div>
											</div>
                    </div>
                    <div class="row border">
                      <div class="col-md-3 col-3 bg-dark">
                        <p class="pt-3 ">電話番号</p>
                      </div>
                      <div class="col-md-9 col-9 ">
                        <div class="row pt-2">
                          <div class="col-md-6 col-6 p-0 ml-5">
                            <input type="number" class="form-control required" id="inputEmail3" placeholder="12312341234" name="phone_no" value="{{isset($user->profile->phone_no)?$user->profile->phone_no:0}}" required>
                            @if ($errors->has('phone_no'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('phone_no') }}</strong>
                                      </span>
                                  @endif
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row border">
                      <div class="col-md-3 col-3 bg-dark">
                        <p class="pt-3 ">住所</p>
                      </div>
                      <div class="col-md-9 col-9 ">
                        <div class="row pt-2">
                          <div class="col-md-6 col-6 p-0 ml-5">
                            <input type="number" class="form-control required" id="postal_code" placeholder="郵便番号" name="postal_code" value="{{isset($user->profile->postal_code)?$user->profile->postal_code:''}}" maxlength="7" required>
                            <span id="postal_error" style="color:red;"></span>
                            @if ($errors->has('postal_code'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('postal_code') }}</strong>
                                      </span>
                                  @endif
													</div>
                        </div>
                        <div class="row pt-2">
                          <div class="col-md-3 col-3 p-0 ml-5">
														@include('user.layouts.prefectures')
														@if ($errors->has('division'))
															<span class="help-block text-danger">
																<strong>{{ $errors->first('division') }}</strong>
															</span>
														@endif

                          </div>
                        </div>
                        <div class="row pt-2">
                          <div class="col-md-6 col-6 p-0 ml-5">
                            <input type="text" class="form-control required" id="inputEmail3" placeholder="市区町村" name="municipility" value="{{isset($user->profile->municipility)?$user->profile->municipility:''}}" required>
                            @if ($errors->has('municipility'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('municipility') }}</strong>
                                      </span>
                                  @endif
													</div>
                        </div>
                        <div class="row pt-2">
                          <div class="col-md-6 col-6 p-0 ml-5">
                            <input type="text" class="form-control required" id="inputEmail3" placeholder="それ以降の住所" name="address" value="{{isset($user->profile->address)?$user->profile->address:''}}">
                            @if ($errors->has('address'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('address') }}</strong>
                                      </span>
                                  @endif
													</div>
                        </div>
                        <div class="row pt-2 pb-2">
                          <div class="col-md-6 col-6 p-0 ml-5">
                            <input type="text" class="form-control " id="inputEmail3" placeholder="マンション名・部屋番号" name="room_no" value="{{isset($user->profile->room_no)?$user->profile->room_no:''}}">
                            @if ($errors->has('room_no'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('room_no') }}</strong>
                                      </span>
                                  @endif
                                </div>
                        </div>

                      </div>
                    </div>


										<div class="row p-5">
											<div class="col-md-1 col-1 offset-5">
												<!-- <button type="submit" name="" value=""   class="btn btn-md btn-dark text-white font-wight-bold" style="cursor:pointer;">
													更新する </button> -->
                          <input type="submit" id="submit" name="submit" class="btn btn-md btn-dark text-white font-wight-bold" value="更新する">
											</div>
										</div>

										{!! Form::close() !!}

                  </div>
                </div>



      	   </div>

      </div>
    </div>
  </div>
</div>
</div>


<?php 
$defaultDate = date('Y-m-d', strtotime('-30 years'));
?>--}}

{{-- <script src="{{Request::root().'/js/jquery.date-dropdowns.js'}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-dropdown-datepicker@1.2.2/dist/jquery-dropdown-datepicker.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
      	
      $("#dob").dropdownDatepicker({

        // Populate the widget with a default date.
        defaultDate: '{{$defaultDate}}',

        // The format of the date string provided to defaultDate
        defaultDateFormat: "yyyy-mm-dd",

        // Specify the order in which the dropdown fields should be rendered.
        displayFormat: "ymd",

        // Specify the format the submitted date should take.
        submitFormat: "yyyy-mm-dd",

        // Indicates the minimum age the widget will accept.
        minAge: 18,

        // Indicates the maximum age the widget will accept.
        maxAge: 120,

        // The lowest year option that will ba available.
        minYear: null,

        // The highest year option that will be available.
        maxYear: null,

        // Specify the name attribute for the hidden field that will contain the formatted date for submission.
        submitFieldName: "date",

        // Specify a classname to add to the widget wrapper.
        wrapperClass: "row",

        // Set custom classes on generated dropdown elements
        dropdownClass: 'col-md-3 form-control',

        // Indicates whether day numbers should include their suffixes when displayed to the user
        daySuffixes: true,
        monthSuffixes: false,

        // Specify the format dates should be in when presented to the user
        monthFormat: "short",

        // Whether the required html5 attribute should be applied to the generated select elements
        required: true,

        // Identifies the "Day" dropdown
        dayLabel: '日',

        // Identifies the "Month" dropdown
        monthLabel: '月',

        // Identifies the "Year" dropdown
        yearLabel: '年',

        // Long month dropdown values (can be overridden for internationalisation purposes)
        monthLongValues: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

        // Short month dropdown values (can be overridden for internationalisation purposes)
        // monthShortValues: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				monthShortValues: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],

        // Initial dropdown values (can be overridden for internationalisation purposes)
        initialDayMonthYearValues: ['Day', 'Month', 'Year'],

        // Ordinal indicators (can be overridden for internationalisation purposes)
        // daySuffixValues: ['st', 'nd', 'rd', 'th']
				daySuffixValues: ['日', '日', '日', '日']
        });

        
        $(document).on('click', '#submit', function(){
				var postal = $('#postal_code').val();
        // console.log(typeof postal);
        var reg = new RegExp('^\\d+$');
				if(!reg.test(postal)){
					$('#postal_error').html('数字のみ入力してください ');
					return false;
        }else if(postal.length > 7 || postal.length < 7){
          $('#postal_error').html('郵便番号は７文字までしか入力出来ません。');
					return false;
				}else{
					$('#postal_error').html('');

					return true;
				}
      });
      
      $( ".year" ).children('option').each(function( index ) {
				$( this ).text($( this ).text()+'年')
      });
      
		});
	</script>