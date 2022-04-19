<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')
    @include('layouts.includes.staff.asset')
    
    @include('layouts.includes.staff.header')
    <style>
      .global-wrapper {
        margin-bottom: 40px;
      }
      .nav-link, .dropdown-item {
        color: #000 !important;
      }
      .container-wrapper, button, label, .breadcrumb-item {
        font-size: 0.8rem !important;
      }
      .e_required {
        color: #AA0000;
      }
      .c_form__error-block {
        color: #AA0000;
        font-size: small;
        font-style: italic;
      }
      .menu-icon {
        font-size: 0.9rem;
        color: #6b7fff;
      }
      .grid-action-wrapper {
        display: flex;
        margin-bottom: 10px;
      }
      .grid-action {
        margin-right: 10px;
      }
      .grid-body-action__icon-wrapper {
        float: left;
        margin-right: 5px;
      }
      .components__card-section-wrapper {
        margin-bottom: 10px;
      }
      .breadcrumb-item {
        display: inline-flex;
      }
      .breadcrumb-item+.breadcrumb-item::before {
        content: ">";
      }
      .currency-label {
        text-align: right;
        font-style: italic;
      }
      .icon-wrapper {
        border: 1px solid #6c757d;
        display: inline-block;
        padding: 3px;
        border-radius: 3px;
        background: #6c757d;
      }
      .grid-wrapper {
        overflow-x: auto;
        max-height: 1200px;
      }
      .diff-cell {
        background-color: #dac17c;
      }
      .table-bordered td::-webkit-scrollbar, .table-bordered th::-webkit-scrollbar {
        display: none;
      }
      .table-bordered td, .table-bordered th {
        max-width:120px;
        overflow: scroll;
        white-space: nowrap;
      }
      .footer {
        width: 100%;
        max-height: 40px;
        position: fixed;
        bottom: 0px;
        left: 0px;
        background-color: #343a40!important;
        color: rgba(255,255,255,.5);
      }
      .footer__copy {
        max-height: 25px;
        text-align: center;
        font-size: 0.8rem;
      }
    </style>
  </head>

  <body>
    <div id="app" class="global-wrapper">
      @include('layouts.includes.staff.navbar')
      <div class="overlay"></div>
      <div class="container-fluid">
        @if(session('notify'))
        <div class="alert alert-warning">
          <button type="button" class="close" onclick="$('.alert').hide()">
            <span aria-hidden="true">&times;</span>
          </button>
          <b>
          @foreach(session('notify')['list'] as $notify)
            @if(!$loop->first)
              <br />
            @endif
            {!! $notify !!}
          @endforeach
          </b>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
          <strong>成功 : </strong>{{session('success')}}
          <button type="button" class="close" onclick="$('.alert').hide()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
          <strong>エラー : </strong>{{session('error')}}
          <button type="button" class="close" onclick="$('.alert').hide()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @yield('content')
        @include('layouts.includes.staff.footer')
      </div>
    </div>
  </body>
  @yield('modal')
  
</html>