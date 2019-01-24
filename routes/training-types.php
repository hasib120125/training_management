<?php
//training-types
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'training-types.index',
        'middleware' => ['permission:training-type-list|training-type-create|training-type-edit|training-type-delete'],
        'uses' => 'TrainingTypeController@index']);
    Route::get('/data', ['as' => 'training-types.data',
        'middleware' => ['permission:training-type-list|training-type-create|training-type-edit|training-type-delete'],
        'uses' => 'TrainingTypeController@indexData']);

    Route::get('/create', ['as' => 'training-types.create',
        'middleware' => ['permission:training-type-create'],
        'uses' => 'TrainingTypeController@create']);
    Route::post('/', ['as' => 'training-types.store',
        'middleware' => ['permission:training-type-create'],
        'uses' => 'TrainingTypeController@store']);

    Route::get('/edit/{id}', ['as' => 'training-types.edit',
        'middleware' => ['permission:training-type-edit'],
        'uses' => 'TrainingTypeController@edit']);
    Route::patch('/{id}', ['as' => 'training-types.update',
        'middleware' => ['permission:training-type-edit'],
        'uses' => 'TrainingTypeController@update']);

    Route::get('delete/{id}', ['as' => 'training-types.delete',
        'middleware' => ['permission:training-type-delete'],
        'uses' => 'TrainingTypeController@delete']);
    Route::delete('/{id}', ['as' => 'training-types.destroy',
        'middleware' => ['permission:training-type-delete'],
        'uses' => 'TrainingTypeController@destroy']);

    Route::get('/{id}', ['as' => 'training-types.show',
        'middleware' => ['permission:training-type-list'],
        'uses' => 'TrainingTypeController@show']);
});
