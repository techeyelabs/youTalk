<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
 
Auth::routes();

Route::get('/sendToHome', function(){
    return redirect()->route('front-home');
});
// line test
// Route::post('/line-webhook', 'LineController@webhook');
// Route::get('/line-webhook', 'LineController@webhook');
//routes for cron jobs
Route::get('/time', 'ServiceController@expiredReservations');
Route::get('/current-talkroom-close', 'ServiceController@runningTalkroomClose');
Route::get('/close-user-talkroom', 'ServiceController@closeUserTalkroom');
Route::get('/running-call-close', 'ServiceController@runningCallClose');
Route::get('/auto-talkroom-create', 'ServiceController@openReservedTalkroom');
Route::get('/leftout_reservation_removal', 'ServiceController@leftoutreservations');

//cron jobs for sorting 
Route::get('/sorting-cron', 'CronController@sortingCron');

// gateway callback url
Route::post('/addwallet-callback', 'MyPageController@addwalletcreditCallback')->name('addwallet-callback');

Route::get('/', 'HomeController@top')->name('front-home');
Route::get('/category', 'HomeController@serviceCategory')->name('front-cat-home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'TestController@index')->name('test');
Route::get('/search', 'HomeController@search')->name('front-search');

// Service serve
Route::get('/service-terminate-kick', 'ServiceController@callConfirmation');
Route::get('/engage-seller', 'ServiceController@engage_seller');


Route::get('/get-talkroom-status', 'ServiceController@talkroomStatus')->name('get-talkroom-status');

// Reservation notification
Route::get('/reservation-notification-count', 'MyPageController@reservation_notification')->name('reservation-notification-count');


// Statics routes
Route::get('/law', 'HomeController@law')->name('law');
Route::get('/privacy', 'HomeController@privacy')->name('privacy');
Route::get('/user_guide', 'HomeController@uguide')->name('user_guide');
Route::get('/terms', 'HomeController@terms')->name('terms');

// Reg routes
Route::get('/register-request', 'AuthController@registerRequest')->name('user-register-request');
Route::post('/register-request', 'AuthController@registerRequestAction')->name('user-register-request-action');

Route::get('/register/{token}', 'AuthController@register')->name('user-register');
Route::post('/register/{token}', 'AuthController@registerAction')->name('user-register-action');
Route::post('/email-validation', 'AuthController@validateEmail')->name('email-validation');

Route::get('/register-request', 'AuthController@registerRequest')->name('user-register-request');
Route::post('/register-request', 'AuthController@registerRequestAction')->name('user-register-request-action');

Route::get('/login', 'AuthController@login')->name('user-login');
Route::get('/service-login/{id}', 'AuthController@loginFromService')->name('service-login');
Route::post('/login', 'AuthController@loginAction')->name('login');
Route::get('/logout', 'AuthController@logout')->name('sign-out');
Route::get('/display-service-user/{id}', 'ServiceController@userDisplay')->name('user-display-service');
Route::get('/display-service-user-self/{id}', 'ServiceController@userDisplaySelf')->name('user-display-service-self');
Route::group(['middleware' => 'auth'], function () {
    // service mainatin
    Route::get('/edit-service/{id}', 'ServiceController@edit')->name('edit-service');
    Route::get('/create-service', 'ServiceController@new')->name('new-service');
    Route::post('/create-service', 'ServiceController@newServicePost')->name('new-service-post');

    //change password
    Route::get('/change-password', 'AuthController@changePassword')->name('change-password');
    Route::post('/change-password-action', 'AuthController@changePasswordAction')->name('user-change-password-action');

    Route::get('/status-change/{stat}/{id}', 'ServiceController@statusChange')->name('change-status');
    Route::get('/status-reservation/{stat}/{id}', 'ServiceController@reservationChange')->name('change-reservation');

    Route::get('/reservation/{id}', 'ServiceController@makeReserve')->name('make-reservation');
    Route::post('/reservation', 'ServiceController@postReserve')->name('post-schedule');
    Route::get('/reservation-list', 'ServiceController@reservationList')->name('my-reservations');
    Route::get('/reservation-ind-service/{id}', 'ServiceController@reservationListindService')->name('reservation-list-ind-service');
    Route::get('/history-ind-service/{id}', 'ServiceController@historyListindService')->name('history-list-ind-service');
    Route::get('/reservation-list-acepted/{id}', 'ServiceController@accepted_res')->name('reservation-list-acepted');

    Route::post('/accept-reservation', 'ServiceController@accept')->name('reservation-accept');

    Route::get('/get-reservation', 'ServiceController@getReservationRequest')->name('user-get-reservation');
    Route::post('/cancel-reservation', 'ServiceController@cancelReservationRequest')->name('cancel-reservation-request');
    Route::post('/cancel-confirmed-reservation', 'ServiceController@cancelAcceptedReservationRequest')->name('cancel-confirmed-Reservation-request');
    Route::post('/accept-reservation', 'ServiceController@acceptReservationRequest')->name('accept-reservation-request');
    Route::get('/showing-accepted-reservation', 'ServiceController@acceptedReservation')->name('show-accepted-reservation');

    //footer contact us form submission 
    Route::post('/contact-us', 'HomeController@contactUsAction')->name('contact-us-action');

    //showing user profile
    Route::get('/userPage-profile/{id}', 'MyPageController@userProfile')->name('user-page-profile');
    Route::get('/follow/{id}', 'MyPageController@userFollow')->name('follow');
    
    //withdraw requests
    Route::post('/withdraw-req', 'MyPageController@withReq')->name('withdraw-req-submit');

    // Personal pages
    Route::get('/user-reservations', 'MyPageController@myReservations')->name('user-reservations');
    Route::post('/cancel-my-reservation', 'MyPageController@cancelMyReservation')->name('cancel-reservation');

    Route::get('/mypage-service', 'MyPageController@service')->name('my-page-service');
    Route::get('/mypage-wallet', 'MyPageController@wallet')->name('my-wallet');
    Route::get('/my-earning', 'MyPageController@myEarning')->name('my-earning');
    Route::get('/mypage-profile', 'MyPageController@profile')->name('my-page-profile');
    Route::get('/chat', 'ChatController@index')->name('chat');
    Route::get('/mypage-service-history/{id}', 'MyPageController@serviceHistory')->name('service-history');
    Route::get('/mypage-service-notification', 'MyPageController@serviceNotification')->name('service-notification');
    Route::get('/mypage-talkroom-notification', 'MyPageController@talkroomNotification')->name('talkroom-notification');
    Route::get('/mypage-message-notification', 'MyPageController@messageNotification')->name('message-notification');
    Route::get('/callhistory-notification', 'MyPageController@callhistoryNotification')->name('callhistory-notification');

    Route::get('/edit-profile', 'MyPageController@profileEdit')->name('profile-edit');
    Route::post('/edit-profile', 'MyPageController@profileEditAction')->name('profile-edit-action');

    Route::get('/my-calls', 'MyPageController@mycallHistory')->name('my-call-history');

    Route::get('/chatbox', 'MyPageController@inboxMessage')->name('user-message');
    // chat
    Route::post('/get-conversation', 'MyPageController@getMessage')->name('user-get-conversation');
    Route::post('/send-message', 'MyPageController@sendMessage')->name('send-message');
    Route::post('/ind-unread', 'MyPageController@indUnread')->name('unread-count-ind');

    // wallet
    Route::get('/add-wallet', 'MyPageController@addwallet')->name('add-wallet');
    Route::post('/add-wallet-action', 'MyPageController@addwalletaction')->name('add-wallet-action');
    Route::get('/withdraw-wallet', 'MyPageController@addwallet')->name('withdraw-wallet');

    // //Gateway Messages
    Route::post('/success', 'RedirectController@success')->name('payment-option-success');
    Route::post('/addwallet-callback-fail', 'RedirectController@fail')->name('payment-option-fail');
    Route::post('/cancel', 'RedirectController@cancel')->name('payment-cancel');

    //talkroom and call related
    Route::get('/payment/{id}', 'CallController@paymentMethod')->name('payment-method');
    Route::post('/payment', 'CallController@paymentOption')->name('payment-option');
    Route::post('/buyer-message', 'CallController@buyerMessage')->name('buyer-message');
    Route::get('/talk-room', 'CallController@openTalkRoom')->name('my-talk-room');
    Route::post('/seller-message', 'CallController@sellerMessage')->name('seller-message');
    Route::get('/talkroom-close/{id}', 'CallController@closeTalkroom')->name('talk-room-close');
    Route::post('/review', 'CallController@postReview')->name('review');
    Route::post('/reply', 'CallController@postReply')->name('reply');
    Route::get('/talk-close/{id}', 'CallController@closeTalkSeller')->name('close-talk');

    //talkroom chat
    Route::get('/get-message-talkroom', 'CallController@getMessage')->name('get-message-talkroom');

    // line setup
    // Route::get('/line-login', 'LineController@login')->name('line-login');
    // Route::get('/line-login-callback', 'LineController@loginAction')->name('line-login-callback');
});
Route::get('/line-login', 'LineController@login')->name('line-login');
Route::get('/line-login-callback', 'LineController@loginAction')->name('line-login-callback');


Route::group(['prefix' => 'admin'], function () {

	Route::get('/login', 'Admin\AuthController@login')->name('admin-login');
	Route::post('/login', 'Admin\AuthController@loginAction')->name('admin-login-action');
	Route::get('/logout', 'Admin\AuthController@logout')->name('admin-logout');


	Route::group(['middleware' => 'admin-auth'], function () {
        Route::get('/', 'Admin\DashboardController@index')->name('admin-dashboard');
        // Route::get('/change-password', 'Admin\ProfileController@changePassword')->name('admin-change-password');
        // Route::post('/change-password', 'Admin\ProfileController@changePasswordAction')->name('admin-change-password-action');
        
        //to retrive services and show in Admin panel
        Route::get('services', [

            'uses' => 'Admin\ServiceController@index'
    
        ])->name('services');

        Route::post('change-service-status', [

            'uses' => 'Admin\ServiceController@changeStatus'
    
        ])->name('change-service-status');

        Route::get('user-list', [

            'uses' => 'Admin\DashboardController@showUsers'
    
        ])->name('user-list');

        Route::post('change-user-status', [

            'uses' => 'Admin\DashboardController@changeUserStatus'
    
        ])->name('change-user-status');

        Route::post('system-fee-update', 'Admin\DashboardController@systemFeeForUser')->name('system-fee-update');

        Route::get('reservation-list', [

            'uses' => 'Admin\ReservationController@index'
    
        ])->name('reservation-list');

        Route::get('/service-details/{id}', [

            'uses' => 'Admin\ServiceController@serviceDetails'
    
        ])->name('admin-service-details');

        Route::get('pending-deposit-list', [

            'uses' => 'Admin\DepositController@indexPending'
    
        ])->name('pending-deposit');

        Route::get('direct-deposit-list', [

            'uses' => 'Admin\DepositController@indexDirectPending'
    
        ])->name('direct-deposit');

        Route::get('credit-deposit-list', [

            'uses' => 'Admin\DepositController@indexCreditPending'
    
        ])->name('credit-deposit');

        Route::get('service-history-list', [

            'uses' => 'Admin\ServiceHistoryController@index'
    
        ])->name('service-history-list');

        Route::get('/talkroom-details/{id}', 'Admin\ServiceHistoryController@serviceDetails')->name('talkroom-details');

        Route::get('/user-details/{id}', 'Admin\DashboardController@userDetails')->name('user-details');



        Route::get('contact-us-list', [

            'uses' => 'Admin\DashboardController@showContactUs'
    
        ])->name('contact-us-list');

        Route::get('service-category-list', [

            'uses' => 'Admin\ServiceController@categoryIndex'
    
        ])->name('service-category-list');

        Route::get('add_category', [

            'uses' => 'Admin\ServiceController@addCategory'
    
        ])->name('add_category');

        Route::post('/service-category-post', 'Admin\ServiceController@storeCategory')->name('post.service-category');

        Route::get('/edit-category/{id}', 'Admin\ServiceController@categoryEdit')->name('edit-category');

        Route::post('/update-service-category/{id}', 'Admin\ServiceController@updateCategory')->name('post.update-service-category');
        
        Route::post('/service-recommendation', 'Admin\ServiceController@addRecommendation')->name('service-recommendation');
        Route::post('/remove-recommendation', 'Admin\ServiceController@removeRecommendation')->name('remove-recommendation');

        //chat
        //Route::get('/chatbox', 'Admin\DashboardController@inboxMessage')->name('user-message');
        Route::get('/show-messages/{id}', 'Admin\DashboardController@showMessage')->name('show-messages');
        Route::post('/sending-message', 'Admin\DashboardController@sendMessage')->name('sending-message');
        //Route::post('/ind-unread', 'Admin\DashboardController@indUnread')->name('unread-count-ind');
        Route::get('/send-mass-message', 'Admin\DashboardController@massMessage')->name('send-mass-message');
        Route::post('/mass-message', 'Admin\DashboardController@sendMassMessage')->name('mass-message');

        Route::get('/message-list', 'Admin\DashboardController@messageIndex')->name('message-list');

        Route::get('/point-withdraw', 'Admin\DashboardController@withdrawPointIndex')->name('point-withdraw');

        Route::get('/accept-withdraw/{id}', 'Admin\DashboardController@acceptWithdrawPoint')->name('accept-withdraw');
        Route::get('/withdraw-notification','Admin\DashboardController@withdrawNotification')->name('withdraw-notification');
        Route::get('/withdraw-notification-dashboard','Admin\DashboardController@withdrawNotificationDashboard')->name('withdraw-notification-dashboard');
        
        Route::post('/accept-deposit','Admin\DepositController@acceptDeposit')->name('accept-deposit-request');
        Route::post('/reject-deposit','Admin\DepositController@rejectDeposit')->name('reject-deposit-request');
        Route::post('/add-amount','Admin\DepositController@addAmount')->name('add-amount');
    });
});