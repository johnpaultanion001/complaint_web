<?php

Route::redirect('/', '/login');


Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    //Admin
    Route::get('/home', 'AdminController@home')->name('home');

    //Complaits
    Route::get('/complaints', 'ComplaintsController@index')->name('complaints');
    Route::get('/complaints/{complaint}', 'ComplaintsController@complaint')->name('complaint');
    Route::get('/complaints/{complaint}/change_status', 'ComplaintsController@change_status')->name('complaint.change_status');


    //Users
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/{account}', 'UsersController@status')->name('users.status');

    //Change Password
    Route::get('/change_password', 'UsersController@changepassword')->name('accounts.changepassword');
    Route::put('/change_password/{user}', 'UsersController@passwordupdate')->name('accounts.passwordupdate');

    //MY ACCOUNT
    Route::get('/edit_account',  'UsersController@edit_account')->name('accounts.edit_account');
    Route::post('/edit_account/{account}',  'UsersController@edit_account_update')->name('accounts.edit_account_update');


    Route::resource('complaint_history', 'ComplaintHistoryController');
   
});



