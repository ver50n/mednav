<?php
  $module = 'manage';
  Route::get('/', 'Manage\ManageController@dashboard')
    ->name($module.'.dashboard')
    ->middleware(['AdminAuthentication']);

  Route::get('/login', 'Manage\LoginController@login')
    ->name('manage.login')
    ->middleware([]);
  Route::post('/login', 'Manage\LoginController@loginPost')
    ->name('manage.login-post')
    ->middleware([]);

  Route::post('/logout', 'Manage\LoginController@logout')
    ->name('manage.logout')
    ->middleware([]);
    
// Setting
Route::get('/setting', 'PageController@setting')
  ->name('manage.setting')
  ->middleware(['AdminAuthentication']);

Route::post('/change-password-post', 'PageController@changePasswordPost')
  ->name('manage.change-password-post')
  ->middleware(['AdminAuthentication']);
Route::post('/account-post', 'PageController@accountPost')
  ->name('manage.account-post')
  ->middleware(['AdminAuthentication']);
Route::post('/setting-post', 'PageController@settingPost')
  ->name('manage.setting-post')
  ->middleware(['AdminAuthentication']);
    
  Route::prefix('/admin')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/admin.php'));
  Route::prefix('/user')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/user.php'));
  Route::prefix('/place')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/place.php'));
  Route::prefix('/attendance')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/attendance.php'));
  Route::prefix('/callcenter')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/callcenter.php'));