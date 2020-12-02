<div class="no-container project_details_bottom_info">
	<div style="padding-right: 10%; padding-left: 10%" class="small_screen_drowpdownpads">
			<div>
				<div class="mt-5">
					<div class="row">
						<div class="col-md-12">
							<div class="row inner">
								<div class="col-md-8  mb-5 ">
									<div class="mb-3">
										<div class="bg-white p-2">
											<h4 class="pb-2 font-weight-bold">プロジェクトの目的</h4>
											<p> {{ $project->purpose }} </p>
										</div>
									</div>
									<div class="mb-3">
											<div class="bg-white p-2">
												{{--<h4 class="pb-2 font-weight-bold">{{!! nl2br($project->title) !!}}</h4>--}}
												<div class="mb-4">
													<div class="col-12 imageHolder"  style="border: 1px solid #e6e6e6"><img imageHolder src="{{ asset('uploads/projects/'. $project->featured_image) }}" alt="" class="img-fluid"></div>
													<div class="col-md-12 mt-5">
														<div class="row">
															<span class="col-md-12" style="word-wrap: break-word;">
																{!! html_entity_decode(nl2br($project->description)) !!}
															</span>
														</div>
														{{-- <div class="row p-0 mt-auto">
															<span class="col-md-12">
																@if (Auth::check())
																	<button class="p-2 text-white btn btn-md mt-4 font-weight-bold msg_send_btn "  data-user_id="{{ $project->user->id }}"  data-project_username="{{ $project->user->first_name.' '.$project->user->last_name }}" style="cursor:pointer; color:#fff;"> <span style="color:#fff !important;"> <i class="fa fa-envelope"></i> </span>メッセージを送る</button>
																@else
																	<a class="p-2 text-white btn btn-md mt-4 font-weight-bold" href="{{ route('front-project-details-login', $project->id) }}"   style="cursor:pointer; color:#fff;"> <span style="color:#fff !important;"> <i class="fa fa-envelope"></i> </span>メッセージを送る</a>
																@endif
															</span>
														</div> --}}
														{{-- <button type="button" class="btn btn-md mt-4" name="button" style="background:#c6c6c6"; > <span class="fa fa-envelope" style="color:#fff;"></span> メッセージを送る</button> --}}
	
													</div>
												</div>
	
											</div>
										</div>


										<div class="mb-3 ">
											<div class="bg-white p-2">
												<h4 class="pb-2 font-weight-bold">予算用途の内訳</h4>
												<div class="row">
													<span class="col-md-12">
														{{!! html_entity_decode(nl2br($project->budget_usage_breakdown)) !!}}
													</span>
												</div>
	
											</div>
										</div>


									


								@if ($project->details)
									@foreach($project->details as $projectDetails)
										<div class="mb-3">
											<div class="bg-white p-2">
												
												

												<h4 class="pb-2 font-weight-bold"><?php echo nl2br($projectDetails->details_title); ?></h4>
												<div class="row mb-4">
													
													<div class="col-12 imageHolder"  style="border: 1px solid #e6e6e6">
														<img src="{{ !empty($projectDetails->draft_file)?asset('uploads/projects/'. $projectDetails->draft_file):asset('uploads/img/default.png') }}" alt="" class="img-fluid">
													</div>
													<div class="col-md-12 mt-5">
														<div class="row">
															<span class="col-md-12">
																{!! html_entity_decode(nl2br($projectDetails->details_description)) !!}
															</span>
														</div>
														
														
													</div>
												</div>

											</div>
										</div>
									@endforeach
								@endif



							<div class="mb-3 ">
								
							</div>

									
							</div>
							<div class="col-md-4">
								<div class="mb-3 extra_div">
									<div class="p-2 text-center">
										<p class="pb-2 font-weight-bold pt-2">起案者プロフィール</p>
										{{-- <h4 class="pb-2 font-weight-bold">{{ $project->title }}</h4> --}}
										<div class="mb-4 text-center">
											<?php
											$pic = $project->user->pic;
											// dd($pic);
											if(!$pic){
												$pic = Request::root().'/uploads/img/default.png';
											}else{
												$pic = Request::root().'/uploads/'.$pic;
											}
											?>
											<img src="{{ $pic }}" alt="" class="" width="247px" height="auto;">
											<div class="">
												
													
												<div class="row pt-3">
													<span class="col-md-12">
														<h5>{{$project->user->first_name.' '.$project->user->last_name}}</h5>
													</span>
													<p class="col-md-12">
														{{ (isset($project->user->profile)) ? $project->user->profile->profile : '' }}
													</p>
												</div>
												<div class="row p-0 mt-auto">
													<span class="col-md-12">
														@if (Auth::check())
															<button class="p-2 text-white btn btn-md mt-4 font-weight-bold msg_send_btn "  data-user_id="{{ $project->user->id }}"  data-project_username="{{ $project->user->first_name.' '.$project->user->last_name }}" style="cursor:pointer; color:#fff; background-color:#618ca9;"> <span style="color:#fff !important;"> <i class="fa fa-envelope"></i> </span>メッセージを送る</button>
														@else
															<a class="p-2 text-white btn btn-md mt-4 font-weight-bold" href="{{ route('front-project-details-login', $project->id) }}"   style="cursor:pointer; color:#fff; background-color:#618ca9;"> <span style="color:#fff !important;"> <i class="fa fa-envelope"></i> </span>メッセージを送る</a>
														@endif
													</span>
												</div>
												{{-- <button type="button" class="btn btn-md mt-4" name="button" style="background:#618ca9"; > <span class="fa fa-envelope" style="color:#fff;"></span> メッセージを送る</button> --}}

											</div>
										</div>

									</div>
									<div class="">	
									</div>
								</div>
								<div class="bg-white pt-5">
									<div class="row">
										<div class="px-4 mb-2 col-md-12">
											<h4 class="forn-weight-bold">リターンを選ぶ</h4>
											<span>このプロジェクトを支援するためには リターンをお選びください。</span>
										</div>
									</div>
								</div>
								<div style="height: 25px">&nbsp;</div>
								@foreach ($project->reward->sortByDesc('amount') as $reward)

								<div class="mb-3 extra_div" >
									<div class="">
										<div>
											<div class="px-4 mb-2" style="padding: 0px !important; width: 100%">
												@if ( $reward->other_file)
													<img src="{{ asset('uploads/projects/'. $reward->other_file) }}" alt="" class="" width="100%" height="auto">
												@endif
											</div>
											<div class="px-4 mb-2 col-md-12">
												<h4 class="fornt-weight-bold p-0">{{ $reward->amount }} 円</h4>
											</div>
											<div class="px-4 mb-2 col-md-12" style="font-size:15px;">
												<span>{{ $reward->is_crofun_point }}  ポイント</span> <br>
												{{-- {{ $reward->is_crofun_point }} --}}
												<span>{{$reward->is_other}}</span><br/>
												{!!nl2br($reward->other_description) !!}
											</div>
											<div class="px-4 mb-2 mt-1 col-md-12">
												<a href="{{route('user-invest', ['id' => $project->id])}}?reward={{ $reward->id }}"   class=" text-white btn btn-md btn-block <?php echo $project->start > date('Y-m-d')?'disabled':'enabled';?>" name="button" style="background:#618ca9;">このリターンを選択する</a>
											</div>

										</div>
									</div>
									<div style="height: 18px">&nbsp;</div>
								</div>
								@endforeach

									{{-- <div class="content-inner-blue mb-3">
										<div class="bg-white p-2">
											<div class=row>
												<div class="px-4 mb-2 col-md-12">
													<h4 class="fornt-weight-bold p-0">￥5,000 コース</h4>
													<span>リターン名がここに入りますす</span>

												</div>
												<div class="px-4 mb-2 col-md-12">
													<img src="{{ asset('images/BMW-TA.jpg') }}" alt="" class="" width="100%" height="200px">

												</div>
												<div class="px-4 mb-2 col-md-12" style="font-size:15px;">
													<a href="#">1000ポイント</a> <br>
													talktomeポイントとはtalktomeに登録されて いる様々な商品と交換できるポイントです。
												</div>
												<div class="px-4 mb-2 mt-1 col-md-12">
													<button type="button" class=" text-white btn btn-md btn-block" name="button" style="background:#618ca9;">このリターンを選択する</button>

												</div>

											</div>
										</div>
									</div> --}}
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<style>
.extra_div{
    background-color: white;
    /* border: 1px solid #f1f1f1; */
    border-radius: 1%;
    padding: 0%;
    box-shadow: 0 3px 7px 0 rgba(0, 0, 0, 0.2), 0 5px 15px 0 rgba(0, 0, 0, 0.19);
}
</style>