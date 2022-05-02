@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.place')@lang('common.view')</h4>
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
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"> @lang('common.basic-info')</i>
      </a>
    </div>
    <div id="collapse-view__base-info" class="collapse show">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <tbody>
            <tr>
              <th><label>@lang('common.id')</label></th>
              <td><label>{{$obj->id}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.name')</label></th>
              <td><label>{{$obj->name}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.address')</label></th>
              <td><label>{!! nl2br($obj->address) !!}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.desc')</label></th>
              <td><label>{!! nl2br($obj->desc) !!}</label></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  
  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__hourly-wages-info"
        aria-expanded="true"
        aria-controls="collapse-view__hourly-wages-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"> @lang('common.hourly-wage-info')</i>
      </a>
    </div>
    <div id="collapse-view__hourly-wages-info" class="collapse show">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th><label>@lang('common.jobtype')</label></th>
              <th><label>@lang('common.morning_wage')</label></th>
              <th><label>@lang('common.noon_wage')</label></th>
              <th><label>@lang('common.night_wage')</label></th>
              <th><label>@lang('common.night_overtime_wage')</label></th>
              <th><label>@lang('common.overtime_wage')</label></th>
              <th><label>@lang('common.holiday_wage')</label></th>
            </tr>
          </thead>
          <tbody>
            @foreach($obj->placeHourlyWages as $wage)
            <tr>
              <td><label>@lang('application-constant.JOBTYPE.'.$wage->jobtype)</label></td>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($wage->morning_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['morning'] }}x</small></label></td>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($wage->noon_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['noon'] }}x</small></label></td>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($wage->night_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['night'] }}x</small></label></td>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($wage->night_overtime_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['night_overtime'] }}x</small></label></td>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($wage->overtime_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime'] }}x</small></label></td>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($wage->holiday_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['holiday'] }}x</small></label></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__shift-hours-info"
        aria-expanded="true"
        aria-controls="collapse-view__shift-hours-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"> @lang('common.shift-hour-info')</i>
      </a>
    </div>
    <div id="collapse-view__shift-hours-info" class="collapse show">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th><label>@lang('common.shift')</label></th>
              <th><label>@lang('common.start_hour')</label></th>
              <th><label>@lang('common.end_hour')</label></th>
            </tr>
          </thead>
          <tbody>
            @foreach($obj->placeShiftHours as $shift)
            <tr>
              <td><label>@lang('application-constant.WORKING_SHIFT.'.$shift->shift)</label></td>
              <td><label>{{ $shift->start_hour->format('H:i') }}</label></td>
              <td><label>{{ $shift->end_hour->format('H:i') }}</label></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__status-info"
        aria-expanded="true"
        aria-controls="collapse-view__status-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"> @lang('common.status-info')</label></i>
      </a>
    </div>
    <div id="collapse-view__status-info" class="collapse show">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <tbody>
            <tr>
              <th><label>@lang('common.is_active')</label></th>
              <td><label>@lang('application-constant.YES_NO.'.App\Helpers\ApplicationConstant::YES_NO[$obj->is_active])</label></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__log-info"
        aria-expanded="true"
        aria-controls="collapse-view__log-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"> @lang('common.log-info')</i>
      </a>
    </div>
    <div id="collapse-view__log-info" class="collapse show">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <tbody>
            <tr>
              <th><label>@lang('common.created_at')</label></th>
              <td><label>{{$obj->created_at}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.updated_at')</label></th>
              <td><label>{{$obj->updated_at}}</label></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.place') . \Lang::get('common.view')])
@endsection