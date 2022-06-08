<?php
  $module = 'manage';
  Route::get('/', 'Manage\ManageController@dashboard')
    ->name($module.'.dashboard')
    ->middleware(['AdminAuthentication']);

  Route::get('/login', 'Manage\LoginController@login')
    ->name($module.'.login')
    ->middleware([]);
  Route::post('/login', 'Manage\LoginController@loginPost')
    ->name($module.'.login-post')
    ->middleware([]);

  Route::post('/logout', 'Manage\LoginController@logout')
    ->name($module.'.logout')
    ->middleware([]);
    
// Setting
Route::get('/setting', 'Manage\ManageController@setting')
  ->name($module.'.setting')
  ->middleware(['AdminAuthentication']);

Route::post('/change-password-post', 'Manage\ManageController@changePasswordPost')
  ->name($module.'.change-password-post')
  ->middleware(['AdminAuthentication']);
Route::post('/account-post', 'Manage\ManageController@accountPost')
  ->name($module.'.account-post')
  ->middleware(['AdminAuthentication']);
Route::post('/setting-post', 'Manage\ManageController@settingPost')
  ->name($module.'.setting-post')
  ->middleware(['AdminAuthentication']);
    
  Route::prefix('/admin')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/admin.php'));
  Route::prefix('/user')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/user.php'));
  Route::prefix('/place')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/place.php'));
  Route::prefix('/attendance')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/attendance.php'));
  Route::prefix('/callcenter')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/callcenter.php'));