@extends('layouts.staff-layout')
@section('content')
  <h4>@lang('common.callcenter')@lang('common.update')</h4>
	<div class="grid-action-wrapper">
		<div class="grid-action">
			<a href="{{route($routePrefix.'.list')}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-receipt menu-icon"></i> @lang('common.list')
				</button>
			</a>
		</div>
		@if($obj->status == "open")
		<div class="grid-action">
			<a href="{{route($routePrefix.'.update', ['id' => $obj->id])}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-edit menu-icon"></i> @lang('common.update')
				</button>
			</a>
		</div>
		
		<div class="grid-action">
			<a href="{{route($routePrefix.'.request', ['id' => $obj->id])}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-file-upload menu-icon"></i> @lang('common.request')
				</button>
			</a>
		</div>
		@endif
		<div class="grid-action">
			<a href="{{route($routePrefix.'.view', ['id' => $obj->id])}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-eye menu-icon"></i> @lang('common.view')
				</button>
			</a>
		</div>
	</div>
	@include($viewPrefix.'._update-form')
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.callcenter') . \Lang::get('common.update')])
@endsection