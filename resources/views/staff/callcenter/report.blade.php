@extends('layouts.staff-layout')
@section('content')
  <h4>@lang('common.callcenter')@lang('common.report')</h4>
	<div class="grid-action-wrapper">
		<div class="grid-action">
			<a href="{{route($routePrefix.'.list')}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-receipt menu-icon"></i> @lang('common.list')
				</button>
			</a>
		</div>
  </div>
  <section class="component__report-form">
    <form action="{{route($routePrefix.'.reportMonthly')}}"
      method="GET"
      enctype="multipart/form-data">
      <div class="form-group">
        <label>@lang('common.date_period')</label>

        <div class="form-row">
          <div class="col-md-4 mb-3">
            <input class="form-control form-control-sm"
              name="filters[date_period_start]"
              id="date_period_start"
              autocomplete="off"
              value="{{old('date_period_start') ? old('date_period_start') : $obj->date_period_start}}" />
          </div>
          <div class="col-md-4 mb-3">
            <input class="form-control form-control-sm"
              name="filters[date_period_end]"
              id="date_period_end"
              autocomplete="off"
              value="{{old('date_period_end') ? old('date_period_end') : $obj->date_period_end}}" />
          </div>
        </div>
      </div>

      <div>
        <button type="submit" class="btn btn-success">
          <span class="action-icon">
            <i class="c_icon fas fa-filter menu-icon"></i> @lang('common.generate')
          </span>
        </button>
      </div>
    </form>
  </section>
@endsection

@section('javascript')
<script>
  $( function() {
    $('#date_period_start, #date_period_end').datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
</script>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.callcenter') . \Lang::get('common.create')])
@endsection