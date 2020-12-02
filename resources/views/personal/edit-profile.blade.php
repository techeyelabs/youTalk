@extends('navbar')

@section('custom_css')

@stop


@section('content')
    <div class="col-md-12 alternates" style="min-height: 850px">
        <div class="col-md-12 col-sm-12 p-0">
            <div class="col-md-12 text-center mb-5 text-16"><b>プロフィール更新 / 編集</b></div>
            <form id="service_form" action="{{route('profile-edit-action')}}" enctype="multipart/form-data" method="post" style="width: 100%">

                {{ csrf_field() }}

                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">画像</div>
                    <div class="col-md-10">
                        <input type="file" id="dp" name="dp" />
                    </div>
                </div>
                <br/>
                <?php
                    // echo '<pre>';
                    // print_r($profile);
                    // exit;
                ?>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">氏名</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" type="text" id="fname" name="fname" placeholder="{{$personal->name}}" readonly/>
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">メール</div>
                    <div class="col-md-10">
                    <input class="input-fields small-screen-input-width-profile" type="text" id="email" name="email" placeholder="{{$personal->email}}" readonly/>
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">電話番号</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->phone}}" type="text" id="phone"
                        name="phone" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">性別</div>
                    <div class="col-md-10">
                        <select id="gender" class="custom-select" name="gender" class="input_box small-screen-input-width-profile" style="width: 150px !important; border: 1px solid #cecece; height:30px !important; border-radius:5px; padding-left: 4px; padding-top: 3px">
                            <option value="">-----</option>
                            <option value="1" {{ $profile->gender == 1 ? 'selected="selected"' : '' }}>男性</option>
                            <option value="2" {{ $profile->gender == 2 ? 'selected="selected"' : '' }}>女性</option>
                        </select>
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">誕生日</div>
                    <div class="col-md-10">
                        <input class="datepick small-screen-input-width-profile" type="text" name="dob" placeholder="yyyy-mm-dd" style="width: 150px; border: 1px solid #cecece;height:30px;border-radius: 5px; padding-left: 4px"
                        value="{{$profile->dob}}" readonly/>
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">住所</div>
                    <div class="col-md-10">
                        <textarea type="text" id="address" name="address" class="textarea_input" style="height:70px">{{$profile->address}}</textarea>
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">自己紹介</div>
                    <div class="col-md-10">
                        <textarea type="text" id="bio" name="bio" class="textarea_input">{{$profile->bio}}</textarea>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="col-md-12 text-center text-16">
                    銀行口座情報
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">銀行名</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->bank_name}}" type="text" id="bank_name" name="bank_name" />
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">支店名</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->branch_name}}" type="text" id="branch_name" name="branch_name"/>
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">種類</div>
                    <div class="col-md-10">
                        <input type="radio" id="gen" name="acc_type" value="1" {{ $profile->acc_type == 1 ? "checked" : ""}}>
                        <label for="gen">普通</label>&nbsp;
                        <input type="radio" id="curr" name="acc_type" value="2" {{ $profile->acc_type == 2 ? "checked" : ""}}>
                        <label for="curr">当座</label>&nbsp;
                        <input type="radio" id="save" name="acc_type" value="3" {{ $profile->acc_type == 3 ? "checked" : ""}}>
                        <label for="save">貯蓄</label>
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">口座番号</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->acc_number}}" type="text" id="acc_number" name="acc_number" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">口座名義</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->acc_name}}" type="text" id="acc_name" name="acc_name"/>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="col-md-12 text-center text-16">
                    ソーシャルアカウント追加
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">Facebook</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->facebook}}" type="text" id="facebook" name="facebook" />
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">Twitter</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->twitter}}" type="text" id="twitter" name="twitter" />
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">Instagram</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->instagram}}" type="text" id="instagram" name="instagram"/>
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">Youtube</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->youtube}}" type="text" id="youtube" name="youtube" />
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">Ameblo</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->ameblo}}" type="text" id="ameblo" name="ameblo" />
                    </div>
                </div>
                <br/>
                <div class="col-md-12 row">
                    <div class="col-md-2 text-14">Note</div>
                    <div class="col-md-10">
                        <input class="input-fields small-screen-input-width-profile" value="{{$profile->note}}" type="text" id="note" name="note" />
                    </div>
                </div>
                <br/>
                <br/>
                <br/>
                <div class="col-md-12 text-center row">
                    <div class="col-md-6 text-md-right mb-3 mb-md-0">
                        <button type="submit" class="btn buttons btn-size white_buttons" style="color: black">更新する</button>
                    </div>
        
                    <div class="col-md-6 text-md-left">
                        <a class="btn buttons btn-size white_buttons" href="{{route('my-page-profile')}}">キャンセル</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
@stop



@section('custom_js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.datepick').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

</script>

@stop