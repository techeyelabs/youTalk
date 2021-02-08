@extends('navbar')

@section('content')

<div class="mt-3" style="min-height: 850px">

    <section class="auth_page_title">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-10 offset-md-1 row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 text-center"><span class="text-16">LINE通知設定</span></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>

    <section class="auth_form_area">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 offset-md-1 col-sm-12 row ">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 bg-white area_auth ">
                        <div class="col-md-12 col-sm-12 part_1">
                            @include('message')
                            <form class="form-horizontal" method="POST" action="{{ route('user-change-password-action') }}">
                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">現在のパスワード</label>

                                    <div>
                                        <input type="password" class="form-control" id="password" placeholder="" name="current_password" value="" required autofocus>

                                        @if ($errors->has('current_password'))
												<span class="help-block text-danger">
														<strong>{{ $errors->first('current_password') }}</strong>
												</span>
											@endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">新しいパスワード</label>

                                    <div>
                                        <input type="password" class="form-control" id="inputEmail3" placeholder="" name="password" value="">

                                        @if ($errors->has('password'))
												<span class="help-block text-danger">
														<strong>{{ $errors->first('password') }}</strong>
												</span>
											@endif
                                    </div>
								</div>
								

								<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">新しいパスワード確認</label>

                                    <div>
                                        <input type="password" class="form-control" id="inputEmail3" placeholder="" name="password_confirmation" value="">

                                        @if ($errors->has('password_confirmation'))
											<span class="help-block text-danger">
													<strong>{{ $errors->first('password_confirmation') }}</strong>
											</span>
										@endif
                                    </div>
								</div>

                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn buttons btn-size">
                                            更新する &nbsp;&nbsp;&nbsp;
                                        </button>
                                    </div>
                                    
                                    <!-- <div class="col-md-12 text-center">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit
                                    </div> -->
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 col-sm-12 part_2">
                            {{--<h2>ソーシャルメディアでログイン</h2>--}}
                            <table style="width: 100%">
                                {{--<tr>
                                    <td style="width: 33.33%; padding-left: 25px; padding-right: 25px"><a href="{{route('front-facebook')}}" class="btn btn-primary btn-lg btn-block facebook" style="border-radius: 25px !important;"><i class="fa fa-facebook"></i></a></td>
                                    <td style="width: 33.33%; padding-left: 25px; padding-right: 25px"><a href="{{route('front-google')}}" class="btn btn-danger btn-lg btn-block google" style="border-radius: 25px !important;"><i class="fa fa-google"></i></a></td>
                                    <td style="width: 33.33%; padding-left: 25px; padding-right: 25px"><a href="{{route('front-twitter')}}" class="btn btn-info btn-lg btn-block twitter" style="border-radius: 25px !important;"><i class="fa fa-twitter"></i></a></td>
                                </tr>--}}
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>
</div>
@endsection

