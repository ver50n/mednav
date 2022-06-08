<?php
  $module = 'staff';
  Route::get('/', 'Staff\StaffController@dashboard')
    ->name($module.'.dashboard')
    ->middleware(['UserAuthentication']);

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
Route::get('/setting', 'Staff\StaffController@setting')
  ->name($module.'.setting')
  ->middleware(['UserAuthentication']);

Route::post('/change-password-post', 'Staff\StaffController@changePasswordPost')
  ->name($module.'.change-password-post')
  ->middleware(['UserAuthentication']);
Route::post('/account-post', 'Staff\StaffController@accountPost')
  ->name($module.'.account-post')
  ->middleware(['UserAuthentication']);
Route::post('/setting-post', 'Staff\StaffController@settingPost')
  ->name($module.'.setting-post')
  ->middleware(['UserAuthentication']);

Route::prefix('/attendance')->middleware(['UserAuthentication'])->group(base_path('routes/staff/attendance.php'));
Route::prefix('/callcenter')->middleware(['UserAuthentication'])->group(base_path('routes/staff/callcenter.php'));