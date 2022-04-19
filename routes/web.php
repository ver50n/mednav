<?php

use Illuminate\Support\Facades\Route;

/* Helper Routes */
Route::post('/helpers/change-locale',['as' => 'helpers.change-locale', 'uses' => 'HelperController@changeLocale']);
Route::get('/helpers/load-schedule',['as' => 'helpers.load-schedule', 'uses' => 'HelperController@loadSchedule']);
Route::get('/helpers/download-file',['as' => 'helpers.download-file', 'uses' => 'HelperController@downloadFile']);
Route::post('/helpers/change-row-per-page', 'HelperController@changeRowPerPage')
    ->name('helpers.change-row-per-page')
    ->middleware([]);
Route::post('/helpers/export', 'HelperController@export')
    ->name('helpers.export')
    ->middleware([]);
Route::post('/helpers/activation', 'HelperController@activation')
    ->name('helpers.activation')
    ->middleware([]);

Route::prefix('/manage')->middleware([])->group(base_path('routes/manage/index.php'));
Route::prefix('/')->middleware([])->group(base_path('routes/staff/index.php'));