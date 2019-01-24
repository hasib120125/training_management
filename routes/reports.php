<?php
Route::get('file', ['as' => 'reports.file',
    'middleware' => ['auth'],
    'uses' => 'ReportController@getFile']);

Route::get('/topic-wise-report', ['as' => 'reports.topic-wise-report',
    'middleware' => ['auth'],
    'uses' => 'ReportController@topicWiseReprot']);

Route::get('/topic-wise-report-data', ['as' => 'reports.topic-wise-report-data',
    'middleware' => ['auth'],
    'uses' => 'ReportController@topicWiseReprotData']);

Route::get('/target-achievement-report', ['as' => 'reports.target-achievement-report',
    'middleware' => ['auth'],
    'uses' => 'ReportController@targetAchievementWiseReport']);

Route::get('/target-achievement-report-data', ['as' => 'reports.target-achievement-report-data',
    'middleware' => ['auth'],
    'uses' => 'ReportController@targetAchievementWiseReportData']);

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/create', ['as' => 'reports.create',
        'uses' => 'ReportController@create']);
    Route::post('/store', ['as' => 'reports.store',
        'uses' => 'ReportController@store']);

    Route::get('/edit/{id}', ['as' => 'reports.edit',
        'uses' => 'ReportController@edit']);
    Route::patch('/{id}', ['as' => 'reports.update',
        'uses' => 'ReportController@update']);

    Route::get('/delete/{id}', ['as' => 'reports.delete',
        'uses' => 'ReportController@delete']);
    Route::delete('/{id}', ['as' => 'reports.destroy',
        'uses' => 'ReportController@destroy']);

    Route::get('/assign/{id}', ['as' => 'reports.assign',
        'uses' => 'ReportController@showAssignmentForm']);
    Route::post('/assign/{id}', [
        'uses' => 'ReportController@assign']);
});

Route::get('{id}', ['as' => 'reports.show',
    'middleware' => ['auth'],
    'uses' => 'ReportController@show']);
