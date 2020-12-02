
<div id="send-message" class="modal fade" role="dialog">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span onclick="cls_msg_modal()" class="close">&times;</span>
      </div>
      <form action="{{route('user-send-message')}}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="to_id" value="" id="to_id">
        <div class="modal-body modal_body_area row">
          <h5 class="modal-title px-3 col-10"><span id=""></span> {{ isset($modal_title)?$modal_title:"商品提供者へのメッセージ" }}</h5>
          <p class="col-12 mb-0 pb-0" id="get_vendor_name"></p>
          <div class="form-group col-md-12 mt-0 pt-0">
			     <input class="form-control" type="hidden" name="name" value="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}" requried readonly>
		     </div>
        <div class="form-group col-md-12">
			       <label for="">件名</label>
			          <input class="form-control" name="subject" placeholder="件名" required maxlength="100">
		     </div>
        <div class="form-group col-md-12">
			       <label for="">内容</label>
             <textarea name="message" rows="4" cols="80" class="form-control" placeholder="内容" required maxlength="2000"></textarea>
    		</div>
        <div class="col-md-12">
          <h4 class="text-center text-white"> <button type="submit" class="btn btn-warning text-white" style="background:#618ca9;">メッセージ送信</button></h4>

        </div>
      </div>
      </form>
    </div>
  </div>
</div>