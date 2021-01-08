@extends('navbar')

@section('content')
<div class="mt-3" style="min-height: 850px">
    <section class="auth_page_title">
            <div class="row">
                <div class="col-12 alternates" style="max-width: 500px">
                    <div class="col-md-12 text-center text-16"><b>新規登録</b></div>
                </div>
            </div>
    </section>

    <section class="auth_form_area">
            <div class="row">
                <div class="col-md-12 alternates" style="max-width: 500px !important">
                    <div class="col-md-12 bg-white area_auth" >
                        <div class="col-md-12 col-sm-12 part_1">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @include('message')
                            <form id="registration_form" class="form-horizontal" method="POST" action="{{route('user-register-action', $data['token'])}}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name" class="control-label">氏名<span class="text-danger" style="font-size: 10px">＊必須</span></label>
                                    <div>
                                        <input id="first_name" type="text" class="form-control" name="first_name" placeholder="" value="{{ old('first_name') }}" maxlength="25">
                                        <span class="help-block text-danger" id="errors_name" style="display: none;font-size: 10px">名前を入力してください！</span>
                                        @if ($errors->has('first_name'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">メールアドレス <span class="text-danger" style="font-size: 10px">＊必須</span></label>
                                    <div>
                                        <input id="email" type="email" class="form-control" name="email" placeholder="">
                                        <span class="help-block text-danger" id="errors_email_exists" style="display: none;font-size: 10px">メールアドレスはすでに存在します</span>
                                        <span class="help-block text-danger" id="errors_email" style="display: none;font-size: 10px">メールアドレスを入力してください！</span>
                                        @if ($errors->has('email'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">パスワード
                                        <span class="text-danger" style="font-size: 10px">＊必須</span>
                                        <a href="#" data-toggle="tooltip" data-html="true" title="パスワードに使用できる文字列は下記になります。 <br> ・8文字以上のパスワード <br> ・英大文字：A～Z，#，@，\ <br> ・英小文字：a～z <br> ・数字：0～9"></a>
                                    </label>
                                    <div>
                                        <input id="password" type="password" class="form-control" placeholder=""  name="password" value="">
                                        <span class="help-block text-danger" id="errors_pass" style="display: none;font-size: 10px">パスワードを入力してください！</span>
                                        @if ($errors->has('password'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password_confirmation" class="control-label">パスワード確認 <span class="text-danger" style="font-size: 10px">＊必須</span></label>
                                    <div>
                                        <input id="password_confirmation" type="password" placeholder="" class="form-control" name="password_confirmation">
                                        <span class="help-block text-danger" id="missmatch_pass" style="display: none;font-size: 10px">パスワードの書式が間違えています。確認してください。</span>
                                        <span class="help-block text-danger" id="errors_pass_conf" style="display: none;font-size: 10px">確認パスワードを入力してください！</span>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn buttons btn-size" id="submit" style="width: 120px">
                                <b>登録</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            console.log("hello");
            $('[data-toggle="tooltip"]').tooltip();

            var flag = 0;

            $("#email").change(function() {
                var email = $('#email').val();
                var ajaxurl = "{{route('email-validation')}}";
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                            '_token': "{{ csrf_token() }}",
                            'email': email
                    },
                    success: function(data){
                        emailTest(data);
                    },
                    complete: function (data) {    
                    }
                });

                function emailTest(response){
                console.log("asdasd:"+response);
                if(response > 0){
                    flag = 1;
                    $('#errors_email_exists').show();
                    $('#errors_email').hide();
                }else{
                    if(flag == 1){
                        flag = 0;
                        $('#errors_email_exists').hide();
                        $('#errors_email').hide();
                    }
                }
            }
            });

            $("#submit").click(function(){
                console.log("submit button");
                if($('#first_name').val() == '' || $('#first_name').val() == null){
                    flag = 1;
                    $('#errors_name').show();
                }
                if($('#email').val() == '' || $('#email').val() == null){
                    flag = 1;
                    $('#errors_email').show();
                }
                
                if($('#password').val() == '' || $('#password').val() == null){
                    flag = 1;
                    $('#errors_pass').show();
                }
                if($('#password_confirmation').val() == '' || $('#password_confirmation').val() == null){
                    flag = 1;
                    $('#errors_pass_conf').show();
                    $('#missmatch_pass').hide();
                }

                var pass1 = $('#password').val();
                var pass2 = $('#password_confirmation').val();

                if(pass1 != pass2){
                    flag = 1;
                    $('#missmatch_pass').show();
                    $('#errors_pass_conf').hide();
                }

                function validPassword(password) {
                    let errors = '';
                    let flag = 0;
                    if (password.length < 8 ) {
                        errors = "パソワードが８文字以上にする必要です";
                        flag = 1;
                    }
                    if(flag == 1) {
                        $('#errors_pass').html(errors);
                        return false;
                    }
                    if(flag == 0){
                        if(confirm("こちらの内容でよろしいですか！")){
                            $("#registration_form").submit();
                        }
                    }
                }
                var password = $('#password').val();
                validPassword(password);
            });
        });
    </script>
@endsection