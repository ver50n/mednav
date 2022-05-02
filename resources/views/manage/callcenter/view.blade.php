@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.callcenter')@lang('common.view')</h4>
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
              <th><label>@lang('common.user_id')</label></th>
              <td><label>{{$obj->user->name}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.place_id')</label></th>
              <td>
                <label>{{$obj->place->name}}</label>
                <br />
                <table class="table table-bordered table-striped table-hover table-condensed">
                  <thead>
                    <tr>
                      <th><label>@lang('common.morning_wage')</label></th>
                      <th><label>@lang('common.noon_wage')</label></th>
                      <th><label>@lang('common.night_wage')</label></th>
                      <th><label>@lang('common.night_overtime_wage')</label></th>
                      <th><label>@lang('common.overtime_wage')</label></th>
                      <th><label>@lang('common.holiday_wage')</label></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->morning_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['morning'] }}x</small></label></td>
                      <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->noon_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['noon'] }}x</small></label></td>
                      <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->night_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['night'] }}x</small></label></td>
                      <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->night_overtime_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['night_overtime'] }}x</small></label></td>
                      <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->overtime_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime'] }}x</small></label></td>
                      <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->holiday_wage) }}<br /><small class="disabled">{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['holiday'] }}x</small></label></td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <th><label>@lang('common.date_period')</label></th>
              <td><label>{{$obj->date_period}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.time_start')</label></th>
              <td><label>{{$obj->time_start}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.time_end')</label></th>
              <td><label>{{$obj->time_end}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.working_hour')</label></th>
              <td><label>{{$obj->working_hour}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.shift')</label></th>
              <td><label>@lang('application-constant.WORKING_SHIFT.'.$obj->shift)</label></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  
  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__actual-working-info"
        aria-expanded="true"
        aria-controls="collapse-view__actual-working-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"> @lang('common.actual-working-info')</label></i>
      </a>
    </div>
    <div id="collapse-view__actual-working-info" class="collapse show">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <tbody>
            <tr>
              <th><label>@lang('common.actual_time_start')</label></th>
              <td><label>{{$obj->actual_time_start}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.actual_time_end')</label></th>
              <td><label>{{$obj->actual_time_end}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.actual_time_rest')</label></th>
              <td><label>{{$obj->actual_time_rest}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.actual_working_hour')</label></th>
              <td><label>{{$obj->actual_working_hour}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.actual_overtime')</label></th>
              <td><label>{{$obj->actual_overtime}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.transport_fee')</label></th>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->transport_fee) }}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.handling_fee')</label></th>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->handling_fee) }}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.note')</label></th>
              <td><label>{!! nl2br($obj->note) !!}</label></td>
            </tr>
          </tbody>
        </table>
        <h5>計算まとめ</h5>
        
        <table class="table table-bordered table-striped table-hover table-condensed">
          <tbody>
            <tr>
              <th><label>@lang('common.actual_working_hour_payment')</label></th>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->actual_working_hour_payment) }}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.actual_overtime_hour_payment')</label></th>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->actual_overtime_hour_payment) }}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.user_payment')</label></th>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->user_payment) }}</label></td>
            </tr>
            <tr>
              <th><label>@lang('common.invoice_payment')</label></th>
              <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->invoice_payment) }}</label></td>
            </tr>
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
              <th><label>@lang('common.status')</label></th>
              <td><label>@lang('application-constant.CALLCENTER_STATUS.'.$obj->status)</label></td>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.callcenter') . \Lang::get('common.view')])
@endsection