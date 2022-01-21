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

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', 'MenuController@test');

Route::get('menu', 'MenuController@index');

Route::get('card', 'CardController@index');
Route::post('card', 'CardController@cardAuthorize');
Route::get('card/result/{orderId}', 'CardController@authorizeResult');

Route::get('mpi', 'MpiController@index');
Route::post('mpi', 'MpiController@mpiAuthorize');
Route::post('mpi/result', 'MpiController@result');

Route::get('cvs', 'CvsController@index');
Route::post('cvs', 'CvsController@cvsAuthorize');
Route::get('cvs/result/{orderId}', 'CvsController@authorizeResult');

Route::post('push/mpi', 'PushController@mpi');


//予約
Route::get('/event/shibusawa/reserve/', 'MysteryController@shibusawa_index')->name('shibusawa_reserve');

//予約
Route::post('/event/shibusawa/reserve/confirm', 'MysteryController@shibusawa_confirm')->name('shibusawa_confirm');

//予約
Route::post('/event/shibusawa/reserve/fix', 'MysteryController@shibusawa_fix')->name('shibusawa_fix');

//予約
Route::post('/event/shibusawa/reserve/store', 'MysteryController@shibusawa_reserve_store')->name('shibusawa_reserve_store');

//予約
Route::get('/event/shibusawa/reserve/thanks', 'MysteryController@shibusawa_thanks')->name('shibusawa_thanks');


//ホーム画面
Route::get('/', function () {
    return view('index');
});

//about
Route::get('/about', function () {
    return view('mystery.about.index');
});

//about
Route::get('/about/travel', function () {
    return view('mystery.about.travel');
});

//about
Route::get('/about/stipulation', function () {
    return view('mystery.about.stipulation');
});

//about
Route::get('/about/term', function () {
    return view('mystery.about.term');
});

//about
Route::get('/about/privacy', function () {
    return view('mystery.about.privacy');
});

//about
Route::get('/agent', function () {
    return view('mystery.about.agent');
});

//about
Route::get('/about/travel-conditions', function () {
    return view('mystery.about.travel-conditions');
});



//faq
Route::get('faq', function () {
    return view('mystery.faq.index');
});

//予約
Route::get('/event/shibusawa', function () {
    return view('mystery.event.shibusawa.index');
});


//contact
Route::get('/contact', 'MysteryController@contact');

//contact
Route::post('/contact/confirm', 'MysteryController@contact_confirm')->name('contact_confirm');

//contact
Route::post('/contact/fix', 'MysteryController@contact_fix')->name('contact_fix');

//contact
Route::post('/contact/thanks', 'MysteryController@contact_thanks')->name('contact_thanks');


// 管理画面側
Route::group(['middleware' => 'basicauth'], function () {



    Route::get('/admin', 'HomeController@index')->name('home');

    //アカウント一覧表示
    Route::get('/admin/account', 'AccountsController@index')->name('accounts');

    //アカウント詳細表示
    Route::get('/admin/account/detail/{id}', 'AccountsController@detail')->name('account_detail');

    //アカウント編集画面
    Route::get('/admin/account/edit/{id}', 'AccountsController@edit');

    //アカウント編集処理
    Route::post('/admin/account/detail/', 'AccountsController@change')->name('accounts_change');







    //予約管理画面
    Route::get('/admin/reserve', 'ReserveController@index')->name('reserve');

    //予約種類別表示
    Route::get('/admin/reserve/{id}', 'ReserveController@list')->name('reserve_list');


    //予約枠新規作成画面
    Route::get('/admin/reserve/list/create/{type}', 'ReserveController@reserve_list_create')->name('reserve_list_create');

    //予約枠新規作成確認画面
    Route::post('/admin/reserve/list/create', 'ReserveController@reserve_list_create_post')->name('reserve_list_create_post');

    //予約種別詳細表示
    Route::get('/admin/reserve/type/{id}', 'ReserveTypeController@detail')->name('detail');

    //予約種類作成画面
    Route::get('/admin/type/create', 'ReserveTypeController@type_create')->name('type_create');

    //予約種類作成確認画面
    Route::post('/admin/type/confirm', 'ReserveTypeController@type_confirm')->name('type_create_confirm');

    //予約種別作成処理
    Route::post('/admin/type/create', 'ReserveTypeController@type_create_post')->name('type_create_post');

    //予約種別作成処理
    Route::post('/admin/type/create/fix', 'ReserveTypeController@reserve_type_fix')->name('reserve_type_fix');


    //予約種別詳細表示
    Route::get('/admin/reserve/type/edit/{id}', 'ReserveTypeController@detail_edit')->name('detail_edit');

    //予約種別詳細表示
    Route::post('/admin/reserve/type/confirm', 'ReserveTypeController@detail_confirm')->name('reserve_type_detail_confirm');

    //予約種別詳細編集処理
    Route::post('/admin/reserve/type/change', 'ReserveTypeController@detail_change')->name('reserve_type_detail_change');

    //予約種別詳細編集修正
    Route::post('/admin/reserve/type/fix', 'ReserveTypeController@detail_fix')->name('reserve_type_detail_fix');

    //予約種別写真変更
    Route::get('/admin/reserve/type/image/{type}', 'ReserveTypeController@detail_image')->name('detail_image');

    //予約種別写真変更処理
    Route::post('/admin/reserve/type/image', 'ReserveTypeController@detail_image_post')->name('reserve_type_image_change');

    //渋沢用予約詳細
    Route::get('/admin/entry/shibusawa/{id}', 'ReserveController@shibusawa_entry')->name('shibusawa_entry');

    //渋沢用参加日時変更
    Route::get('/admin/entry/shibusawa/start_date/{id}', 'EntryShibuController@change_start_date');

    //渋沢用参加日時変更
    Route::post('/admin/entry/shibusawa/start_date', 'ReserveController@shibusawa_change_start_date_post')->name('shibusawa_change_start_date_post');

    //渋沢用参加人数変更
    Route::get('/admin/entry/shibusawa/count/{id}', 'ReserveController@shibusawa_change_count')->name('shibusawa_change_count');

    //渋沢用参加人数変更
    Route::post('/admin/entry/shibusawa/count/', 'ReserveController@shibusawa_change_count_post')->name('shibusawa_change_count_post');

    //渋沢用ステータス変更
    Route::get('/admin/entry/shibusawa/status/{id}', 'ReserveController@shibusawa_change_status')->name('shibusawa_change_status');

    //渋沢用乗車、降車場所変更
    Route::get('/admin/entry/shibusawa/pickup/{id}', 'ReserveController@shibusawa_change_pickup')->name('shibusawa_change_pickup');

    //渋沢用乗車、降車場所変更処理
    Route::post('/admin/entry/shibusawa/pickup', 'ReserveController@shibusawa_change_pickup_post')->name('shibusawa_change_pickup_post');


    //渋沢用入金登録
    Route::get('/admin/entry/shibusawa/payment/{id}', 'ReserveController@shibusawa_payment')->name('shibusawa_payment');


    //渋沢用入金登録後
    Route::post('/admin/entry/shibusawa/payment', 'ReserveController@shibusawa_payment_post')->name('shibusawa_payment_post');

    //渋沢用請求ID変更
    Route::get('/admin/entry/shibusawa/payment_id/{id}', 'ReserveController@shibusawa_change_payment_id');


    //渋沢用ステータス変更後
    Route::post('/admin/entry/shibusawa/status', 'ReserveController@shibusawa_change_status_post')->name('shibusawa_change_status_post');

    //渋沢用カレンダー表示
    Route::get('/admin/entry/calendar/shibusawa', 'EntryShibuController@shibusawa_entry_calendar')->name('shibusawa_entry_calendar');


    //カレンダー情報取得(渋沢用)
    Route::get('/admin/shibusawa/set_data', 'EntryShibuController@set_data');

    //渋沢エントリー登録
    Route::get('/admin/shibusawa/entry/create', 'EntryShibuController@shibusawa_entry_create')->name('shibusawa_entry_create');

    //渋沢エントリー登録
    Route::post('/admin/shibusawa/entry/confirm', 'EntryShibuController@entry_shibusawa_create_confirm_post')->name('entry_shibusawa_create_confirm_post');


    Route::get('/calendar', function () {
        return view('calendar');
    });


    //エントリー作成
    Route::get('/admin/entry/create/{id}', 'EntryController@entry_create');

    //エントリー作成確認画面
    Route::post('/admin/entry/create/confirm', 'EntryController@entry_create_confirm_post')->name('entry_create_confirm_post');

    //エントリー作成処理
    Route::post('/admin/entry/create', 'EntryController@entry_create_post')->name('entry_create_post');

    //エントリー作成を修正
    Route::post('/admin/entry/create/fix', 'EntryController@entry_create_fix')->name('entry_create_fix');

    //エントリーカレンダー一覧表示(予約種別にて)
    Route::get('/admin/entry/calendar/{id}', 'EntryController@entry_calendar_list');


    //予約内容詳細表示
    Route::get('/admin/reserve/detail/{id}', 'ReserveController@reserve_detail')->name('reserve_detail');

    //予約受付状態の変更画面
    Route::get('/admin/reserve/display_flg/{id}', 'ReserveController@display_flg');

    //予約受付状態の変更後
    Route::post('/admin/reserve/display_flg', 'ReserveController@display_flg_post')->name('change_reserve_display_flg_post');

    //予約受付状態の変更画面
    Route::get('/admin/reserve/count/{id}', 'ReserveController@count');

    //予約受付状態の変更後
    Route::post('/admin/reserve/count', 'ReserveController@reserve_count_post')->name('reserve_count_post');

    //エントリー内容詳細表示
    Route::get('/admin/entry/detail/{id}', 'EntryController@entry_detail')->name('entry_detail');

    //エントリー一覧表示(予約種別ごとに)
    Route::get('/admin/entry/list/{type}', 'EntryController@entry_list_reserve_type');

    //カレンダー表示(予約種別ごとに)
    Route::get('/admin/set_data/{type}', 'EntryController@set_data');

    //カレンダー表示(予約日時変更)
    Route::get('/admin/reschedule/set_data/{type}/{id}', 'EntryController@reschedule_set_data');

    //予約日時変更確認画面
    Route::get('/admin/entry/reschedule/confirm/{new_id}/{id}', 'EntryController@reschedule_confirm');

    //予約日時変更後
    Route::post('/admin/entry/reschedule', 'EntryController@entry_rechedule')->name('entry_reschedule_post');

    //エントリー日程変更(予約種別ごとに)
    Route::get('/admin/entry/reschedule/{id}', 'EntryController@entry_reschedule');

    //参加日時変更
    Route::post('/admin/entry/start_date', 'EntryController@change_start_date_post')->name('change_start_date_post');

    //参加人数変更
    Route::get('/admin/entry/count/{id}', 'EntryController@change_count');

    //参加人数変更
    Route::post('/admin/entry/count/', 'EntryController@change_count_post')->name('change_count_post');

    //ステータス変更
    Route::get('/admin/entry/status/{id}', 'EntryController@change_status');

    //ステータス変更後
    Route::post('/admin/entry/status', 'EntryController@change_status_post')->name('change_status_post');

    //請求ID変更
    Route::get('/admin/entry/shibusawa/payment_id/{id}', 'EntryShibuController@shibusawa_change_payment_id');

    //請求ID変更後
    Route::post('/admin/entry/shibusawa/payment_id/', 'EntryShibuController@shibusawa_change_payment_id_post')->name('shibusawa_change_payment_id_post');



    //入金登録画面
    Route::get('/admin/entry/payment/{id}', 'EntryController@entry_payment')->name('entry_payment');

    //入金登録処理
    Route::post('/admin/entry/payment', 'EntryController@entry_payment_post')->name('entry_payment_post');


    //自動予約(オッドタクシー用)
    // Route::get('/auto/reserve/odotaxi', 'ReserveController@auto_create')->name('auto_create');







    // ****************メール機能**************************************************

    //メール履歴表示
    Route::get('/admin/mail', 'MailController@index')->name('mail');

    //検索(メール履歴表示)
    Route::post('/admin/mail', 'MailController@mail_search')->name('mail_search');

    //検索(メール履歴表示)
    Route::get('/admin/mail/detail/{id}', 'MailController@mail_detail')->name('mail_detail');

    //送信メール作成画面
    Route::get('/admin/mail/create/{id}', 'MailController@mail_create')->name('mail_create');

    //送信メール確認画面
    Route::post('/admin/mail/create/confirm', 'MailController@mail_create_confirm')->name('mail_create_confirm');

    //送信メール確認修正
    Route::post('/admin/mail/create/fix', 'MailController@mail_create_fix')->name('mail_create_fix');

    //メール送信処理
    Route::post('/admin/mail/create', 'MailController@mail_create_post')->name('mail_create_post');


    //メールテンプレート表示
    Route::get('/admin/mail/template', 'MailController@mail_template')->name('mail_template');

    //メールテンプレート作成
    Route::get('/admin/mail/template/create', 'MailController@mail_template_create')->name('mail_template_create');

    //メールテンプレート作成確認画面
    Route::post('/admin/mail/template/confirm', 'MailController@mail_template_confirm')->name('mail_template_confirm');

    //メールテンプレート作成確認画面
    Route::post('/admin/mail/template/create', 'MailController@mail_template_create_post')->name('mail_template_create_post');

    //メールテンプレート作成(修正へ)
    Route::post('/admin/mail/template/fix', 'MailController@mail_template_confirm_post')->name('mail_template_confirm_post');

    //メールテンプレート詳細表示
    Route::get('/admin/mail/template/{id}', 'MailController@mail_template_detail_confirm');

    //メールテンプレート詳細編集画面
    Route::get('/admin/mail/template/detail/{id}', 'MailController@mail_template_detail');

    //メールテンプレート詳細編集確認画面
    Route::post('/admin/mail/template/detail/confirm', 'MailController@mail_template_detail_confirm_post')->name('mail_template_detail_confirm_post');

    //メールテンプレート詳細編集処理
    Route::post('/admin/mail/template/detail/change', 'MailController@mail_template_detail_change_post')->name('mail_template_detail_change_post');

    //メールテンプレート詳細
    Route::post('/admin/mail/template/detail/fix', 'MailController@mail_template_detail_fix_post')->name('mail_template_detail_fix_post');

    //メールテンプレート埋め込み
    Route::post('/admin/mail/template/input', 'MailController@mail_template_input')->name('mail_template_input');

    //メールテンプレート削除
    Route::get('/admin/mail/template/delete/{id}', 'MailController@mail_template_delete')->name('mail_template_delete');

    //確定メール送信処理
    Route::get('/admin/mail/create/shibusawa/confirm/{entry_id}', 'MailController@mail_create_shibusawa_confirm');

    // //請求メール送信処理
    // Route::get('/admin/mail/create/shibusawa/payment/{entry_id}', 'MailController@mail_create_shibusawa_payment');



    // ****************請求**************************************************

    //請求画面表示
    Route::get('/admin/cost', 'CostController@index')->name('cost');

    //請求画面表示
    Route::get('/admin/cost/{month}', 'CostController@month_index');
});
