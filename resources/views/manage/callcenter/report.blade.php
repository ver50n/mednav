@extends('layouts.manage-layout')
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
        <label>@lang('common.user_id')</label> <span class="e_required">*</span>
        <input class="form-control form-control-sm"
          name="user_label"
          id="user-label"
          value="{{ old('user_label') }}"
          placeholder="@lang('common.user_id')" />
        <input type="hidden" id="user_id" name="filters[user_id]" value="{{ old('user_id') }}" />
      </div>
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
    $("#user-label").autocomplete({
      source: {!! $userList !!},
      select: function (event, ui) {
        $("#user_id").val(ui.item.value)
        $('#user-label').val(ui.item.label);
        return false;
      },
      minLength: 1
    });
  });
</script>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.callcenter') . \Lang::get('common.create')])
@endsection