<?php
Route::get('/', ['as' => 'training-histories.index',
   'middleware' => ['auth'],
   'uses' => 'TrainingHistoryController@index']);
Route::get('/data', ['as' => 'training-histories.data',
   'middleware' => ['auth'],
   'uses' => 'TrainingHistoryController@indexData']);

Route::get('/create', ['as' => 'training-histories.create',
   'middleware' => ['auth'],
   'uses' => 'TrainingHistoryController@create']);
Route::post('/', ['as' => 'training-histories.store',
   'middleware' => ['auth'],
   'uses' => 'TrainingHistoryController@store']);

Route::get('/edit/{id}', ['as' => 'training-histories.edit',
   'middleware' => ['auth'],
   'uses' => 'TrainingHistoryController@edit']);
Route::patch('/{id}', ['as' => 'training-histories.update',
   'middleware' => ['auth'],
   'uses' => 'TrainingHistoryController@update']);
Route::get('delete/{id}', ['as' => 'training-histories.delete',
    'middleware' => ['auth'],
    'uses' => 'TrainingHistoryController@delete']);
Route::delete('/{id}', ['as' => 'training-histories.destroy',
    'middleware' => ['auth'],
    'uses' => 'TrainingHistoryController@destroy']);
//training-histories
Route::group(['middleware' => ['auth']], function () {
    Route::get('/{id}', ['as' => 'training-histories.show',
        'middleware' => ['permission:training-type-list'],
        'uses' => 'TrainingHistoryController@show']);
});
