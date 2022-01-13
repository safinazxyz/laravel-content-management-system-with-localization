<?php
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
    Route::prefix(config('admin_urls.admin_name'))->namespace('Admin')->group(function(){
    //Admin Routes
        Route::match(['get','post'],'/','AdminController@login')->name('admin.login');
        Route::get('admin-register-page','AdminController@adminRegisterPage')->name('admin.register.page');
        Route::post('admin-register','AdminController@adminRegister')->name('admin.register');
        Route::post('forgot-password','Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.forgot.password');
        Route::get('forgot-password-page','Auth\ForgotPasswordController@forgotPasswordEmailPage')->name('admin.forgot.password.page');
        Route::post('reset-password','Auth\ResetPasswordController@reset')->name('admin.reset.password');
        Route::get('reset-password-page/{token}','Auth\ResetPasswordController@showResetForm')->name('admin.reset.password.page');
        Route::group(['middleware'=>['admin']],function (){
            Route::get('dashboard','AdminController@dashboard')->name('admin.dashboard');
            Route::get('settings','AdminController@settings')->name('admin.settings');
            Route::post('check-current-admin-pwd','AdminController@checkAdminPassword');
            Route::post('update-admin-current-pwd','AdminController@updateAdminPassword')->name('admin.update.admin.current.pwd');
            Route::get('logout','AdminController@logout')->name('admin.logout');
            Route::post('update-admin-details','AdminController@updateAdminDetails')->name('admin.update.admin.details');
            Route::get('adminDetails','AdminController@showAdminDetails')->name('admin.admin.details');
            Route::get('admin-users-list','AdminController@showAdminUserList')->name('admin.admin.users.list');
            Route::match(['get', 'post'], 'edit-admin-status', 'AdminController@editAdminStatus')->name('admin.edit.admin.status');
            Route::match(['get', 'post'], 'delete-sub-admin/{id}', 'AdminController@deleteSubAdmin');
        });
    });
});
