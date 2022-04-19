<?php
  $module = 'staff';
  Route::get('/', 'Staff\StaffController@dashboard')
    ->name($module.'.dashboard')
    ->middleware(['auth']);

  Route::get('/login', 'Staff\LoginController@login')
    ->name($module.'.login')
    ->middleware([]);
  Route::post('/login', 'Staff\LoginController@loginPost')
    ->name($module.'.login-post')
    ->middleware([]);

  Route::post('/logout', 'Staff\LoginController@logout')
    ->name($module.'.logout')
    ->middleware([]);
    
// Setting
Route::get('/setting', 'PageController@setting')
  ->name($module.'.setting')
  ->middleware([]);

Route::post('/change-password-post', 'PageController@changePasswordPost')
  ->name($module.'.change-password-post')
  ->middleware([]);
Route::post('/account-post', 'PageController@accountPost')
  ->name($module.'.account-post')
  ->middleware([]);
Route::post('/setting-post', 'PageController@settingPost')
  ->name($module.'.setting-post')
  ->middleware([]);

Route::prefix('/attendance')->middleware(['auth'])->group(base_path('routes/staff/attendance.php'));
Route::prefix('/callcenter')->middleware(['auth'])->group(base_path('routes/staff/callcenter.php'));