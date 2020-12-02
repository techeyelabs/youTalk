<style>
        .left_menu_area i.angle{
            position: absolute;
            right: 0px;
            font-size: 20px;
        }
    </style>
    
    <div class="list-group text-center">
        
        
        <div class="left_menu_area leftmenuarea">
            <span class="list-group-item text-center"><strong><i class="fa fa-user-circle user_icon"></i> メッセージ</strong></span>
            <a href="{{route('user-message-inbox')}}" class="list-group-item text-center">受信箱
                {!! Route::currentRouteName()=='user-message-inbox'?'<i class="fa fa-angle-right angle" aria-hidden="true"></i>':'' !!}			
            </a>
            <a href="{{route('user-message-sent')}}" class="list-group-item text-center">送信済み
                    {!! Route::currentRouteName()=='user-message-sent'?'<i class="fa fa-angle-right angle" aria-hidden="true"></i>':'' !!}
            </a>
            <a href="{{route('user-message-trash')}}" class="list-group-item text-center">削除済み 
                {!! Route::currentRouteName()=='user-message-trash'?'<i class="fa fa-angle-right angle" aria-hidden="true"></i>':'' !!}
            </a>
            
        </div>
        <div>
            <select class="leftmenuarea_sm form-control">
                <option value="{{route('user-message-inbox')}}" {{Route::currentRouteName()=='user-message-inbox'?'selected':''}}>受信箱</option>
                <option value="{{route('user-message-sent')}}" {{Route::currentRouteName()=='user-message-sent'?'selected':''}}>送信済み</option>
                <option value="{{route('user-message-trash')}}" {{Route::currentRouteName()=='user-message-trash'?'selected':''}}>削除済み</option>
                
            </select>
        </div>
    </div>
    