<?php
//training-modes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'training-modes.index',
        'middleware' => ['permission:training-mode-list|training-mode-create|training-mode-edit|training-mode-delete'],
        'uses' => 'TrainingModeController@index']);
    Route::get('/data', ['as' => 'training-modes.data',
        'middleware' => ['permission:training-mode-list|training-mode-create|training-mode-edit|training-mode-delete'],
        'uses' => 'TrainingModeController@indexData']);

    Route::get('/create', ['as' => 'training-modes.create',
        'middleware' => ['permission:training-mode-create'],
        'uses' => 'TrainingModeController@create']);
    Route::post('/', ['as' => 'training-modes.store',
        'middleware' => ['permission:training-mode-create'],
        'uses' => 'TrainingModeController@store']);

    Route::get('/edit/{id}', ['as' => 'training-modes.edit',
        'middleware' => ['permission:training-mode-edit'],
        'uses' => 'TrainingModeController@edit']);
    Route::patch('/{id}', ['as' => 'training-modes.update',
        'middleware' => ['permission:training-mode-edit'],
        'uses' => 'TrainingModeController@update']);

    Route::get('delete/{id}', ['as' => 'training-modes.delete',
        'middleware' => ['permission:training-mode-delete'],
        'uses' => 'TrainingModeController@delete']);
    Route::delete('/{id}', ['as' => 'training-modes.destroy',
        'middleware' => ['permission:training-mode-delete'],
        'uses' => 'TrainingModeController@destroy']);

    Route::get('/{id}', ['as' => 'training-modes.show',
        'middleware' => ['permission:training-mode-list'],
        'uses' => 'TrainingModeController@show']);
});
