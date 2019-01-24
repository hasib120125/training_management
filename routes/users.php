<?php
//users
Route::get('/change-password', ['as' => 'users.change-password',
    'middleware' => ['auth'],
    'uses' => 'UserController@showChangePasswordForm']);
Route::post('/change-password', ['as' => 'users.change-password',
    'middleware' => ['auth'],
    'uses' => 'UserController@changePassword']);

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', ['as' => 'users.index',
        'uses' => 'UserController@index']);
    Route::get('/data', ['as' => 'users.data',
        'uses' => 'UserController@indexData']);

    Route::get('names','UserController@getNames')->name('users.names');

    Route::get('trainer_names','UserController@getTrainer')->name('users.trainer_names');
    
    Route::patch('/change-status', ['as' => 'users.change-status',
        'uses' => 'UserController@changeStatus']);

    Route::get('/create', ['as' => 'users.create',
        'uses' => 'UserController@create']);
    Route::post('/', ['as' => 'users.store',
        'uses' => 'UserController@store']);

    Route::get('/edit/{id}', ['as' => 'users.edit',
        'uses' => 'UserController@edit']);
    Route::patch('/{id}', ['as' => 'users.update',
        'uses' => 'UserController@update']);

    Route::get('delete/{id}', ['as' => 'users.delete',
        'uses' => 'UserController@delete']);

    Route::delete('/{id}', ['as' => 'users.destroy',
        'uses' => 'UserController@destroy']);

    Route::get('/{id}', ['as' => 'users.show',
        'uses' => 'UserController@show']);
});
