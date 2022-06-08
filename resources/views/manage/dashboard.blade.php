@extends('layouts.manage-layout')

@section('content')

<div class="container-wrapper">
  <section class="container">
    <div class="subcontainer dashboard">
      <div class="jumbotron">
        <h1>MediNaviの管理画面へようこそ！</h1>
        <p>ここから内容を管理できます。</p>
      </div>
    </div>
  </section>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.dashboard')])
@endsection