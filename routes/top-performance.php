<?php
//top-performance
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'top-performance.index',
        'middleware' => ['role:admin'],
        'uses' => 'TopPerformanceController@index']);
    Route::get('/data', ['as' => 'top-performance.data',
        'middleware' => ['role:admin'],
        'uses' => 'TopPerformanceController@indexData']);

    Route::get('/status', ['as' => 'top-performance.status',
        'uses' => 'TopPerformanceController@status']);

    Route::get('/create', ['as' => 'top-performance.create',
        'middleware' => ['permission:training-type-create'],
        'uses' => 'TopPerformanceController@create']);
    Route::post('/', ['as' => 'top-performance.store',
        'middleware' => ['permission:training-type-create'],
        'uses' => 'TopPerformanceController@store']);

    Route::get('/edit/{id}', ['as' => 'top-performance.edit',
        'middleware' => ['permission:training-type-edit'],
        'uses' => 'TopPerformanceController@edit']);
    Route::patch('/{id}', ['as' => 'top-performance.update',
        'middleware' => ['permission:training-type-edit'],
        'uses' => 'TopPerformanceController@update']);

    Route::get('delete/{id}', ['as' => 'top-performance.delete',
        'middleware' => ['permission:training-type-delete'],
        'uses' => 'TopPerformanceController@delete']);
    Route::delete('/{id}', ['as' => 'top-performance.destroy',
        'middleware' => ['permission:training-type-delete'],
        'uses' => 'TopPerformanceController@destroy']);

    Route::get('/{id}', ['as' => 'top-performance.show',
        'middleware' => ['permission:training-type-list'],
        'uses' => 'TopPerformanceController@show']);
});
