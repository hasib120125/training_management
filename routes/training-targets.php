<?php
//training-targets
Route::group(['middleware' => ['auth']], function () {

    Route::get('/', ['as' => 'training-targets.index',
        'middleware' => ['role:admin'],
        'uses' => 'TrainingTargetController@index']);

    Route::get('/data', ['as' => 'training-targets.data',
        'middleware' => ['role:admin'],
        'uses' => 'TrainingTargetController@indexData']);

    Route::get('/status', ['as' => 'training-targets.status',
        'uses' => 'TrainingTargetController@status']);

    Route::get('/statusdata',['as' =>'training-targets.statusdata',
        'uses' => 'TrainingTargetController@statusData']);


    Route::get('/create', ['as' => 'training-targets.create',
        'middleware' => ['permission:training-type-create'],
        'uses' => 'TrainingTargetController@create']);
    Route::post('/', ['as' => 'training-targets.store',
        'middleware' => ['permission:training-type-create'],
        'uses' => 'TrainingTargetController@store']);

    Route::get('/edit/{id}', ['as' => 'training-targets.edit',
        'middleware' => ['permission:training-type-edit'],
        'uses' => 'TrainingTargetController@edit']);
    Route::patch('/{id}', ['as' => 'training-targets.update',
        'middleware' => ['permission:training-type-edit'],
        'uses' => 'TrainingTargetController@update']);

    Route::get('delete/{id}', ['as' => 'training-targets.delete',
        'middleware' => ['permission:training-type-delete'],
        'uses' => 'TrainingTargetController@delete']);
    Route::delete('/{id}', ['as' => 'training-targets.destroy',
        'middleware' => ['permission:training-type-delete'],
        'uses' => 'TrainingTargetController@destroy']);

    Route::get('/{id}', ['as' => 'training-targets.show',
        'middleware' => ['permission:training-type-list'],
        'uses' => 'TrainingTargetController@show']);
});
