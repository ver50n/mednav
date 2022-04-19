@extends('layouts.manage-layout')
@section('content')
	<h4>スケジュールClone</h4>
	<div class="grid-action-wrapper">
    <div class="grid-action">
    <a href="{{route($routePrefix.'.list')}}">
      <button class="btn btn-outline-secondary">
        <i class="c_icon fas fa-receipt menu-icon"></i> 一覧
      </button>
    </a>
    </div>
  </div>
	@include($viewPrefix.'._clone-form')
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'スケジュール変更'])
@endsection