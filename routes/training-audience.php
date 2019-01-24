<?php
//training-audiences
Route::group(['middleware' => ['auth','role:admin']], function () {
    Route::get('/', ['as' => 'training-audiences.index',
        
        'uses' => 'TrainingAudienceController@index']);
    Route::get('/data', ['as' => 'training-audiences.data',
        
        'uses' => 'TrainingAudienceController@indexData']);

    Route::get('/create', ['as' => 'training-audiences.create',
        
        'uses' => 'TrainingAudienceController@create']);
    Route::post('/', ['as' => 'training-audiences.store',
       
        'uses' => 'TrainingAudienceController@store']);

    Route::get('/edit/{id}', ['as' => 'training-audiences.edit',
        'uses' => 'TrainingAudienceController@edit']);
    Route::patch('/{id}', ['as' => 'training-audiences.update',
        'uses' => 'TrainingAudienceController@update']);

    Route::get('delete/{id}', ['as' => 'training-audiences.delete',
        'uses' => 'TrainingAudienceController@delete']);
    Route::delete('/{id}', ['as' => 'training-audiences.destroy',
        'uses' => 'TrainingAudienceController@destroy']);

    Route::get('/{id}', ['as' => 'training-audiences.show',
        'uses' => 'TrainingAudienceController@show']);
});
