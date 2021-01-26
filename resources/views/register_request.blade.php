@extends('navbar')

@section('custom_css')
@stop

@section('content')
<div class="" style="min-height: 600px">
    <section class="auth_page_title">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-10 offset-md-1 row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6" style="font-size: 16px; text-align: center">新規仮登録</div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="auth_form_area">
        <div class="row">
            <div class="col-md-12 alternates" style="max-width: 500px !important">
                <div class="col-md-12 bg-white area_auth text-center mt-3">
                    <div class="col-md-12 col-sm-12 part_1">
                        @include('message')
                        <form class="form-horizontal" method="POST" action="{{ route('user-register-request-action')}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" style="text-align: left; float: left;">登録用メールアドレス</label>
                                <input id="email" type="email" class="form-control required" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn buttons btn-size" style="width: 120px; text-align: center">
                                        メール送信
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 col-sm-12 part_2">
                        <table style="width: 100%">
                            <tr>
                                {{--<td style="width: 33.33%; padding-left: 25px; padding-right: 25px"><a href="{{route('front-facebook')}}" class="btn btn-primary btn-lg btn-block facebook" style="border-radius: 25px !important;"><i class="fa fa-facebook"></i></a></td>
                                <td style="width: 33.33%; padding-left: 25px; padding-right: 25px"><a href="{{route('front-google')}}" class="btn btn-danger btn-lg btn-block google" style="border-radius: 25px !important;"><i class="fa fa-google"></i></a></td>
                                <td style="width: 33.33%; padding-left: 25px; padding-right: 25px"><a href="{{route('front-twitter')}}" class="btn btn-info btn-lg btn-block twitter" style="border-radius: 25px !important;"><i class="fa fa-twitter"></i></a></td>--}}
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop

@section('custom_js')
    <script type="text/javascript" src="{{Request::root()}}/js/jquery.validate.min.js"></script>
@stop