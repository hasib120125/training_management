<?php
Route::get('file', ['as' => 'trainings.file',
    'middleware' => ['auth'],
    'uses' => 'TrainingController@getFile']);
Route::get('/', ['as' => 'trainings.index',
    'middleware' => ['auth'],
    'uses' => 'TrainingController@index']);
Route::get('/data', ['as' => 'trainings.data',
    'middleware' => ['auth'],
    'uses' => 'TrainingController@indexData']);

Route::get('/trainings/{id}', ['as' => 'trainings.DownloadFile',
    'middleware' => ['auth'],
    'uses' => 'TrainingController@DownloadFile']);


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/create', ['as' => 'trainings.create',
        'uses' => 'TrainingController@create']);
    Route::post('/store', ['as' => 'trainings.store',
        'uses' => 'TrainingController@store']);

    Route::get('titles','TrainingController@getTitles')->name('trainings.titles');

    //Route::get('titles-date-wise','TrainingController@getTitleByDateRange')->name('trainings.titles-date-wise');

    Route::get('/edit/{id}', ['as' => 'trainings.edit',
        'uses' => 'TrainingController@edit']);
    Route::patch('/{id}', ['as' => 'trainings.update',
        'uses' => 'TrainingController@update']);

    Route::get('/delete/{id}', ['as' => 'trainings.delete',
        'uses' => 'TrainingController@delete']);
    Route::delete('/{id}', ['as' => 'trainings.destroy',
        'uses' => 'TrainingController@destroy']);

    Route::get('/assign/{id}', ['as' => 'trainings.assign',
        'uses' => 'TrainingController@showAssignmentForm']);
    Route::post('/assign/{id}', [
        'uses' => 'TrainingController@assign']);
});

Route::get('{id}', ['as' => 'trainings.show',
    'middleware' => ['auth'],
    'uses' => 'TrainingController@show']);
