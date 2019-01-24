<?php
//training-brand
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'training-brand.index',        
        'uses' => 'TrainingBrandController@index']);
    Route::get('/data', ['as' => 'training-brand.data',        
        'uses' => 'TrainingBrandController@indexData']);

    Route::get('/create', ['as' => 'training-brand.create',        
        'uses' => 'TrainingBrandController@create']);
    Route::post('/', ['as' => 'training-brand.store',        
        'uses' => 'TrainingBrandController@store']);

    Route::get('/edit/{id}', ['as' => 'training-brand.edit',        
        'uses' => 'TrainingBrandController@edit']);
    Route::patch('/{id}', ['as' => 'training-brand.update',        
        'uses' => 'TrainingBrandController@update']);

    Route::get('delete/{id}', ['as' => 'training-brand.delete',        
        'uses' => 'TrainingBrandController@delete']);
    Route::delete('/{id}', ['as' => 'training-brand.destroy',        
        'uses' => 'TrainingBrandController@destroy']);

    Route::get('/{id}', ['as' => 'training-brand.show',
        'middleware' => ['permission:training-brand-list'],
        'uses' => 'TrainingBrandController@show']);
});
