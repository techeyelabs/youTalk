<style>
    .buttons{
        border: 1px solid #64b7f9;
        border-radius: 4px;
        background-color: #64b7f9;
        width: 190px;
        padding: 5px;
        box-shadow: 1px 1px #7f9098;
    }
    .mytabs{
        /* width: 33%; */
        text-align: center;
        /* border: 1px solid gray; */
        padding: 20px;
    }
    .table_cells{
        width: 23%;
        text-align: center;
        border: 1px solid;
        padding: 9px;
    }
    .index_cells{
        width: 8%; 
        border: 1px solid; 
        text-align: center;
    }
    td {
        vertical-align: top;
        border-bottom: 1px solid #eaeaea;
        padding: 10px
    }
</style>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="row mt-3 less-height" style="height: 120px">
    <div class="col-md-2"></div>
    <div class="col-md-8 row">
        <div class="col-md-12 row">
            <div class="col-md-4 text-left">
               <div class="expandable"><img style="width: 130px; height: 130px; object-fit:cover; border-radius: 50%" src="{{Request::root()}}/assets/user/{{$profile->picture}}" /></div>
            </div>
            <div class="col-md-8">
                <div>{{$personal->name}}</div>
                <div>{{$personal->email}}</div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="mt-3 row expandable" style="height: 100px">
    <div class="col-md-2"></div>
    <div class="col-md-8 pl-5 pr-5">
        <table style="width: 100%; border: none; font-size: 16px !important">
            <tbody>
                <tr style="width: 100%">
                    <td class="{{ (Request::path() == 'mypage-profile' || Request::path() == 'edit-profile') ? 'mytabs current-my-page' : 'mytabs' }}"><a href="{{route('my-page-profile')}}">プロフィール</a></td>
                    <td class="{{ (Request::path() == 'mypage-service' || Route::currentRouteName()=='user-display-service-self' || Route::currentRouteName()=='reservation-list-acepted' || Route::currentRouteName()== 'reservation-list-ind-service' || Route::currentRouteName()=='history-list-ind-service' || Route::currentRouteName()=='new-service') ? 'mytabs current-my-page' : 'mytabs' }}"><a href="{{route('my-page-service')}}">サービス</a></td>
                    <td class="{{(Route::currentRouteName()=='user-message')?'mytabs current-my-page':'mytabs' }}"><a href="{{route('user-message')}}">メッセージ</a></td>
                    <td class="{{(Route::currentRouteName()=='my-call-history')?'mytabs current-my-page':'mytabs' }}"><a href="{{route('my-call-history')}}">通話履歴</a></td>
                    <td class="{{(Route::currentRouteName()=='my-reservations')?'mytabs current-my-page':'mytabs' }}"><a href="{{route('my-reservations')}}">予約履歴</a></td>
                    <td class="mytabs"><a href="{{route('sign-out')}}">ログアウト</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-2"></div>
</div>