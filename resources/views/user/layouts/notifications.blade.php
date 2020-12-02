<?php
    $messages = App\Models\Message::where('to_id', Auth::user()->id)->where('is_read', false)->where('is_deleted', false)->get();
    $OrderDetails = App\Models\OrderDetail::where('status', 1)->whereHas('order', function($q){
        $q->where('user_id', Auth::user()->id)->where('status', 1)->where('is_read', false);
    })->get();
?>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="row inner">
            <div class="col-md-12 col-12 ">
                <div class="{{ !$messages->isEmpty() || !$OrderDetails->isEmpty() ? 'bg-danger' : '' }} px-2 pt-3">
                    @if (!$messages->isEmpty())
                        <a class="d-flex flex-row" href="{{route('user-message-inbox')}}">
                            <div class="align-self-start pr-2">
                                <span class="icon-info"> <i class="	fa fa-exclamation"></i> </span>
                            </div>
                            <div class="align-self-end">
                                <p class="font-weight-bold" style="color:red; font-size:15px;">メッセージが届いています。</p>
                            </div>
                        </a>
                     @endif

                     @if (!$OrderDetails->isEmpty())
                        <a class="d-flex flex-row" href="{{route('user-order-list')}}">
                             <div class="align-self-start pr-2">
                                 <span class="icon-info"> <i class="	fa fa-exclamation"></i> </span>
                             </div>
                             <div class="align-self-end">
                                 <p class="font-weight-bold" style="color:red; font-size:15px;">商品の注文が入りました</p>
                             </div>
                        </a>
                     @endif
                 </div>
             </div>
         </div>
     </div>
 </div>