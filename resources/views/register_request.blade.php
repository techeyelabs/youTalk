@extends('navbar')

@section('custom_css')
@stop


@section('content')
<div class="auth_area" style="min-height: 600px">

    <section class="auth_page_title">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-10 offset-md-1 row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6"><h1><i class="fa fa-lock" aria-hidden="true"></i> 新規登録</h1></div>
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
                <div class="col-md-10 offset-md-1 col-sm-12 row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 bg-white area_auth text-center">
                        <div class="col-md-12 col-sm-12 part_1">
                            <h2>メールアドレスで新規登録</h2>
                            @include('message')

                            <form class="form-horizontal" method="POST" action="{{ route('user-register-request-action')}}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">登録メールアドレス</label>

                                    <div>
                                        <input id="email" type="email" class="form-control required" name="email" value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-warning" style="background-color: #607d8b !important; border: 1px solid #607d8b !important;">
                                            認証メールを送信
                                        </button>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 20px;">
                                        
                                        <p>
                                            ※すでに新規登録がお済みの方は <a href="{{route('login')}}">こちら</a> よりログインしてください
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 col-sm-12 part_2">

                            <div class="panel-body">
                                
                                
                                
                            </div>
                            <table style="width: 100%">
                                <tr>
                                    {{--<td style="width: 33.33%; padding-left: 25px; padding-right: 25px"><a href="{{route('front-facebook')}}" class="btn btn-primary btn-lg btn-block facebook" style="border-radius: 25px !important;"><i class="fa fa-facebook"></i></a></td>
                                    <td style="width: 33.33%; padding-left: 25px; padding-right: 25px"><a href="{{route('front-google')}}" class="btn btn-danger btn-lg btn-block google" style="border-radius: 25px !important;"><i class="fa fa-google"></i></a></td>
                                    <td style="width: 33.33%; padding-left: 25px; padding-right: 25px"><a href="{{route('front-twitter')}}" class="btn btn-info btn-lg btn-block twitter" style="border-radius: 25px !important;"><i class="fa fa-twitter"></i></a></td>--}}
                                </tr>
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
@stop



@section('custom_js')
    <script type="text/javascript" src="{{Request::root()}}/js/jquery.validate.min.js"></script>
@stop
