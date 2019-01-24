<?php
//training-system
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'training-system.index',        
        'uses' => 'TrainingSystemController@index']);
    Route::get('/data', ['as' => 'training-system.data',        
        'uses' => 'TrainingSystemController@indexData']);

    Route::get('/create', ['as' => 'training-system.create',        
        'uses' => 'TrainingSystemController@create']);
    Route::post('/', ['as' => 'training-system.store',        
        'uses' => 'TrainingSystemController@store']);

    Route::get('/edit/{id}', ['as' => 'training-system.edit',        
        'uses' => 'TrainingSystemController@edit']);
    Route::patch('/{id}', ['as' => 'training-system.update',        
        'uses' => 'TrainingSystemController@update']);

    Route::get('delete/{id}', ['as' => 'training-system.delete',        
        'uses' => 'TrainingSystemController@delete']);
    Route::delete('/{id}', ['as' => 'training-system.destroy',        
        'uses' => 'TrainingSystemController@destroy']);

    Route::get('/{id}', ['as' => 'training-system.show',
        'middleware' => ['permission:training-system-list'],
        'uses' => 'TrainingSystemController@show']);
});
