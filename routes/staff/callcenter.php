<?php
  $module = 'staff.callcenter';
  $controller = 'Staff\CallcenterController';
  Route::get('/', $controller.'@list')
    ->name($module.'.list')
    ->middleware([]);
  Route::get('/create', $controller.'@create')
    ->name($module.'.create')
    ->middleware([]);
  Route::post('/create', $controller.'@createPost')
    ->name($module.'.createPost')
    ->middleware([]);
  Route::get('/{id}/update', $controller.'@update')
    ->name($module.'.update')
    ->middleware([]);
  Route::post('/{id}/update', $controller.'@updatePost')
    ->name($module.'.updatePost')
    ->middleware([]);
  Route::get('/{id}/request', $controller.'@request')
    ->name($module.'.request')
    ->middleware([]);
  Route::get('/{id}/view', $controller.'@view')
    ->name($module.'.view')
    ->middleware([]);
  Route::post('/{id}/active', $controller.'@active')
    ->name($module.'.active')
    ->middleware([]);
  Route::post('/{id}/inactive', $controller.'@inactive')
    ->name($module.'.inactive')
    ->middleware([]);
  Route::post('/{id}/delete', $controller.'@delete')
    ->name($module.'.delete')
    ->middleware([]);