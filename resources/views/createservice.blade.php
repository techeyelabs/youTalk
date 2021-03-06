@extends('navbar')

@section('custom_css')
    <style>
        .input_box{
            border-radius: 4px; 
            border: 1px solid #cecece; 
            padding: 1%; width: 70%;
        }

        select.minimal_createservice {
            background-image:
            linear-gradient(45deg, transparent 50%, gray 50%),
            linear-gradient(135deg, gray 50%, transparent 50%),
            linear-gradient(to right, #ccc, #ccc);
            background-position:
            calc(100% - 21px) calc(1em + 2px),
            calc(100% - 16px) calc(1em + 2px),
            calc(100% - 2.5em) 7px;
            background-size:
            5px 5px,
            5px 5px,
            1px 1.5em;
            background-repeat: no-repeat;
        }
    </style>
@stop

@section('content')
    @php
        $flag = 0;
    @endphp

    <div class="col-md-12 alternates p-0">
        <div class="col-md-12 col-sm-12 p-0">
            <div class="col-md-12 p-0">
                @if($serviceCount < 2)
                    <div class="col-md-12 text-center mb-3">
                        <span class="text-16">相談できるサービスを入力</span>
                    </div>

                    <form id="service_form" action="{{route('new-service-post')}}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{isset($service_prev->id) ? $service_prev->id: 0}}" id="edit_flag" name="edit_flag"/>
                        <div class="col-md-12 row">
                            <div class="col-md-2">
                                <span class="text-14">カテゴリー選択</span><br>
                                <span class="text-danger" style="font-size: 10px">＊必須</span>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group mb-0" >
                                    {{-- minimal_createservice form-control small-screen-input-width --}}
                                    <select class="custom-select" name="service_category" id="service_category" style="width: 45% !important; border: 1px solid #cecece;height:38px !important; border-radius:3px" onblur="removeAlert('service_category','service_category_error')" id="select-service-category-order" required>
                                        <option value="">選択してください</option>
                                        @foreach ($categories as $data)
                                            <option value="{{ $data->id }}"
                                                <?php
                                                    if(isset($service_prev)){
                                                        if($data->id == $service_prev->category_id) {
                                                            echo 'selected="selected"';
                                                        }
                                                    }
                                                ?>>
                                                    {{ $data->cat_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="service_category_error" class="red_alerts"><span>カテゴリーを選択してください！</span></div>
                            </div>
                        </div><br>
                        <div class="col-md-12 row">
                            <div class="col-md-2"><span class="text-14">サービス名</span><br><span class="text-danger" style="font-size: 10px"> ＊必須</span></div>
                            <div class="col-md-10">
                                <input type="text" style="width: 100%; height:38px" id="title" name="title" class="input_box" onblur="removeAlert('title','title_error')" value="{{isset($service_prev->title)?$service_prev->title:''}}"/>
                                <div id="title_error" class="red_alerts"><span>タイトル入力してください！</span></div>
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-12 row">
                            <div class="col-md-2"><span class="text-14">通話料</span><br><span class="text-danger" style="font-size: 10px"> ＊必須</span></div>
                            <div class="col-md-5">
                                <select class="custom-select" style="width:80% !important; height:38px!important;" id="price" name="price" onblur="removeAlert('price','price_error')"/>
                                    <option value="">選択してください</option>
                                    <option value="60" @if(isset($service_prev) && $service_prev->price == 60) selected @endif >60</option>
                                    <option value="80" @if(isset($service_prev) && $service_prev->price == 80) selected @endif >80</option>
                                    <option value="100" @if(isset($service_prev) && $service_prev->price == 100) selected @endif >100</option>
                                    <option value="120" @if(isset($service_prev) && $service_prev->price == 120) selected @endif >120</option>
                                    <option value="140" @if(isset($service_prev) && $service_prev->price == 140) selected @endif >140</option>
                                    <option value="160" @if(isset($service_prev) && $service_prev->price == 160) selected @endif >160</option>
                                    <option value="180" @if(isset($service_prev) && $service_prev->price == 180) selected @endif >180</option>
                                    <option value="200" @if(isset($service_prev) && $service_prev->price == 200) selected @endif >200</option>
                                    <option value="220" @if(isset($service_prev) && $service_prev->price == 220) selected @endif >220</option>
                                    <option value="240" @if(isset($service_prev) && $service_prev->price == 240) selected @endif >240</option>
                                    <option value="260" @if(isset($service_prev) && $service_prev->price == 260) selected @endif >260</option>
                                    <option value="280" @if(isset($service_prev) && $service_prev->price == 280) selected @endif >280</option>
                                    <option value="300" @if(isset($service_prev) && $service_prev->price == 300) selected @endif >300</option>
                                </select>  円 / 分
                            </div>
                            <div class="col-md-4 text-left pt-2 font-weight-bold">
                                @if(isset($profile->system_fee)) 手数料{{$profile->system_fee}}％ @endif
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-12 row">
                            <div class="col-md-2"><span class="text-14">無料通話</span></div>
                            <div class="col-md-5 pr-0 pb-2">
                                <input type="text" style="width: 90%; display:inline; height:38px" id="times" name="times" class="input_box pr-0 mr-1 small-screen-input-width" value="{{isset($service_prev->free_mint_iteration)?$service_prev->free_mint_iteration:''}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>回
                            </div>
                            <div class="col-md-5 pr-0">
                                <input type="text" style="width: 85%; display:inline; height:38px" id="min" name="min" class="input_box mr-1 small-screen-input-width" value="{{isset($service_prev->free_min)?$service_prev->free_min:''}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>分(毎回)
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-12 row">
                            <div class="col-md-2">
                                <span class="text-14">画像</span>
                            </div>
                            <div class="col-md-10">
                                @php
                                    $flag = 0;
                                @endphp
                                <div class="">
                                    <div>
                                        <input type="file" id="thumbimg" name="thumbimg" onblur="removeAlert('thumbimg','image_error')"/><br>
                                    </div>
                                    @if(isset($service_prev->thumbnail))
                                        <div class="mt-2" id="edit_img">
                                            <img style="height: 180px; width: 200px; object-fit: cover" src="{{Request::root()}}/assets/service/{{isset($service_prev->thumbnail)?$service_prev->thumbnail:''}}" />
                                        </div>
                                    @else
                                        @php
                                          $flag = 1;
                                        @endphp
                                    @endif
                                    <div id="image_error" class="red_alerts">
                                        <span class="text-10">画像アップロードしてください！</span>
                                    </div>
                                    <span style="color:red">(「画像サイズは2メガ以内にしてください！」)</span>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-12 row">
                            <div class="col-md-2"><span class="text-14">サービス詳細</span><br><span class="text-danger" style="font-size: 10px"> ＊必須</span></div>
                            <div class="col-md-10">
                                <textarea id="description" name="description" onblur="removeAlert('description','detail_error')">{{isset($service_prev->details)?$service_prev->details:''}}</textarea>
                                <div id="detail_error" class="red_alerts"><span>サービス詳細を入力してください！</span></div>
                            </div>
                        </div>
                        <br/>
                    </form>
                    <div class="row col-md-12 text-center">
                        <div class="col-md-6 text-md-right mb-3 mb-md-0">
                            @if(isset($service_prev))
                                <button id="send_service" class="btn buttons btn-size" style="width: 120px; color: black">更新する</button>
                            @else
                                <button id="send_service" class="btn buttons btn-size" style="width: 120px; color: black">作成する</button>
                            @endif
                        </div>

                        <div class="col-md-6 text-md-left">
                            <a class="btn buttons btn-size" href="{{ url()->previous() }}" role="button" style="width: 120px">キャンセル</a>
                        </div>
                    </div>
                    <br/>
                    <br/>
                @else
                    <div class="row col-md-12 justify-content-center mt-5">
                        <h4 style="color: red">最大2つまで作成できます。</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('custom_js')
<script src="{{Request::root()}}/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		CKEDITOR.replace( 'description' ,{
		    filebrowserImageBrowseUrl : '{{Request::root()}}/ckeditor/plugins/imageuploader/imgbrowser.php',
			extraPlugins: 'imageuploader'
		});
	
	</script>
<script>
    $(document).ready(function() {
        var prevflag = "{{$flag}}";
        $("#send_service").click(function(){
            var flag = 0;
            if($('#service_category').val() == '' || $('#service_category').val() == null){
                flag = 1;
                $('#service_category_error').show();
            }
            if($('#title').val() == '' || $('#title').val() == null){
                flag = 1;
                $('#title_error').show();
            }
            if($('#price').val() == '' || $('#price').val() == null){
                flag = 1;
                $('#price_error').show();
            }

            textbox_data = CKEDITOR.instances.description.getData();
            if (textbox_data==='')
            {
                $('#detail_error').show();
                flag = 1;
            }
            if(flag == 0){
                if(confirm("こちらの内容でよろしいですか！")){
                    $("#service_form").submit();
                }
            }
        });
    });
</script>
<script>
    function removeAlert(b, a){
        error = document.getElementById(a);
        input_val = document.getElementById(b);
        if(input_val.value == '' || input_val.value == null)
            error.style.display = "block";
        else
            error.style.display = "none";
    }
</script>
@stop