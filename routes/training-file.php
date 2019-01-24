<?php
Route::group(['middleware' => ['web']], function () {
    Route::get('/', ['as' => 'training-files',
        'uses' => 'TrainingFileController@index']);
    Route::get('download/{id}', ['as' => 'training-files.download',
        'uses' => 'TrainingFileController@download']);
    Route::get('/data', ['as' => 'training-files.data',
        'middleware' => ['permission:file-list'],
        'uses' => 'TrainingFileController@indexData']);
    Route::get('/create', ['as' => 'training-files.create',
        'middleware' => ['permission:content-create'],
        'uses' => 'TrainingFileController@create']);
    Route::post('/store', ['as' => 'training-files.store',
        'middleware' => ['permission:content-create'],
        'uses' => 'TrainingFileController@store']);
    Route::get('/edit/{id}', ['as' => 'training-files.edit',
        'middleware' => ['permission:file-edit'],
        'uses' => 'TrainingFileController@edit']);
    Route::delete('/{id}', ['as' => 'training-files.destroy',
        'middleware' => ['permission:file-delete'],
        'uses' => 'TrainingFileController@destroy']);
    Route::patch('/{id}', ['as' => 'training-files.update',
        'middleware' => ['permission:file-edit'],
        'uses' => 'TrainingFileController@update']);
});
