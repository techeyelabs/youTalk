@extends('navbar')

@section('custom_css')
<style>
    .input_box {
        border-radius: 4px;
        border: 1px solid #cecece;
        padding: 1%;
        width: 70%;
    }
</style>
@stop


@section('content')
<div class="col-md-12 row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="col-md-12 text-center mb-5 mt-5">Profile Edit</div>
        <form id="service_form" action="{{route('profile-edit-action')}}" enctype="multipart/form-data" method="post">

            {{ csrf_field() }}

            <div class="col-md-12 row">
                <div class="col-md-6 text-right">
                    @if(isset($profile->picture))
                    <img src="{{Request::root()}}/assets/user/{{$profile->picture}}" style="height: 200px; width: 200px"
                        id="dpdisplay" />
                    @else
                    <img style="height: 200px; width: 200px" id="dpdisplay" />
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="file" id="dp" name="dp" />
                </div>
            </div>
            <br />
            <?php
            echo '<pre>';
            print_r($profile);
            exit;
        ?>
            <div class="col-md-12 row">
                <div class="col-md-4">First Name</div>
                <div class="col-md-8">
                    <input type="text" id="fname" name="fname" placeholder="" class="input_box"
                        value="{{$profile->first_name}}" />
                </div>
            </div>
            <br />
            <div class="col-md-12 row">
                <div class="col-md-4">Last Name</div>
                <div class="col-md-8">
                    <input type="text" id="lname" name="lname" placeholder="" class="input_box"
                        value="{{$profile->last_name}}" />
                </div>
            </div>
            <br />
            <div class="col-md-12 row">
                <div class="col-md-4">Gender</div>
                <div class="col-md-8">
                    <select id="gender" name="gender" class="input_box">
                        <option value="">---</option>
                        <option value="1" {{ $profile->gender == 1 ? 'selected="selected"' : '' }}>Male</option>
                        <option value="2" {{ $profile->gender == 2 ? 'selected="selected"' : '' }}>Female</option>
                        <option value="3" {{ $profile->gender == 3 ? 'selected="selected"' : '' }}>Trans</option>
                    </select>
                </div>
            </div>
            <br />
            <div class="col-md-12 row">
                <div class="col-md-4">Date of Birth</div>
                <div class="col-md-8">
                    <input type="date" id="dob" name="dob" value="{{$profile->dob}}" />
                </div>
            </div>
            <br />
            <div class="col-md-12 row">
                <div class="col-md-4">Phone</div>
                <div class="col-md-8">
                    <input value="{{$profile->phone}}" type="text" id="phone" name="phone" placeholder="phone"
                        class="input_box"
                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />
                </div>
            </div>
            <br />
            <div class="col-md-12 row">
                <div class="col-md-4">Address</div>
                <div class="col-md-8">
                    <textarea type="text" id="address" name="address"
                        class="textarea_input">{!!nl2br($profile->address)!!}</textarea>
                </div>
            </div>
            <br />
            <div class="col-md-12 row">
                <div class="col-md-4">Profile Bio</div>
                <div class="col-md-8">
                    <textarea type="text" id="bio" name="bio"
                        class="textarea_input">{!!nl2br($profile->bio)!!}</textarea>
                </div>
            </div>
            <br />
            <div class="col-md-12 text-center"><button type="submit" class="buttons"
                    style="background-color: #7BB3AE !important">Update</button></div>
            <br />
            <br />
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
@stop



@section('custom_js')

<script>
    $(document).ready(function () {});
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#dpdisplay').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#dp").change(function () {
        readURL(this);
    });
</script>
@stop