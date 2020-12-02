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
    <div class="col-md-12 alternates p-0" style="min-height: 850px">
        <div class="col-md-12 col-sm-12 p-0">
            <div class="col-md-12 p-0">
                    <div class="col-md-12 text-center mb-3"><span class="text-16">相談できるサービスを入力</span></div>
                    <form id="service_form" action="{{route('new-service-post')}}" enctype="multipart/form-data" method="post">

                        {{ csrf_field() }}
                        <input type="hidden" value="{{isset($service_prev->id)?$service_prev->id: 0}}" id="edit_flag" name="edit_flag"/>
                        <div class="col-md-12 row">
                            <div class="col-md-2"><span class="text-14">カテゴリー選択<span><br><span class="text-danger" style="font-size: 10px">＊必須</span></div>
                            <div class="col-md-10">
                                <div class="form-group mb-0" >
                                    {{-- minimal_createservice form-control small-screen-input-width --}}
                                    <select class="custom-select" name="service_category" id="service_category" style="width: 45% !important; border: 1px solid #cecece;height:38px !important; border-radius:3px" onblur="removeAlert('service_category','service_category_error')" id="select-service-category-order" required>
                                        <option value="">----------</option>
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
                            <div class="col-md-10">
                                <input type="text" class="small-screen-input-width input_box" style="width:45%; height:38px" id="price" name="price" value="{{isset($service_prev->price)?$service_prev->price:''}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" onblur="removeAlert('price','price_error')"/> 円 / 分
                                <div id="price_error" class="red_alerts"><span>通話料入力してください！</span></div>
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
                            <div class="col-md-2"><span class="text-14">画像</span><br><span class="text-danger" style="font-size: 10px"> ＊必須</span></div>
                            <div class="col-md-10">
                                @php
                                    $flag = 0;
                                @endphp
                                <div class="">
                                    <div><input type="file" id="thumbimg" name="thumbimg" onblur="removeAlert('thumbimg','image_error')"/></div>
                                    @if(isset($service_prev->thumbnail))
                                        <div class="mt-2" id="edit_img">
                                            <img style="height: 180px; width: 200px; object-fit: cover" src="{{Request::root()}}/assets/service/{{isset($service_prev->thumbnail)?$service_prev->thumbnail:''}}" />
                                        </div>
                                    @else
                                        @php
                                          $flag = 1;
                                        @endphp
                                    @endif
                                </div>
                                <div id="image_error" class="red_alerts"><span class="text-10">画像アップロードしてください！</span></div>
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
                            <button id="send_service" class="btn buttons btn-size" style="width: 120px; color: black">作成する</button>
                        </div>

                        <div class="col-md-6 text-md-left">
                            <a class="btn buttons btn-size" href="{{ url()->previous() }}" role="button" style="width: 120px">キャンセル</a>
                        </div>
                        
                    </div>
                    <br/>
                    <br/>
                
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <br/>
@stop



@section('custom_js')
<script src="{{Request::root()}}/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		CKEDITOR.replace( 'description' ,{
			// filebrowserBrowseUrl : 'ckeditor1/plugins/imageuploader/imgbrowser.php',
			// filebrowserUploadUrl : '/browser1/upload/type/all',
		    filebrowserImageBrowseUrl : '{{Request::root()}}/ckeditor/plugins/imageuploader/imgbrowser.php',
			// filebrowserImageUploadUrl : '/browser3/upload/type/image',
		    // filebrowserWindowWidth  : 800,
		    // filebrowserWindowHeight : 500,
			extraPlugins: 'imageuploader'
			// extraPlugins: 'dropler'
		});

	
	    // ClassicEditor
	    //     .create( document.querySelector( '#exampleInputDescription' ) )
	    //     .catch( error => {
	    //         console.error( error );
        //     } );
	
	</script>
<script>
    $(document).ready(function() {
        var prevflag = "{{$flag}}";
        //console.log('flag:'+prevflag);
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
            if($('#thumbimg').val() == '' || $('#thumbimg').val() == null){
                if($('#edit_img').html() == ''){
                    flag = 1;
                    $('#image_error').show();
                }
                if(prevflag == 1){
                    flag = 1;
                    $('#image_error').show();
                }
            }
            // if($('#instructions').val() == '' || $('#instructions').val() == null){
            //     flag = 1;
            //     $('#instruction_error').show();
            // }
            // if($('#description').val() == '' || $('#description').val() == null){
            //     flag = 1;
            //     $('#detail_error').show();
            // }
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