@extends('navbar')

@section('content')

<div class="mt-3" style="min-height: 850px">

    <section class="auth_page_title">
            <div class="row">
                <div class="col-12 alternates" style="max-width: 500px">
                    <div class="col-md-12 text-center text-16"><p>ログイン</p></div>
                </div>
            </div>
    </section>

    <section class="auth_form_area">
            <div class="row">
                <div class="col-md-12 alternates" style="max-width: 500px !important">
                    <div class="col-md-12 bg-white area_auth ">
                        <div class="col-md-12 col-sm-12 part_1">
                            @include('message')
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">メールアドレス</label>
                                    <div>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">パスワード</label>
                                    <div>
                                        <input id="password" type="password" class="form-control" name="password" required>
                                        @if(isset($service_id))
                                            <input id="service_id" type="hidden" class="form-control" value="{{$service_id}}" name="service_id">
                                        @else 
                                            <input id="service_id" type="hidden" class="form-control" value="0" name="service_id">
                                        @endif

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{--<div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> &nbsp;&nbsp; 次回から自動的にログイン
                                        </label>
                                    </div>
                                </div>--}}

                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn buttons btn-size" style="width: 120px; text-align: center">
                                            ログイン
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="padding-bottom: 0px; margin-top: 20px; font-size: 12px">
                                        パスワードをお忘れの方
                                    </a>
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
                </div>
            </div>
    </section>
</div>
@endsection
