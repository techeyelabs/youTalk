
@extends('navbar')

@section('content')
<div class="mt-3" style="min-height: 850px">

    <section class="auth_page_title">
            <div class="row">
                <div class="col-12 alternates" style="max-width: 500px">
                    <div class="col-md-12 text-center text-16"><p>パスワード再設定</p></div>
                </div>
            </div>
    </section>

    <section class="auth_form_area">
            <div class="row">
                <div class="col-md-12 alternates" style="max-width: 500px !important">
                    <div class="col-md-12 bg-white area_auth ">
                        <div class="col-md-12 col-sm-12 part_1">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @include('message')
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div style="width: 100%; text-align: center; font-size: 16px">パスワード再設定用URLの送信</div>
                                <div class="form-group">
                                    <label for="email" class="">登録メールアドレス</label>

                                    <div>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn buttons btn-size" style="width: 120px; text-align: center">
                                            ログイン  
                                        </button>
                                    </div>
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
