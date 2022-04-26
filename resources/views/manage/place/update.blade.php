@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.place')@lang('common.update')</h4>
	<div class="grid-action-wrapper">
		<div class="grid-action">
			<a href="{{route($routePrefix.'.list')}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-receipt menu-icon"></i> @lang('common.list')
				</button>
			</a>
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.create')}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-plus menu-icon"></i> @lang('common.create')
				</button>
			</a>
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.update', ['id' => $obj->id])}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-edit menu-icon"></i> @lang('common.update')
				</button>
			</a>
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.view', ['id' => $obj->id])}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-eye menu-icon"></i> @lang('common.view')
				</button>
			</a>
		</div>
		<div class="grid-action">
			<form action="{{route('helpers.activation')}}"
				id="grid-action-activation"
				method="POST"
			>
				@csrf
        <input type="hidden" name="model" value="Place"/>
        <input type="hidden" name="id" value="{{$obj->id}}"/>
			</form>
      @if($obj->is_active == 0)
      <button class="btn btn-success"
        onClick="document.getElementById('grid-action-activation').submit()">
        <i class="c_icon fas fa-check menu-icon"></i> @lang('common.activate')
      </button>
      @else
      <button class="btn btn-danger"
        onClick="document.getElementById('grid-action-activation').submit()">
        <i class="c_icon fas fa-times menu-icon"></i> @lang('common.disactivate')
      </button>
      @endif
		</div>
	</div>
  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__base-info"
        aria-expanded="true"
        aria-controls="collapse-view__base-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right"> @lang('common.basic-info')</i>
      </a>
    </div>
    <div id="collapse-view__base-info" class="collapse show">
      <div class="card-body">
        @include($viewPrefix.'._update-form')
      </div>
    </div>
  </section>
  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__hourly-wages-info"
        aria-expanded="true"
        aria-controls="collapse-view__hourly-wages-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right"> @lang('common.hourly-wage-info')</i>
      </a>
    </div>
	
    <div id="collapse-view__hourly-wage-info" class="collapse show">
      <div class="card-body">
        @include($viewPrefix.'._hourly_wage_form', [
          'id' => $obj->id,
          'wages' => $wages
        ])
      </div>
    </div>
  </section>
  
  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__shift-hours-info"
        aria-expanded="true"
        aria-controls="collapse-view__shift-hours-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right"> @lang('common.shift-hour-info')</i>
      </a>
    </div>
    <div id="collapse-view__shift-hour-info" class="collapse show">
      <div class="card-body">
        @include($viewPrefix.'._shift_hour_form', [
          'id' => $obj->id,
          'shifts' => $shifts
        ])
      </div>
    </div>
  </section>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.place') . \Lang::get('common.update')])
@endsection


@section('javascript')
<script>
  $( function() {
    targetWageClass = ".wage-info";
    targetShiftClass = ".shift-info";
    init();

    $(targetWageClass).on('click','.add-wage-clone', function() {
      addWageClone();
    });
    $(targetWageClass).on('click','.remove-wage-clone', function() {
      removeWageClone($(this));
    });
    $(targetWageClass).on('change','.morning-wage', function() {
      updateExceptionalRate($(this));
    });

    function updateExceptionalRate(el) {
      row = el.parent().parent().parent();
      morningWage = el.val();

      noonWage = row.find('.noon-wage')
      noonWage.val(Math.floor(noonWage.attr('rate') * morningWage));
      setThousandSeparator(noonWage);

      nightWage = row.find('.night-wage')
      nightWage.val(Math.floor(nightWage.attr('rate') * morningWage));
      setThousandSeparator(nightWage);
      
      nightOvertimeWage = row.find('.night-overtime-wage')
      nightOvertimeWage.val(Math.floor(nightOvertimeWage.attr('rate') * morningWage));
      setThousandSeparator(nightOvertimeWage);

      overtimeWage = row.find('.overtime-wage')
      overtimeWage.val(Math.floor(overtimeWage.attr('rate') * morningWage));
      setThousandSeparator(overtimeWage);

      holidayWage = row.find('.holiday-wage')
      holidayWage.val(Math.floor(holidayWage.attr('rate') * morningWage));
      setThousandSeparator(holidayWage);

      setThousandSeparator(el);
    }

    function addWageClone() {
      cloneObj = $('.clone-wage-source').clone();
      cloneObj.removeClass('clone-wage-source');
      $(targetWageClass).append(cloneObj);
    }

    function removeWageClone(el) {
      el.parent().parent().remove();
    }

    $(targetShiftClass).on('click','.add-shift-clone', function() {
      addShiftClone();
    });
    $(targetShiftClass).on('click','.remove-shift-clone', function() {
      removeShiftClone($(this));
    });

    function init() {
      {{count($obj->placeHourlywages) == 0 ? "addWageClone();" : "" }}
      {{count($obj->placeShiftHours) == 0 ? "addShiftClone();" : "" }}
    }

    function addShiftClone() {
      cloneShiftObj = $('.clone-shift-source').clone();
      cloneShiftObj.removeClass('clone-shift-source');
      $(targetShiftClass).append(cloneShiftObj);
      
      $('.start-hour,.end-hour', cloneShiftObj).timepicker({
        timeFormat: "HH:mm",
        stepMinute: 30,
      });
    }

    function removeShiftClone(el) {
      el.parent().parent().remove();
    }
  });
</script>
@endsection