<?php
//training-users
Route::get('/', ['as' => 'training-users.index',
    'middleware' => ['auth'],
    'uses' => 'TrainingUserController@index']);
Route::get('/data', ['as' => 'training-users.data',
    'middleware' => ['auth'],
    'uses' => 'TrainingUserController@indexData']);

Route::get('/edit/{id}', ['as' => 'training-users.edit',
    'middleware' => ['auth'],
    'uses' => 'TrainingUserController@edit']);
Route::patch('/{id}', ['as' => 'training-users.update',
    'middleware' => ['auth'],
    'uses' => 'TrainingUserController@update']);


Route::get('/training-users/{id}', ['as' => 'training-users.DownloadFile',
    'middleware' => ['auth'],
    'uses' => 'TrainingUserController@DownloadFile']);


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/create', ['as' => 'training-users.create',
        'uses' => 'TrainingUserController@create']);
    Route::post('/', ['as' => 'training-users.store',
        'uses' => 'TrainingUserController@store']);

    Route::get('delete/{id}', ['as' => 'training-users.delete',
        'uses' => 'TrainingUserController@delete']);
    Route::delete('/{id}', ['as' => 'training-users.destroy',
        'uses' => 'TrainingUserController@destroy']);

    Route::get('/{id}', ['as' => 'training-users.show',
        'uses' => 'TrainingUserController@show']);
});
