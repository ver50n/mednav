<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')
    @include('layouts.includes.asset')
    <link href="{{ asset('/css/components/error.css') }}" rel="stylesheet">
    @include('layouts.includes.header')
  </head>

  <body>
    <div id="app" class="global-wrapper">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </body>
</html>
