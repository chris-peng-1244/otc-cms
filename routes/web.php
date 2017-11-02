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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('withdraw')->group(function() {
    Route::get('/', 'WithdrawController@index')->name('withdraw_list');
    Route::get('/{id}', 'WithdrawController@show')->name('withdraw_detail')
        ->middleware('withdraw.id');
    Route::post('/{id}/confirm', 'WithdrawController@confirm')->name('withdraw_audit_confirm')
        ->middleware('withdraw.id');
    Route::post('/{id}/deny', 'WithdrawController@deny')->name('withdraw_audit_deny')
        ->middleware('withdraw.id');
    Route::get('/{id}/audit-confirm-modal', 'WithdrawController@auditConfirmModal')
        ->name('withdraw_audit_confirm_modal')
        ->middleware('withdraw.id');
    Route::get('/{id}/audit-deny-modal', 'WithdrawController@auditDenyModal')
        ->name('withdraw_audit_deny_modal')
        ->middleware('withdraw.id');
    Route::get('/log', 'WithdrawController@logList')->name('withdraw_log');
});

Route::prefix('cms-user')->middleware(['role:admin'])->group(function() {
    Route::get('/', 'CmsUserController@index')->name('cms_user_list');
    Route::get('/{id}', 'CmsUserController@show')->name('cms_user_detail');
    Route::post('/{id}', 'CmsUserController@update')->name('cms_user_update');
});

Route::prefix('order')->group(function() {
    Route::get('/', 'OrderController@index')->name('order_list');
    Route::get('/{id}', 'OrderController@show')->name('order_detail')->middleware('order.id');
});
